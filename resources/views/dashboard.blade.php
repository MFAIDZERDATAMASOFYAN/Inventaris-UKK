@extends('layouts/app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tachometer-alt mr-2"></i>{{ $title }}
</h1>

<div class="row">

    <!-- TOTAL USER -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total User
                    </div>
                    <div class="h5 font-weight-bold text-gray-800">
                        {{ $total_user }}
                    </div>
                </div>
                <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- TOTAL LAPTOP -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Laptop
                    </div>
                    <div class="h5 font-weight-bold text-gray-800">
                        {{ $total_kategori }}
                    </div>
                </div>
                <i class="fas fa-laptop fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- TOTAL STOK -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        Total Stok
                    </div>
                    <div class="h5 font-weight-bold text-gray-800">
                        {{ $total_stok }}
                    </div>
                </div>
                <i class="fas fa-box fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- TOTAL PEMINJAMAN -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Total Peminjaman
                    </div>
                    <div class="h5 font-weight-bold text-gray-800">
                        {{ $total_tugas }}
                    </div>
                </div>
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

</div>

<!-- STATUS -->
<div class="row">

    <!-- DIPINJAM -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Sedang Dipinjam
                </div>
                <div class="h4 font-weight-bold">{{ $dipinjam }}</div>
            </div>
        </div>
    </div>

    <!-- PENDING -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Pending
                </div>
                <div class="h4 font-weight-bold">{{ $pending }}</div>
            </div>
        </div>
    </div>

    <!-- SELESAI -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Selesai
                </div>
                <div class="h4 font-weight-bold">{{ $selesai }}</div>
            </div>
        </div>
    </div>

</div>

@endsection