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

            <div class="d-flex flex-column col-sm-8 col-12">
                <div class="row justify-content-center align-items-center g-2 mb-2">
                    <div class="col-5 col-sm-3">Nama UMKM</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $umkm->name }}</div>
                </div>
                <div class="row justify-content-center align-items-center g-2 mb-2">
                    <div class="col-5 col-sm-3">Jenis Usaha</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $umkm->jenis_usaha->name }}</div>
                </div>
                <div class="row justify-content-center align-items-center g-2 mb-2">
                    <div class="col-5 col-sm-3">Tahun Berdiri</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $umkm->tahun_berdiri }}</div>
                </div>
            </div>
            <hr class="border border-1 opacity-75">
            <div class="d-flex flex-column flex-sm-row justify-content-start">
                <div class="d-flex flex-column col-sm-8 col-12">
                    <div class="row justify-content-start align-items-center g-2 mb-2">
                        <div class="col-5 col-sm-3">Modal Awal</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto">@currency($umkm->modal_awal)</div>
                    </div>
                    <div class="row justify-content-start align-items-center g-2 mb-2">
                        <div class="col-5 col-sm-3">Nomor Telepon</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto">@phone($umkm->pemilik->no_hp)</div>
                    </div>
                    <div class="row justify-content-start align-items-center g-2 mb-2">
                        <div class="col-5 col-sm-3">Jumlah Tenaga Kerja</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto">{{ $umkm->tenaga_kerja }} Orang</div>
                    </div>
                    <div class="row justify-content-start align-items-center g-2 mb-2">
                        <div class="col-5 col-sm-3">Pembayaran Digital</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto text-wrap">
                            {{ $umkm->pembayaran_digital == 0 ? 'Tidak tersedia' : 'Tersedia' }}
                        </div>
                    </div>

                    <div class="row justify-content-start align-items-center g-2 mb-3">
                        <div class="col-5 col-sm-3">Dokumen</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto d-flex flex-wrap gap-1 flex-column flex-sm-row">
                            <button type="button" class="btn btn-primary btn-sm" id="pdfModal"
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#modalId">
                                Lihat SKU
                            </button>
                            <button type="button" class="btn btn-success btn-sm" id="ktpModalButton"
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#ktpModal">
                                Lihat KTP
                            </button>
                            <button type="button" class="btn btn-warning btn-sm text-white" id="kkModalButton"
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#kkModal">
                                Lihat KK
                            </button>
                            <button type="button" class="btn btn-info btn-sm text-white" id="fotoUsahaModalButton"
                                data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal"
                                data-bs-target="#fotoUsahaModal">
                                Lihat Foto Usaha
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div id="map-show" style="height: 500px; width: 100%" class="rounded"></div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

            @if (Auth::user()->role === 'pemilik')
                <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-warning text-white">Edit</a>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script>
        var umkmData = @json($umkm);
        var startLocation = [umkmData.lat, umkmData.long];
        var map = L.map('map-show').setView(startLocation, 17);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker;

        marker = L.marker([umkmData.lat, umkmData.long]).addTo(map);


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
@endpush
