@extends('layouts/app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>{{ $title }}
</h1>

<div class="card shadow">
    <div class="card-header bg-warning text-white">
        <a href="{{ route('tugas') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('tugasupdate', $tugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="form-group">
                <label>Nama User *</label>
                <input type="text" name="nama"
                    value="{{ old('nama', $tugas->nama) }}"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Masukkan nama user">

                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Laptop dari Kategori -->
            <div class="form-group">
                <label>Laptop *</label>
                <select name="laptop" class="form-control @error('laptop') is-invalid @enderror">
                    <option value="">-- Pilih Laptop --</option>

                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ $tugas->laptop == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_laptop }} (Stok: {{ $item->jumlah }})
                        </option>
                    @endforeach
                </select>

                @error('laptop')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"
                    placeholder="Masukkan keterangan">{{ old('keterangan', $tugas->keterangan) }}</textarea>
            </div>

            <div class="row">
                <!-- Tanggal Mulai -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Mulai *</label>
                        <input type="date" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $tugas->tanggal_mulai) }}"
                            class="form-control @error('tanggal_mulai') is-invalid @enderror">

                        @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal Selesai -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Selesai *</label>
                        <input type="date" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai', $tugas->tanggal_selesai) }}"
                            class="form-control @error('tanggal_selesai') is-invalid @enderror">

                        @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="mt-3">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection