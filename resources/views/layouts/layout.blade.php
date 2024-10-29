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


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
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
                        <img src="{{asset('assetsDashboard/img/default.png')}}"
                            alt="Profile" class="rounded-circle">
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2 text-capitalize">Role</span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 class="text-capitalize">
                                User Name
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="
                                {{-- @if (auth()->user()->role == 'pegawai') @elseif (auth()->user()->role == 'petani')
                                {{ route('petani.show', auth()->user()->petani->id) }} @endif --}}
                                ">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="
                                {{-- @if (auth()->user()->role == 'pegawai') @elseif (auth()->user()->role == 'petani')
                                {{ route('petani.edit', auth()->user()->petani->id) }} @endif --}}
                                ">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
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
                        href="{{route('jenis-usaha.index')}}">
                        <i class="fa-solid fa-user"></i>
                        <span>Jenis Usaha</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('umkm*') ? 'active' : 'collapsed' }}" href="{{route('umkm.index')}}">
                        <i class="fa-solid fa-shop"></i>
                        <span>UMKM</span>
                    </a>
                </li> --}}

            <!-- End Dashboard Nav -->

            {{-- <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#components-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Components</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul
                        id="components-nav"
                        class="nav-content collapse "
                        data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="components-alerts.html">
                                <i class="bi bi-circle"></i>
                                <span>Alerts</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-accordion.html">
                                <i class="bi bi-circle"></i>
                                <span>Accordion</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-badges.html">
                                <i class="bi bi-circle"></i>
                                <span>Badges</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-breadcrumbs.html">
                                <i class="bi bi-circle"></i>
                                <span>Breadcrumbs</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-buttons.html">
                                <i class="bi bi-circle"></i>
                                <span>Buttons</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-cards.html">
                                <i class="bi bi-circle"></i>
                                <span>Cards</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-carousel.html">
                                <i class="bi bi-circle"></i>
                                <span>Carousel</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-list-group.html">
                                <i class="bi bi-circle"></i>
                                <span>List group</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-modal.html">
                                <i class="bi bi-circle"></i>
                                <span>Modal</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-tabs.html">
                                <i class="bi bi-circle"></i>
                                <span>Tabs</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-pagination.html">
                                <i class="bi bi-circle"></i>
                                <span>Pagination</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-progress.html">
                                <i class="bi bi-circle"></i>
                                <span>Progress</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-spinners.html">
                                <i class="bi bi-circle"></i>
                                <span>Spinners</span>
                            </a>
                        </li>
                        <li>
                            <a href="components-tooltips.html">
                                <i class="bi bi-circle"></i>
                                <span>Tooltips</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Components Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#forms-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-journal-text"></i>
                        <span>Forms</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="forms-elements.html">
                                <i class="bi bi-circle"></i>
                                <span>Form Elements</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms-layouts.html">
                                <i class="bi bi-circle"></i>
                                <span>Form Layouts</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms-editors.html">
                                <i class="bi bi-circle"></i>
                                <span>Form Editors</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms-validation.html">
                                <i class="bi bi-circle"></i>
                                <span>Form Validation</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Forms Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#tables-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-layout-text-window-reverse"></i>
                        <span>Tables</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="tables-general.html">
                                <i class="bi bi-circle"></i>
                                <span>General Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables-data.html">
                                <i class="bi bi-circle"></i>
                                <span>Data Tables</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Tables Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#charts-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-bar-chart"></i>
                        <span>Charts</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="charts-chartjs.html">
                                <i class="bi bi-circle"></i>
                                <span>Chart.js</span>
                            </a>
                        </li>
                        <li>
                            <a href="charts-apexcharts.html">
                                <i class="bi bi-circle"></i>
                                <span>ApexCharts</span>
                            </a>
                        </li>
                        <li>
                            <a href="charts-echarts.html">
                                <i class="bi bi-circle"></i>
                                <span>ECharts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Charts Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#icons-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-gem"></i>
                        <span>Icons</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="icons-bootstrap.html">
                                <i class="bi bi-circle"></i>
                                <span>Bootstrap Icons</span>
                            </a>
                        </li>
                        <li>
                            <a href="icons-remix.html">
                                <i class="bi bi-circle"></i>
                                <span>Remix Icons</span>
                            </a>
                        </li>
                        <li>
                            <a href="icons-boxicons.html">
                                <i class="bi bi-circle"></i>
                                <span>Boxicons</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Icons Nav -->

                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link" href="users-profile.html">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-faq.html">
                        <i class="bi bi-question-circle"></i>
                        <span>F.A.Q</span>
                    </a>
                </li>
                <!-- End F.A.Q Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-contact.html">
                        <i class="bi bi-envelope"></i>
                        <span>Contact</span>
                    </a>
                </li>
                <!-- End Contact Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-register.html">
                        <i class="bi bi-card-list"></i>
                        <span>Register</span>
                    </a>
                </li>
                <!-- End Register Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-login.html">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                </li>
                <!-- End Login Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-error-404.html">
                        <i class="bi bi-dash-circle"></i>
                        <span>Error 404</span>
                    </a>
                </li>
                <!-- End Error 404 Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-blank.html">
                        <i class="bi bi-file-earmark"></i>
                        <span>Blank</span>
                    </a>
                </li> --}}
            <!-- End Blank Page Nav -->

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
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        })
    </script>


    @stack('script')
</body>

</html>
