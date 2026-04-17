@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus mr-2"></i>{{ $title }}
</h1>

<div class="card">
    <div class="card-header">
        <a href="{{ route('tugas') }}" class="btn btn-sm btn-success">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('tugasstore') }}" method="post">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label>Nama User *</label>
                <input type="text" name="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Masukkan nama user">

                @error('nama')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Laptop (Kategori) -->
            <div class="mb-3">
                <label>Laptop *</label>
                <select name="laptop" class="form-control">
                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama_laptop }}
                        (Stok: {{ $item->jumlah }})
                        - PJ: {{ $item->penanggung_jawab }}
                    </option>
                    @endforeach
                </select>

                @error('laptop')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Untuk presentasi / kerja">
            </div>

            <!-- Tanggal -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai"
                        class="form-control @error('tanggal_mulai') is-invalid @enderror">
                    @error('tanggal_mulai')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>Tanggal Selesai *</label>
                    <input type="date" name="tanggal_selesai"
                        class="form-control @error('tanggal_selesai') is-invalid @enderror">
                    @error('tanggal_selesai')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>

        </form>
    </div>
</div>

@endsection