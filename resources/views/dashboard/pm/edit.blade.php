@extends('dashboard.layouts.app')

@section('container')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 mb-2 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Tabel {{ $judul }}</h6>
            </div>
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form action="{{ route('penilaian.pm.update', $alternatif) }}" method="post">
                    @csrf
                    <small class="text-red-400">* Isi angka 1-5</small>
                    @foreach ($kriteria as $item)
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">{{ $item->nama }}</span>
                        </label>
                        <input type="number" step="1" min="1" max="5" name="nilai[{{ $item->id }}]" placeholder="Type here" class="input input-bordered w-full max-w-xs text-dark" value="{{ old('nilai') ?? isset($data[$item->id]) ? $data[$item->id] : 1 }}" required />
                        <label class="label">
                            @error('nama')
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('penilaian.pm') }}" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
