@extends('layouts.layout')
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $subtitle }}</h4>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                </ol>
            </nav>

            <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <!-- NIB -->
                <div class="mb-3">
                    <label for="modal_awal" class="form-label">Nama Usaha</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" id="name" name="name">
                    @error('name')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modal_awal" class="form-label">Nomor Induk Berusaha</label>
                    <input type="number" class="form-control @error('nib') is-invalid @enderror"
                        value="{{ old('nib') }}" id="nib" name="nib">
                    @error('nib')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <!-- SKU -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="sku" class="form-label">File SKU (PDF, max 1 MB)</label>
                        <input type="file" class="form-control @error('sku') is-invalid @enderror"
                            value="{{ old('sku') }}" id="sku" name="sku">
                    </div>
                    @error('sku')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- Foto Usaha -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="foto_usaha" class="form-label">Foto Usaha (PNG, JPG, JPEG, max 2 MB)</label>
                        <input type="file" class="form-control @error('foto_usaha') is-invalid @enderror"
                            value="{{ old('foto_usaha') }}" id="foto_usaha" name="foto_usaha">
                    </div>
                    @error('foto_usaha')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <!-- KTP -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="ktp" class="form-label">Fotokopi KTP (PNG, JPG, JPEG, max 2 MB)</label>
                        <input type="file" class="form-control @error('ktp') is-invalid @enderror"
                            value="{{ old('ktp') }}" id="ktp" name="ktp">
                    </div>
                    @error('ktp')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- KK -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="kk" class="form-label">Fotokopi Kartu Keluarga (PNG, JPG, JPEG, max 2 MB)</label>
                        <input type="file" class="form-control @error('kk') is-invalid @enderror"
                            value="{{ old('kk') }}" id="kk" name="kk">
                    </div>
                    @error('kk')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <!-- Jenis Usaha -->
                    <div class="col-12 col-sm-9 mb-3">
                        <label for="jenis_usaha_id" class="form-label">Jenis Usaha</label>
                        <select class="form-select @error('jenis_usaha_id') is-invalid @enderror"
                            value="{{ old('jenis_usaha_id') }}" id="jenis_usaha_id" name="jenis_usaha_id">
                            <option value="">Pilih jenis usaha...</option>
                            @foreach ($jenisUsaha as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('jenis_usaha_id')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- Tahun Berdiri -->
                    <div class="col-12 col-sm-3 mb-3">
                        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                        <input type="number" class="form-control @error('tahun_berdiri') is-invalid @enderror"
                            value="{{ old('tahun_berdiri') }}" id="tahun_berdiri" name="tahun_berdiri" placeholder="2023">
                    </div>
                    @error('tahun_berdiri')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <!-- Modal Awal -->
                <div class="mb-3">
                    <label for="modal_awal" class="form-label">Modal Awal (min Rp1.000)</label>
                    <input type="text" class="form-control @error('modal_awal') is-invalid @enderror"
                        value="{{ old('modal_awal') }}" id="modal_awal" name="modal_awal">
                </div>
                @error('modal_awal')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
                <div class="row">
                    <!-- No HP -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="no_hp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                            value="{{ old('no_hp') }}" id="no_hp" name="no_hp">
                    </div>
                    @error('no_hp')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- Tenaga Kerja -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="tenaga_kerja" class="form-label">Jumlah Tenaga Kerja</label>
                        <input type="number" class="form-control @error('tenaga_kerja') is-invalid @enderror"
                            value="{{ old('tenaga_kerja') }}" id="tenaga_kerja" name="tenaga_kerja" min="1">
                    </div>
                    @error('tenaga_kerja')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <!-- Pembayaran Digital -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input @error('pembayaran_digital') is-invalid @enderror"
                        value="{{ old('pembayaran_digital') }}" id="pembayaran_digital" name="pembayaran_digital" value="1">
                    <label class="form-check-label" for="pembayaran_digital">Menggunakan Pembayaran Digital</label>
                </div>
                <div class="col-12 mb-3">
                    <div id="map" style="height: 500px; width: 100%" class="rounded"></div>
                </div>
                <div class="row">
                    <!-- Latitude -->
                    <div class="col-6 col-sm-6 mb-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat"
                            name="lat" readonly>
                    </div>
                    @error('lat')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- Longitude -->
                    <div class="col-6 col-sm-6 mb-3">
                        <label for="long" class="form-label">Longitude</label>
                        <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng"
                            name="lng" readonly>
                    </div>
                    @error('lng')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var startLocation = [0.5648881614537785, 123.09171191998416];
        var map = L.map('map').setView(startLocation, 17);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker

        map.on('click', function(e) {
            var lat = e.latlng.lat
            var lng = e.latlng.lng

            document.getElementById('lat').value = lat
            document.getElementById('lng').value = lng

            if (marker) {
                map.removeLayer(marker)
            }

            marker = L.marker([lat, lng]).addTo(map)
        })
    </script>
    <script>
        $('#modal_awal').keyup(function (e) {
            var angka = $(this).val().replace(/Rp. /, '').replace(/\./g, '');
            angka = angka.replace(/\./g, '');
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            $(this).val('Rp. ' + rupiah);
        });
    </script>
@endpush
