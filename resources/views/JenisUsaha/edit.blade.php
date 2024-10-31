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

            <form action="{{ route('jenis-usaha.update', $jenisUsaha->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$jenisUsaha->name}}" id="floatingInput"
                        name="name" placeholder="Masukkan nama jenis usaha">
                    @error('name')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <label for="floatingInput">Nama Jenis Usaha</label>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <button type="submit" class="btn btn-success me-3">Simpan</button>
                    <button type="reset" class="btn btn-danger text-white">Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
