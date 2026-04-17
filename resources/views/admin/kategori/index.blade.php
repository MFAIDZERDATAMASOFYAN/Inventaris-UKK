@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-laptop mr-2"></i>{{ $title }}
</h1>

<div class="card shadow mb-4">
    
    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <div class="mb-2">
            <a href="{{ route('kategoricreate') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Kategori
            </a>
        </div>

        <div>
            <a href="{{ route('kategoriexcel') }}" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </a>

            <a href="{{ route('kategoripdf') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>
        </div>
    </div>

    <!-- Body -->
    <div class="card-body">

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Laptop</th>
                        <th>Penanggung Jawab</th>
                        <th>Dipinjam</th>
                        <th>Dikembalikan</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="font-weight-bold">
                            {{ $item->nama_laptop }}
                        </td>

                        <td>
                            <span class="badge badge-info px-3 py-2">
                                {{ $item->penanggung_jawab }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-primary px-3 py-2">
                                {{ $item->jumlah_dipinjam ?? 0 }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-success px-3 py-2">
                                {{ $item->jumlah_dikembalikan ?? 0 }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-dark px-3 py-2">
                                {{ $item->jumlah }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('kategoriedit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('kategoridestroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="text-center text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                Data belum tersedia
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection