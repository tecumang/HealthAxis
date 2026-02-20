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
    <link rel="icon" href="{{ asset('img/pathlab_logo.jpg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
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
    <style>
        :root {
            --primary-color: #3f51b5;
            --secondary-color: #f50057;
            --light-bg: #f8f9fa;
            --card-border-radius: 12px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand text-light" style="background-color: #3f51b5">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list text-light"></i>
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
                            <span class="d-none d-md-inline text-light">Patients Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::Menu Body-->
                            <li class="user-body">
                                <a href="{{ route('patient.profile') }}" class="badge-danger">Profile</a>
                            </li>
                            <li class="user-body">
                                <a href="{{ route('patient-logout') }}" class="badge-danger">Logout</a>
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
            <aside class="app-sidebar shadow bg-light" data-bs-theme="light">
                <!--begin::Sidebar Brand-->
                <div class="sidebar-brand d-flex align-items-center justify-content-center py-3 border-bottom">
                    <a href="" class="brand-link text-decoration-none">
                        <i class="bi bi-clipboard2-pulse fs-4 me-2 text-primary"></i>
                        <span class="brand-text fw-medium fs-5">Patient HealthTrack</span>
                    </a>
                </div>
                <!--end::Sidebar Brand-->

                <!--begin::Sidebar Wrapper-->
                <div class="sidebar-wrapper px-2 py-3">
                    <div class="user-panel d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="info ms-3">
                            <span class="d-block text-dark">{{ Auth::guard('patients')->user()->name }}</span>
                            <small class="text-muted">ID:{{ Auth::guard('patients')->user()->id }}</small>
                        </div>
                    </div>

                    <nav>
                        <!--begin::Sidebar Menu-->
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                            <!-- Dashboard -->
                            <li class="nav-item mb-2">
                                <a href="{{route('patient.dashboard')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-speedometer2 me-2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <!-- Search Pathology -->
                            <li class="nav-item mb-2">
                                <a href="{{route('patient.Pathlab')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.Pathlab') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-search me-2"></i>
                                    <p>Find PathLab Services</p>
                                </a>
                            </li>

                            <!-- Tests Management -->
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="nav-icon bi bi-clipboard2-check"></i>
                                        <span>My Tests</span>
                                    </div>
                                    <i class="nav-arrow bi bi-chevron-down fs-6"></i>
                                </a>
                                <ul class="nav nav-treeview ps-4 mt-1">
                                    <li class="nav-item mb-1">
                                        <a href="{{route('patient.upcoming.test')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.upcoming.test') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-calendar-event me-2"></i>
                                            <p>Upcoming Tests</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('patient.history.test')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.history.test') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-clock-history me-2"></i>
                                            <p>Tests History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Transaction History -->
                            <li class="nav-item mb-2">
                                <a href="{{route('patient.payment')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.payment') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-credit-card me-2"></i>
                                    <p>Payment History</p>
                                </a>
                            </li>
                            
                            <!-- Reports -->
                            <li class="nav-item mb-2">
                                <a href="{{route('patient.history.test')}}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.history.test') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-text me-2"></i>
                                    <p>My Reports</p>
                                </a>
                            </li>
                            
                            <!-- Settings -->
                            <li class="nav-item">
                                <a href="{{ route('patient.profile') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('patient.profile') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-gear me-2"></i>
                                    <p>Account Settings</p>
                                </a>
                            </li>
                        </ul>
                        <!--end::Sidebar Menu-->
                    </nav>
                </div>
                <!--end::Sidebar Wrapper-->
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
                Copyright &copy; 2023-20233&nbsp;
                <a href="#" class="text-decoration-none">Octopyder</a>.
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
        document.addEventListener('DOMContentLoaded', function () {
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
                series: [
                {
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
    <!-- jsvectormap -->
    <script>
        const visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000, // Russia
  };

  // World map by jsVectorMap
  const map = new jsVectorMap({
    selector: '#world-map',
    map: 'world',
  });

  // Sparkline charts
  const option_sparkline1 = {
    series: [
      {
        data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
      },
    ],
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
  sparkline1.render();

  const option_sparkline2 = {
    series: [
      {
        data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
      },
    ],
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
  sparkline2.render();

  const option_sparkline3 = {
    series: [
      {
        data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
      },
    ],  
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
  sparkline3.render();
    </script>
    <!--end::Script-->


</body>

</html>