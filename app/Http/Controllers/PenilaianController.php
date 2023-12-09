<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenilaianRequest;
use App\Http\Services\PenilaianService;
use App\Http\Services\SubKriteriaService;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Objek;
use App\Models\PmPenilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    protected $penilaianService, $subKriteriaService;

    public function __construct(PenilaianService $penilaianService, SubKriteriaService $subKriteriaService)
    {
        $this->penilaianService = $penilaianService;
        $this->subKriteriaService = $subKriteriaService;
    }

    public function index()
    {
        $judul = "Penilaian";

        $data = $this->penilaianService->getAll();
        $subKriteria = $this->subKriteriaService->getAll();

        return view('dashboard.penilaian.index', [
            "judul" => $judul,
            "data" => $data,
            "subKriteria" => $subKriteria,
        ]);
    }

    public function ubah(Request $request)
    {
        $judul = "Penilaian";

        $data = $this->penilaianService->ubahGetData($request);
        $subKriteria = $this->subKriteriaService->getAll()->where('kriteria_id', $data->kriteria_id);

        $subJudul = $data->kriteria->nama;

        return view('dashboard.penilaian.edit', [
            "judul" => $judul,
            "subJudul" => $subJudul,
            "data" => $data,
            "subKriteria" => $subKriteria,
        ]);
    }

    public function perbarui(PenilaianRequest $request)
    {
        $data = $this->penilaianService->perbaruiPostData($request);
        return redirect('dashboard/penilaian')->with('berhasil', "Data berhasil diperbarui!");
    }

    public function pmPenilaianIndex()
    {
        $judul = "Penilaian Profile Matching";

        $alternatif = Alternatif::with('pmKriteria', 'objek')->get();
        $kriteria = Kriteria::orderBy('kode')->get();

        return view('dashboard.pm.penilaian', compact('judul', 'alternatif', 'kriteria'));
    }

    public function pmPenilaianUbah(Alternatif $alternatif)
    {
        $judul = "Penilaian Profile Matching " . $alternatif->objek->nama;

        $kriteria = Kriteria::orderBy('kode')->get();
        $data = $alternatif->pmKriteria()->pluck('nilai', 'kriteria_id');

        return view('dashboard.pm.edit', compact('judul', 'kriteria', 'alternatif', 'data'));
    }
    public function pmPenilaianPerbaharui(Request $request, Alternatif $alternatif)
    {
        $data = [];
        foreach ($request->nilai as $kriteria_id => $nilai) {
            $data[$kriteria_id] = ['nilai' => $nilai];
        }

        $alternatif->pmKriteria()->sync($data);

        return redirect()->route('penilaian.pm')->with('success', 'Data berhasil diperbaharui');
    }
}
