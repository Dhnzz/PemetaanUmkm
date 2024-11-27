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

            <form action="{{ route('pemilik.update', $pemilik->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <h6 class="text-center">Informasi Pribadi</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('nib') is-invalid @enderror" id="floatingInput"
                        name="nib" placeholder="Masukkan Nomor Induk Berusaha" value="{{ $pemilik->nib }}">
                    @error('nib')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <label for="floatingInput">Nomor Induk Berusaha</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                        name="name" placeholder="Masukkan nama lengkap pemilikk usaha" value="{{ $pemilik->name }}">
                    @error('name')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <label for="floatingInput">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="floatingInput"
                        name="no_hp" placeholder="Masukkan nama lengkap pemilikk usaha" value="{{ $pemilik->no_hp }}">
                    @error('no_hp')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <label for="floatingInput">Nomor Telepon</label>
                </div>
                <hr class="divider">
                <h6 class="text-center">Akun</h6>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="floatingInput" name="email" placeholder="Masukkan email"
                                value="{{ $pemilik->user->email }}">
                            @error('email')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                            <label for="floatingInput">Email</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="floatingInput" name="password" placeholder="Masukkan password">
                            @error('password')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                            <label for="floatingInput">Password</label>
                            <small class="text-danger"><span>*</span> Isi jika ingin mengubah password</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <button type="submit" class="btn btn-success me-3">Ubah</button>
                    <button type="reset" class="btn btn-danger text-white">Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
