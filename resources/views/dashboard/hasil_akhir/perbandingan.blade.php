@extends('dashboard.layouts.app')

@section('container')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Perbandingan Hasil Akhir TOPSIS dan Profile Matching</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_hasil" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nilai Topsis</th>
                                <th>Nilai Profile Matching</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr>
                                    <td>{{ $item->objek->nama }}</td>
                                    <td>{{ round($item->hasilTopsis?->nilai, 3) }}</td>
                                    <td>{{ round($item->hasilPm?->nilai, 3) }}</td>
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
            $('#tabel_data_hasil').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();
        });
    </script>
@endsection
