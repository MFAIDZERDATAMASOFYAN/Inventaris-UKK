@extends('layouts/app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"> <i class="fas fa-user mr-2"></i>{{$title}}</h1>

<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        @if (auth()->user()->jabatan == 'Karyawan')
        <div class="mb-1 mr-2">
            <a href="{{ route('tugascreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah Data</a>
        </div>
        @endif
        <div>
            <a href="{{ route('tugasexcel') }}" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-1"></i>
                Excel</a>
            <a href="{{ route('tugaspdf') }}" class="btn btn-sm btn-danger">
                <i class="fas fa-file-pdf mr-1"></i>
                Pdf</a>
        </div>
    </div>
    <div class="card-body">
        {{-- ALERT --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Laptop</th>
                        <th>Penanggung Jawab</th>
                        <th>Keterangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration}}</td>
                        <td class="text-center">{{ $item->nama }}</td>
                        <td class="text-center">
                            {{ $item->kategori->nama_laptop ?? '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->kategori->penanggung_jawab ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->keterangan ?? '-' }}
                        </td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $item->tanggal_mulai }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $item->tanggal_selesai }}</span>
                        </td>
                        <td>
                            @if($item->status == 'pending')
                            <span class="badge bg-warning text-white">Pending</span>
                            @elseif($item->status == 'disetujui')
                            <span class="badge bg-success text-white">Disetujui</span>
                            @elseif($item->status == 'dipinjam')
                            <span class="badge bg-primary text-white">Dipinjam</span>
                            @elseif($item->status == 'terlambat')
                            <span class="badge bg-danger text-white">Terlambat</span>
                            @elseif($item->status == 'selesai')
                            <span class="badge bg-secondary text-white">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">

                            <!-- @if(auth()->user()->jabatan == 'Karyawan')
                            <a href="{{ route('tugasedit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas about fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                <i class="fas fa-trash"></i></button>
                            @else

                            <form action="{{ route('tugas.approve', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>

                            <form action="{{ route('tugas.reject', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif -->

                            @if(auth()->user()->jabatan == 'Karyawan')

                            {{-- PINJAM --}}
                            @if($item->status == 'disetujui')
                            <form action="{{ route('tugas.pinjam', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-hand-holding"></i>
                                </button>
                            </form>

                            {{-- PENDING / REJECT --}}
                            @elseif(in_array($item->status, ['pending', 'reject']))
                            <a href="{{ route('tugasedit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            {{-- DIPINJAM & TERLAMBAT --}}
                            @elseif(in_array($item->status, ['dipinjam', 'terlambat']))

                            @if($item->status == 'terlambat')
                            <span class="badge bg-danger text-white">Terlambat</span>
                            @endif

                            <form action="{{ route('tugas.kembali', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>

                            {{-- SELESAI --}}
                            @elseif($item->status == 'selesai')
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif

                            @else

                            {{-- JIKA MASIH PENDING --}}
                            @if($item->status == 'pending')

                            <!-- Approve -->
                            <form action="{{ route('tugas.approve', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>

                            <!-- Reject -->
                            <form action="{{ route('tugas.reject', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>

                            {{-- JIKA SUDAH DISETUJUI --}}
                            @elseif($item->status == 'disetujui')

                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            </a>
                            @endif

                            @endif
                            @include('admin/tugas/modal')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection