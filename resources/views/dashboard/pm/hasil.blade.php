@extends('dashboard.layouts.app')

@section('container')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Hasil Akhir</h6>
                    <a href="{{ route('simpan.hasil.pm') }}" class="btn btn-active btn-accent text-white hover:bg-accent/95 hover:border-accent/95">Simpan hasil</a>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_ranking" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <td>Rank</td>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidat as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['nama'] }}</td>
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
            $('#tabel_data_ranking').DataTable({
                responsive: true,
                order: [[2, 'desc']],
            })
            .columns.adjust()
            .responsive.recalc();

            @if (session()->has('berhasil'))
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ session('berhasil') }}',
                    icon: 'success',
                    confirmButtonColor: '#6419E6',
                    confirmButtonText: 'OK',
                });
            @endif
        });
    </script>
@endsection
