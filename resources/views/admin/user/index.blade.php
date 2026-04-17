@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"> <i class="fas fa-user mr-2"></i>{{$title}}</h1>

<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('usercreate') }}" class="btn btn-sm btn-primary">
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
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration}}</td>
                        <td class="text-center">{{ $item->nama}}</td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $item->email}}</span>
                        </td>
                        <td class="text-center">
                            @if ($item->jabatan == 'Admin')
                            <span class="badge badge-warning">{{ $item->jabatan}}</span>
                            @else
                            <span class="badge badge-dark">{{ $item->jabatan}}</span>
                            @endif
                        </td>
                        <!-- <td class="text-center">
                            @if (auth()->user()->jabatan == 'Karyawan')
                            <span class="badge badge-danger">Approver</span>
                            @else
                            <span class="badge badge-success">Staff</span>
                            @endif
                        </td> -->
                        <td class="text-center">
                            @if($item->last_login && \Carbon\Carbon::parse($item->last_login)->diffInMinutes(now()) < 5)
                                <span class="badge badge-success">● Online</span>
                                @else
                                <span class="badge badge-secondary">
                                    Last seen {{ \Carbon\Carbon::parse($item->last_login)->diffForHumans() }}
                                </span>
                                @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('useredit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas about fa-edit"></i>
                            </a>
                            @php
                            $isOnline = $item->last_login && \Carbon\Carbon::parse($item->last_login)->diffInMinutes(now()) < 5;
                                @endphp

                                @if(!$isOnline)
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                                </button>
                                @endif
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