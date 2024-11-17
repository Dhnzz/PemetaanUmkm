@extends('layouts.layout')


@section('css')
@endsection

@section('content')
        <div class="row">
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jenis Usaha</h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center text-warning">
                                <i class="bi bi-pin-map"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $jenisUsaha->count() ?? '0'}}</h6>
                                <span class="text-warning small pt-1 fw-bold">Jumlah</span> <span
                                    class="text-muted small pt-2 ps-1">Jenis Usaha</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Sales Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">UMKM</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-shop-window"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $umkm->count() ?? '0' }}</h6>
                                <span class="text-primary small pt-1 fw-bold">Jumlah</span> <span
                                    class="text-muted small pt-2 ps-1">UMKM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sales Card -->
            {{-- <div class="col-xxl-12 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">UMKM</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-shop-window"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $umkmPemilik }}</h6>
                                <span class="text-primary small pt-1 fw-bold">Jumlah</span> <span
                                    class="text-muted small pt-2 ps-1">UMKM</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sales Card -->
        </div> --}}
@endsection
@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script> --}}
@endsection
