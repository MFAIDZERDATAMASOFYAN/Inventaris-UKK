@extends('layouts/app')

@section('content')

<h1>{{$title}}</h1>

<form action="{{ route('kategoriupdate', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Laptop</label>
        <input type="text" name="nama_laptop" value="{{ $kategori->nama_laptop }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Penanggung Jawab</label>
        <input type="text" name="penanggung_jawab" value="{{ $kategori->penanggung_jawab }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" value="{{ $kategori->jumlah }}" class="form-control">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('kategori') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection