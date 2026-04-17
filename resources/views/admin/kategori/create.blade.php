@extends('layouts/app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tags mr-2"></i>{{ $title }}
</h1>

<div class="card shadow">
    <div class="card-header">
        <a href="{{ route('kategori') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">

        {{-- ALERT ERROR --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('kategoristore') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Laptop <span class="text-danger">*</span></label>
                <input type="text" name="nama_laptop"
                    value="{{ old('nama_laptop') }}"
                    class="form-control @error('nama_laptop') is-invalid @enderror"
                    placeholder="Contoh: Lenovo ThinkPad">

                @error('nama_laptop')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Penanggung Jawab <span class="text-danger">*</span></label>
                <input type="text" name="penanggung_jawab"
                    value="{{ old('penanggung_jawab') }}"
                    class="form-control @error('penanggung_jawab') is-invalid @enderror"
                    placeholder="Contoh: IT Support">

                @error('penanggung_jawab')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Jumlah <span class="text-danger">*</span></label>
                <input type="number" name="jumlah"
                    value="{{ old('jumlah') }}"
                    class="form-control @error('jumlah') is-invalid @enderror"
                    placeholder="Masukkan jumlah stok">

                @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection