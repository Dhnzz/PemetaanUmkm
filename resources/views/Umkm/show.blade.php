@extends('layouts.layout')
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

            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-2">Nama UMKM</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $umkm->name }}</div>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-2">Nomor Induk Berusaha</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $umkm->nib }}</div>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-2">Tahun Berdiri</div>
                <div class="col-auto">:</div>
                <div class="col">{{ $umkm->tahun_berdiri }}</div>
            </div>
            <hr class="border border-1 opacity-75">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-5 col-sm-2">SKU</div>
                <div class="col-auto">:</div>
                <div class="col">
                    <button type="button" class="btn btn-primary btn-sm" id="pdfModal" data-modal="{{ json_encode($umkm) }}" data-bs-toggle="modal" data-bs-target="#modalId">
                        Lihat
                    </button>
                </div>
            </div>

            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
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

            <a href="{{ route('jenis-usaha.edit', $umkm->id) }}" class="btn btn-warning text-white">Edit</a>
        </div>
    </div>
@endsection
@push('script')
    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modalId"),
            options,
        );
    </script>
    <script>
        var base = "{{ asset('uploads/SKU') }}"
        $(document).ready(function(){
            $('#pdfModal').click(function(){
                var umkm = $(this).data('modal')
                $('#framePdf').attr('src',base+'/'+umkm.sku)
                $('#modalTitleId').text(
                    'Surat Keterangan Usaha Milik : '+umkm.name
                )
                console.log(umkm.sku);
            })
        })
    </script>
@endpush
