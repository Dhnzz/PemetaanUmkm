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

            <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- NIB -->
                <div class="mb-3">
                    <label for="modal_awal" class="form-label">Nama Usaha</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $umkm->name }}" id="name" name="name">
                    @error('name')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modal_awal" class="form-label">Nomor Induk Berusaha</label>
                    <input type="number" class="form-control @error('nib') is-invalid @enderror"
                        value="{{ $umkm->nib }}" id="nib" name="nib">
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
                        <div class="input-group">
                            <input type="file" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <button type="button" class="btn btn-primary btn-sm" id="pdfModal" {{ ($umkm->sku == null)?'disabled':'' }}
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#modalId">
                                Lihat SKU
                            </button>
                        </div>
                    </div>
                    @error('sku')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- Foto Usaha -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="foto_usaha" class="form-label">Foto Usaha (PNG, JPG, JPEG, max 2 MB)</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('foto_usaha') is-invalid @enderror" id="foto_usaha"
                                name="foto_usaha"aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <button type="button" class="btn btn-primary btn-sm text-white" id="fotoUsahaModalButton" {{ ($umkm->foto_usaha == null)?'disabled':'' }}
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal"
                                data-bs-target="#fotoUsahaModal">
                                Lihat Foto
                            </button>
                        </div>
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
                        <div class="input-group">
                            <input type="file" class="form-control @error('ktp') is-invalid @enderror" id="ktp" name="ktp"aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <button type="button" class="btn btn-primary btn-sm" id="ktpModalButton" {{ ($umkm->ktp == null)?'disabled':'' }}
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#ktpModal">
                                Lihat KTP
                            </button>
                        </div>
                    </div>
                    @error('ktp')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                    <!-- KK -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="kk" class="form-label">Fotokopi Kartu Keluarga (PNG, JPG, JPEG, max 2 MB)</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk"aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <button type="button" class="btn btn-primary btn-sm text-white" id="kkModalButton" {{ ($umkm->kk == null)?'disabled':'' }}
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#kkModal">
                                Lihat KK
                            </button>
                        </div>
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
                        <select class="form-select @error('jenis_usaha_id') is-invalid @enderror" id="jenis_usaha_id" name="jenis_usaha_id">
                            <option value="">Pilih jenis usaha...</option>
                            @foreach ($jenisUsaha as $item)
                                <option value="{{ $item->id }}"
                                    {{ $umkm->jenis_usaha_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
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
                            value="{{ $umkm->tahun_berdiri }}" id="tahun_berdiri" name="tahun_berdiri"
                            placeholder="2023">
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
                        value="@currency($umkm->modal_awal)" id="modal_awal" name="modal_awal">
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
                            value="{{ $umkm->no_hp }}" id="no_hp" name="no_hp">
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
                            value="{{ $umkm->tenaga_kerja }}" id="tenaga_kerja" name="tenaga_kerja" min="1">
                    </div>
                    @error('tenaga_kerja')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <!-- Pembayaran Digital -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input @error('pembayaran_digital') is-invalid @enderror" id="pembayaran_digital" name="pembayaran_digital"
                        value="1" {{ $umkm->pembayaran_digital == 1 ? 'checked' : '' }}>
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
                            name="lat" readonly value="{{ $umkm->lat }}">
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
                            name="lng" readonly value="{{ $umkm->long }}">
                    </div>
                    @error('lng')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>





    {{-- SKU MODAL --}}
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skuModalTitle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ratio ratio-1x1">
                    <iframe id="framePdf" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- KTP MODAL --}}
    <div class="modal fade" id="ktpModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ktpModalTitle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ratio ratio-1x1">
                    <img id="frameKtp" class="img img-thumbnail" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- KK MODAL --}}
    <div class="modal fade" id="kkModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kkModalTitle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ratio ratio-1x1">
                    <img id="frameKK" class="img img-thumbnail" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Foto Usaha MODAL --}}
    <div class="modal fade" id="fotoUsahaModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoUsahaModalTitle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ratio ratio-1x1">
                    <img id="frameFotoUsaha" class="img img-thumbnail" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var umkmData = @json($umkm);
        var startLocation = [umkmData.lat, umkmData.long];
        var map = L.map('map').setView(startLocation, 17);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker
        marker = L.marker([umkmData.lat, umkmData.long]).addTo(map);

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




        var base = "{{ asset('uploads') }}"
        $(document).ready(function() {
            $('#pdfModal').click(function() {
                var umkm = $(this).data('modal')
                console.log(umkm.sku);

                $('#framePdf').attr('src', base + '/SKU/' + umkm.sku)
                $('#skuModalTitle').text(
                    'Surat Keterangan Usaha Milik : ' + umkm.name
                )
                const pdfModal = new bootstrap.Modal(
                    $("#ktpModal"),
                );
            })

            $('#ktpModalButton').click(function() {
                var umkm = $(this).data('modal')

                $('#frameKtp').attr('src', base + '/KTP/' + umkm.ktp)
                $('#ktpModalTitle').text(
                    'KTP Milik : ' + umkm.name
                )
                const ktpModal = new bootstrap.Modal(
                    $("#ktpModal"),
                );
            })

            $('#kkModalButton').click(function() {
                var umkm = $(this).data('modal')

                $('#frameKK').attr('src', base + '/KK/' + umkm.kk)
                $('#kkModalTitle').text(
                    'KK Milik : ' + umkm.name
                )
                const kkModal = new bootstrap.Modal(
                    $("#kkModal"),
                );
            })

            $('#fotoUsahaModalButton').click(function() {
                var umkm = $(this).data('modal')

                $('#frameFotoUsaha').attr('src', base + '/FotoUsaha/' + umkm.foto_usaha)
                $('#fotoUsahaModalTitle').text(
                    'Foto Usaha Milik : ' + umkm.name
                )
                const fotoUsahaModal = new bootstrap.Modal(
                    $("#fotoUsahaModal"),
                );
            })
        })
    </script>
    <script>
        $('#modal_awal').keyup(function(e) {
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
