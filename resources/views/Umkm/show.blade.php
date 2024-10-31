@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $subtitle }}</h4>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jenis-usaha.index') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                </ol>
            </nav>

            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-2">Nama Jenis Usaha</div>
                <div class="col-auto">:</div>
                <div class="col">{{$jenisUsaha->name}}</div>
            </div>
            <hr class="border border-1 opacity-75">
            <a href="{{route('jenis-usaha.edit', $jenisUsaha->id)}}" class="btn btn-warning text-white">Edit</a>
        </div>
    </div>
@endsection
