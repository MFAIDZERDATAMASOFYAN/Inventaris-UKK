@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"> <i class="fas fa-user mr-2"></i>{{$title}}</h1>

<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('tugascreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah Data</a>
        </div>
        <div>
            <a href="{{ route('userexcel') }}" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-1"></i>
                Excel</a>
            <a href="{{ route('userpdf') }}" class="btn btn-sm btn-danger">
                <i class="fas fa-file-pdf mr-1"></i>
                Pdf</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration}}</td>
                        <td class="text-center">{{ $item->user->nama}}</td>
                        <td class="text-center">{{ $item->tugas}}</td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $item->tanggal_mulai }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $item->tanggal_selesai }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('useredit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas about fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @include('admin/user/modal')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection