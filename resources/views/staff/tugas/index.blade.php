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
        
    </div>
</div>
@endsection