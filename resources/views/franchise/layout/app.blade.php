<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- MDB icon -->
      <link rel="icon" href="{{ asset('img/Health.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    <!-- {{-- DataTables CSS --}} -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #2ecc71;
            --info: #4cc9f0;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #343a40;
            --card-radius: 0.75rem;
            --transition: all 0.3s ease;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            color: #fff;
        }
    </style>
</head>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-gradient-primary">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen text-light"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit text-light"
                                style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-md-inline text-light">Pathlab Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::Menu Body-->
                            <li class="user-body">
                                <a href="{{ route('franchise.profile') }}">Profile</a>
                            </li>
                            <li class="user-body">
                                <a href="{{ route('franchise-logout') }}">Logout</a>
                            </li>
                            <!--end::Menu Body-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <aside class="app-sidebar shadow bg-light border-end" data-bs-theme="light">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand d-flex align-items-center justify-content-center py-3 border-bottom">
                <a href="{{ route('franchise.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                    <span class="brand-text fw-bold text-primary fs-4">PathLab Management</span>
                </a>
                <button class="btn btn-sm btn-icon sidebar-toggle d-lg-none ms-2" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!--end::Sidebar Brand-->

            <!--begin::User Profile-->
            <div class="user-panel mt-3 pb-3 mb-2 d-flex align-items-center px-3 border-bottom">
                <div class="image">
                    <img src="{{ asset('storage/' . Auth::guard('franchise')->user()->franchise_image) }}"
                        class="rounded-circle shadow-sm" style="width: 42px; height: 42px; object-fit: cover;"
                        alt="User Image">
                </div>
                <div class="info ms-3">
                    <a href="{{ route('franchise.profile') }}" class="d-block text-decoration-none">
                        <span class="fw-semibold">{{ Auth::guard('franchise')->user()->lab_name }}</span>
                        <small class="d-block text-muted">{{ Auth::guard('franchise')->user()->city }}</small>
                    </a>
                </div>
            </div>
            <!--end::User Profile-->

            <!--begin::Sidebar Menu Wrapper-->
            <div class="sidebar-wrapper pt-2">
                <div class="px-3 mb-2">
                    <small class="text-uppercase text-muted fw-semibold">Main Navigation</small>
                </div>

                <nav>
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('franchise.dashboard') }}" class="nav-link {{ request()->routeIs('franchise.dashboard') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                </div>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Test Management -->
                        <li class="nav-item {{ request()->routeIs('franchise.test*') || request()->routeIs('franchise.add.test*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('franchise.test*') || request()->routeIs('franchise.add.test*') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-vial"></i>
                                </div>
                                <p>
                                    Test Management
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('franchise.test') }}" class="nav-link {{ request()->routeIs('franchise.test') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-list-ul"></i>
                                        <p>Tests List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('franchise.add.test') }}" class="nav-link {{ request()->routeIs('franchise.add.test') ? 'active' : '' }}">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>Add New Test</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Appointments -->
                        <li class="nav-item">
                            <a href="{{ route('franchise.appoint') }}" class="nav-link {{ request()->routeIs('franchise.appoint*') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                </div>
                                <p>Appointments</p>
                            </a>
                        </li>

                        <!-- Reports -->
                        <li class="nav-item">
                            <a href="{{ route('franchise.report') }}" class="nav-link {{ request()->routeIs('franchise.report*') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-file-medical-alt"></i>
                                </div>
                                <p>Test Reports</p>
                            </a>
                        </li>

                        <!-- Transactions -->
                        <li class="nav-item">
                            <a href="{{ route('franchise.transaction') }}" class="nav-link {{ request()->routeIs('franchise.transaction*') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                </div>
                                <p>Transactions</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>

                <!-- System Section -->
                <div class="px-3 mt-4 mb-2">
                    <small class="text-uppercase text-muted fw-semibold">System</small>
                </div>

                <nav>
                    <ul class="nav sidebar-menu flex-column">
                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="{{ route('franchise.profile') }}" class="nav-link {{ request()->routeIs('franchise.profile*') ? 'active' : '' }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                </div>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item mt-2">
                            <a href="{{ route('franchise-logout') }}" class="nav-link text-danger">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                </div>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--end::Sidebar Menu Wrapper-->
        </aside>
        <!--end::Sidebar-->

        <main class="app-main">
            <div class="content">
                @if(session('success'))
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success text-white">
                            <strong class="me-auto">Success</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </div>
        </main>


        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2026-20236&nbsp;
                <a href="#" class="text-decoration-none">Apex Tech</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->

    </div>

    <script src="{{ asset('js/mdb.umd.min.js') }}"></script>
   

    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
    <!-- sortablejs -->
    <script>
        const connectedSortables = document.querySelectorAll('.connectedSortable');
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: 'shared',
                handle: '.card-header',
            });
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>
    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
    <!--end::Script-->


</body>

</html>