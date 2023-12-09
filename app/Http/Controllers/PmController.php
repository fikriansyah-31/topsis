<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilPm;
use App\Models\HasilSolusiTopsis;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PmController extends Controller
{
    public function index()
    {
        $judul = "Perhitungan Profile Matching";
        $aspek = Kriteria::orderBy('kode')->get();
        $alternatif = Alternatif::with('pmKriteria')->get();
        $bobotSelisih = $this->getBobotSelisih();

        $gap = [];
        if (request()->exists('hitung')) {
            $gap = $this->hitungGap($aspek, $alternatif);
        }
        $pembobotan = $this->hitungNcfNsf($gap);
        $nilaiTotal = $this->hitungNilaiTotal($pembobotan);

        $kandidat = $nilaiTotal;

        return view('dashboard.pm.index', compact('aspek', 'judul', 'alternatif', 'kandidat', 'bobotSelisih'));
    }

    public function hasilAkhir()
    {
        $judul = "Hasil Akhir Profile Matching";
        $aspek = Kriteria::orderBy('kode')->get();
        $alternatif = Alternatif::with('pmKriteria')->get();
        $bobotSelisih = $this->getBobotSelisih();

        $gap = $this->hitungGap($aspek, $alternatif);
        $pembobotan = $this->hitungNcfNsf($gap);
        $nilaiTotal = $this->hitungNilaiTotal($pembobotan);

        $kandidat = $nilaiTotal;

        return view('dashboard.pm.hasil', compact('aspek', 'judul', 'alternatif', 'kandidat', 'bobotSelisih'));
    }

    private function hitungGap($kriteria, $alternatif)
    {
        $gap = [];
        $targetKriteria = $kriteria->pluck('target', 'id');
        $tipeKriteria = $kriteria->pluck('tipe', 'id');

        if (count($alternatif) > 0) {
            foreach ($alternatif as $alt) {
                $penilaian = $alt->pmKriteria()->pluck('nilai', 'kriteria_id');
                $gap[$alt->id] = [
                    'nama' => $alt->objek->nama,
                    'aspek' => [],
                ];
                foreach ($penilaian as $kriteria_id => $nilai) {
                    $gap[$alt->id]['aspek'][] = [
                        'kriteria_id' => $kriteria_id,
                        'nilai' => $nilai - $targetKriteria[$kriteria_id],
                        'tipe' => $tipeKriteria[$kriteria_id],
                    ];
                }
            }
        }

        return $gap;
    }

    private function getBobotSelisih()
    {
        $pm_bobot = [
            ['selisih' => 0, 'bobot' => 5, 'keterangan' => 'Tidak ada selisih (kompetensi sesuai dgn yg dibutuhkan)'],
            ['selisih' => 1, 'bobot' => 4.5, 'keterangan' => 'Kompetensi individu kelebihan 1 tingkat'],
            ['selisih' => -1,'bobot' =>  4, 'keterangan' => 'Kompetensi individu kekurangan 1 tingkat'],
            ['selisih' => 2, 'bobot' => 3.5, 'keterangan' => 'Kompetensi individu kelebihan 2 tingkat'],
            ['selisih' => -2, 'bobot' => 3, 'keterangan' => 'Kompetensi individu kekurangan 2 tingkat'],
            ['selisih' => 3, 'bobot' => 2.5, 'keterangan' => 'Kompetensi individu kelebihan 3 tingkat'],
            ['selisih' => -3, 'bobot' => 2, 'keterangan' => 'Kompetensi individu kekurangan 3 tingkat'],
            ['selisih' => 4,'bobot' => 1.5, 'keterangan' => 'Kompetensi individu kelebihan 4 tingkat'],
            ['selisih' => -4,'bobot' => 1, 'keterangan' => 'Kompetensi individu kekurangan 4 tingkat'],
        ];

        return collect($pm_bobot);
    }

    private function hitungNcfNsf($gap)
    {
        $bobot = $this->getBobotSelisih()->pluck('bobot', 'selisih');
        $data = [];

        if (!empty($gap)) {
            foreach ($gap as $alternatif_id => $alt) {
                $data[$alternatif_id] = $alt;
                $ncf = 0;
                $nsf = 0;
                foreach ($alt['aspek'] as $key => $aspek) {
                    if ($aspek['tipe'] == 'core') {
                        $ncf += $bobot[$aspek['nilai']];
                    } else {
                        $nsf += $bobot[$aspek['nilai']];
                    }
                }
                $ncf = $ncf / collect($alt['aspek'])->where('tipe', 'core')->count();
                $nsf = $nsf / collect($alt['aspek'])->where('tipe', 'secondary')->count();

                $data[$alternatif_id]['ncf'] = $ncf;
                $data[$alternatif_id]['nsf'] = $nsf;
            }
        }

        return $data;
    }

    private function hitungNilaiTotal($pembobotan)
    {
        $nilaiTotal = [];
        $bobotNcf = 0.6;
        $bobotNsf = 0.4;

        if (!empty($pembobotan)) {
            foreach ($pembobotan as $alternatif_id => $alt) {
                $nilaiTotal[$alternatif_id] = $alt;
                $nilai = ($bobotNcf * $alt['ncf']) + ($bobotNsf * $alt['nsf']);
                $nilaiTotal[$alternatif_id]['nilai_total'] = $nilai;
            }
        }

        return $nilaiTotal;
    }

    public function simpanHasil()
    {
        $aspek = Kriteria::orderBy('kode')->get();
        $alternatif = Alternatif::with('pmKriteria')->get();

        $gap = $this->hitungGap($aspek, $alternatif);
        $pembobotan = $this->hitungNcfNsf($gap);
        $nilaiTotal = $this->hitungNilaiTotal($pembobotan);

        $data = [];

        foreach ($nilaiTotal as $alternatif_id => $val) {
            $data[] = [
                'alternatif_id' => $alternatif_id,
                'nilai' => $val['nilai_total'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        HasilPm::upsert($data, ['alternatif_id'], ['nilai']);

        return redirect()->route('perhitungan.pm.hasil')->with('berhasil', 'Data berhasil disimpan');
    }

    public function perbandingan()
    {
        $judul = "Perbandingan Hasil Akhir TOPSIS dan Profile Matching";

        $alternatif = [];
        if (HasilSolusiTopsis::count() > 0 && HasilPm::count() > 0) {
            $alternatif = Alternatif::with('hasilTopsis', 'hasilPm', 'objek')->get();
        }

        return view('dashboard.hasil_akhir.perbandingan', compact('alternatif', 'judul'));
    }
}
