<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard | Find UMKM</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/img/findUmkmLg.png" rel="icon">
    <link href="{{ asset('assetsDashboard') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assetsDashboard') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assetsDashboard') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assetsDashboard') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assetsDashboard') }}/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('assetsDashboard') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ asset('assetsDashboard') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
    {{-- <link href="{{ asset('assetsDashboard') }}/vendor/simple-datatables/style.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assetsDashboard') }}/css/style.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/d989f340c1.js" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    @stack('css')

    <!-- ======================================================= * Template Name:
        NiceAdmin - v2.4.1 * Template URL:
        https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ * Author:
        BootstrapMade.com * License: https://bootstrapmade.com/license/
        ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/FindUMKMLg.png" style="border-radius:50px;" alt="">
                <span class="d-none d-lg-block">Find <span class="text-primary">UMKM</span></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href=""
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assetsDashboard/img/default.png') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-capitalize">User</span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 class="text-capitalize">
                                {{Auth::user()->name}}
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="post" action="{{route('logout')}}" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                                </button>
                            </form>
                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->

            </ul>
        </nav>
        <!-- End Icons Navigation -->

    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : 'collapsed' }}"
                    href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('*/jenis-usaha*') ? 'active' : 'collapsed' }}"
                    href="{{ route('jenis-usaha.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Jenis Usaha</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('*/umkm*') ? 'active' : 'collapsed' }}"
                    href="{{ route('umkm.index') }}">
                    <i class="fa-solid fa-shop"></i>
                    <span>UMKM</span>
                </a>
            </li>
        </ul>

    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <!-- End Page Title -->

        <section class="section dashboard">
            @yield('content')
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright
            <strong>
                <span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form:
                https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by
            <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assetsDashboard') }}/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assetsDashboard') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assetsDashboard') }}/vendor/chart.js/chart.min.js"></script>
    <script src="{{ asset('assetsDashboard') }}/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('assetsDashboard') }}/vendor/quill/quill.min.js"></script>
    {{-- <script src="{{ asset('assetsDashboard') }}/vendor/simple-datatables/simple-datatables.js"></script> --}}
    <script src="{{ asset('assetsDashboard') }}/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('assetsDashboard') }}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assetsDashboard') }}/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        })
    </script>


    @stack('script')
</body>

</html>
