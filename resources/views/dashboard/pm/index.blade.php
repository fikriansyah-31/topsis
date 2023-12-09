@extends('dashboard.layouts.app')

@section('container')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">

            <div class="mb-5">
                <a href="{{ route('perhitungan.pm', ['hitung' => 1]) }}" class="btn btn-active btn-accent text-white hover:bg-accent/95 hover:border-accent/95">Hitung Profile Matching</a>
            </div>
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Nilai Target Aspek</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_bobot" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Target</th>
                                <th>Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aspek as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->target }}</td>
                                    <td>{{ ucfirst($item->tipe) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Nilai Kandidat Tiap Aspek</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_nilai_kandidat" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($aspek as $item)
                                    <th>{{ $item->nama }} ({{ $item->target }})</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr>
                                    <td>{{ $item->objek->nama }}</td>
                                    @foreach ($item->pmKriteria as $value)
                                        <td>{{ $value->pivot->nilai }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Perhitungan Pemetaan GAP untuk Tiap Aspek</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_nilai_gap" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($aspek as $item)
                                    <th>{{ $item->nama }} ({{ $item->target }})</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidat as $item)
                                <tr>
                                    <td>{{ $item['nama'] }}</td>
                                    @foreach ($item['aspek'] as $value)
                                        <td>{{ $value['nilai'] }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Bobot Selisih</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_selisih" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Selisih</th>
                                <th>Bobot Nilai</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bobotSelisih->toArray() as $item)
                                <tr>
                                    <td>{{ $item['selisih'] }}</td>
                                    <td>{{ $item['bobot'] }}</td>
                                    <td>{{ $item['keterangan'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Pembobotan untuk Tiap Aspek</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_pembobotan" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($aspek as $item)
                                    <th>{{ $item->nama }} ({{ $item->target }})</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $bobot_keyby_selisih = $bobotSelisih->pluck('bobot', 'selisih')
                            @endphp
                            @foreach ($kandidat as $item)
                            <tr>
                                <td>{{ $item['nama'] }}</td>
                                @foreach ($item['aspek'] as $value)
                                    <td>{{ $bobot_keyby_selisih[$value['nilai']] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Nilai Rata-rata NCF, NSF dan Total</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_ncf_nsf" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <td>NCF</td>
                                <td>NSF</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidat as $item)
                            <tr>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['ncf'] }}</td>
                                <td>{{ $item['nsf'] }}</td>
                                <td>{{ $item['nilai_total'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Tabel
        $(document).ready(function() {
            $('#tabel_data_bobot').DataTable({
                responsive: true,
                order: [],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
            })
            .columns.adjust()
            .responsive.recalc();

            $('#tabel_data_nilai_kandidat').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

            $('#tabel_data_nilai_gap').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

            $('#tabel_data_selisih').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

            $('#tabel_data_pembobotan').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

            $('#tabel_data_ncf_nsf').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();
        });
    </script>
@endsection
