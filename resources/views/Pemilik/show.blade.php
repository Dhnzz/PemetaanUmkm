@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $subtitle }}</h4>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.index') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                </ol>
            </nav>

            <h6 class="text-center">Informasi Pribadi</h6>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-3">Nomor Induk Berusaha</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $pemilik->nib }}</div>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-3">Nama Lengkap</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $pemilik->name }}</div>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-3">Nomor Telepon</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $pemilik->no_hp }}</div>
            </div>
            <hr class="border border-1 opacity-75">
            <h6 class="text-center">Akun</h6>
            <div class="row justify-content-center align-items-center g-2 mb-3">
                <div class="col-5 col-sm-3">Email</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $pemilik->user->email }}</div>
            </div>
            <a href="{{ route('pemilik.edit', $pemilik->id) }}" class="btn btn-warning text-white">Edit</a>
        </div>
    </div>
@endsection
