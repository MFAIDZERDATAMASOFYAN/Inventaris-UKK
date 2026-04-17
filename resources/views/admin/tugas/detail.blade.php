@extends('layouts/app')

@section('content')

<h3>Detail Peminjaman</h3>

<div class="card p-3">
    <p><b>Nama:</b> {{ $tugas->nama }}</p>
    <p><b>Laptop:</b> {{ $tugas->kategori->nama_laptop }}</p>
    <p><b>Penanggung Jawab:</b> {{ $tugas->kategori->penanggung_jawab }}</p>
    <p><b>Keterangan:</b> {{ $tugas->keterangan }}</p>
    <p><b>Tanggal:</b> {{ $tugas->tanggal_mulai }} - {{ $tugas->tanggal_selesai }}</p>
    <p><b>Status:</b> {{ $tugas->status }}</p>
</div>

@endsection