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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
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
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-md-inline">SuperAdmin Panel</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <p>
                                SuperAdmin Panel
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            <li class="user-body">
                                <a href="{{ route('admin-logout') }}">Logout</a>
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
        <aside class="app-sidebar shadow" data-bs-theme="light">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand d-flex align-items-center justify-content-center py-3 border-bottom">
                <!--begin::Brand Link-->
                <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center text-decoration-none">
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-bold text-primary fs-4">Admin Panel</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">    
                <nav class="mt-1">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="nav-header pt-2 pb-1 px-3 text-uppercase text-muted fs-7">Management</li>
                        
                        <!-- Franchise Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="nav-icon fas fa-building"></i>
                                    <span class="nav-text">Franchise</span>
                                </div>
                                <i class="fas fa-chevron-right nav-arrow small"></i>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.franchise') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list fa-sm"></i>
                                        <span class="nav-text">All Franchises</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.addfranchise') }}" class="nav-link">
                                        <i class="nav-icon fas fa-plus fa-sm"></i>
                                        <span class="nav-text">Add Franchise</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Patients Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="nav-icon fas fa-user-injured"></i>
                                    <span class="nav-text">Patients</span>
                                </div>
                                <i class="fas fa-chevron-right nav-arrow small"></i>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.patients') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list fa-sm"></i>
                                        <span class="nav-text">All Patients</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.addpatients') }}" class="nav-link">
                                        <i class="nav-icon fas fa-plus fa-sm"></i>
                                        <span class="nav-text">Add Patient</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Test Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="nav-icon fas fa-flask"></i>
                                    <span class="nav-text">Tests</span>
                                </div>
                                <i class="fas fa-chevron-right nav-arrow small"></i>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.test') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list fa-sm"></i>
                                        <span class="nav-text">Test List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Appointment Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <span class="nav-text">Appointments</span>
                                </div>
                                <i class="fas fa-chevron-right nav-arrow small"></i>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.appoinment') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list fa-sm"></i>
                                        <span class="nav-text">Appointment List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-header pt-2 pb-1 px-3 text-uppercase text-muted fs-7">Other</li>
                        
                        <!-- Query Management -->
                        <li class="nav-item">
                            <a href="{{ route('admin.query') }}" class="nav-link">
                                <i class="nav-icon fas fa-question-circle"></i>
                                <span class="nav-text">Queries</span>
                            </a>
                        </li>
                        
                        <!-- Transaction History -->
                        <li class="nav-item">
                            <a href="{{ route('admin.payment') }}" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <span class="nav-text">Transactions</span>
                            </a>
                        </li>
                        
                        <!-- Testimonial Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="nav-icon fas fa-comments"></i>
                                    <span class="nav-text">Testimonials</span>
                                </div>
                                <i class="fas fa-chevron-right nav-arrow small"></i>
                            </a>
                            <ul class="nav nav-treeview ps-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.testmonial') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list fa-sm"></i>
                                        <span class="nav-text">All Testimonials</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.testimonials.add') }}" class="nav-link">
                                        <i class="nav-icon fas fa-plus fa-sm"></i>
                                        <span class="nav-text">Add Testimonial</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
                
                <div class="mt-auto p-3 border-top">
                    <a href="{{ route('admin-logout') }}" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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