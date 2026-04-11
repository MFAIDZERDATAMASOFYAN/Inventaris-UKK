@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>{{ $title }}
</h1>

<div class="card">
    <div class="card-header">
        <a href="{{ route('tugas') }}" class="btn btn-sm btn-success">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('tugasupdate', $tugas->id) }}" method="post">
            @csrf
            @method('PUT') <!-- penting untuk update -->

            <div class="row mb-3">
                <!-- Nama User -->
                <div class="col-md-12">
                    <label>Nama User *</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option selected disabled>--Pilih Nama--</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $tugas->user_id ? 'selected' : '' }}>
            {{ $user->nama }}
        </option>
    @endforeach
</select>
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <!-- Laptop -->
                <div class="col-md-12">
                    <label>Laptop *</label>
                    <select name="laptop" class="form-control @error('laptop') is-invalid @enderror">
                        <option selected disabled>--Pilih Laptop--</option>
                        <option value="HP" {{ $tugas->laptop == 'HP' ? 'selected' : '' }}>HP</option>
                        <option value="Lenovo" {{ $tugas->laptop == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                        <option value="Acer" {{ $tugas->laptop == 'Acer' ? 'selected' : '' }}>Acer</option>
                    </select>
                    @error('laptop')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <!-- Tanggal Mulai -->
                <div class="col-md-6">
                    <label>Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        value="{{ $tugas->tanggal_mulai }}">
                    @error('tanggal_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <!-- Tanggal Selesai -->
                <div class="col-md-6">
                    <label>Tanggal Selesai *</label>
                    <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                        value="{{ $tugas->tanggal_selesai }}">
                    @error('tanggal_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="fas fa-edit mr-1"></i> Update
            </button>
        </form>
    </div>
</div>

@endsection