<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'STR Funiture') }} | @yield('title-page')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <style>
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
        }
    </style>
     @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="far fa-calendar-alt"></i><small id="date"></small>
                        <i class="far fa-clock"></i><small id="time"></small>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ asset('images/avatar.png') }}" alt="User Avatar"
                            class="img-size-40 img-thumbnail mr-1 img-circle" width="40px !important"
                            style="margin-top: -8px;">

                        <strong>{{ Auth::user()->name }}</strong>
                        <i class="fas fa-angle-down right"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('images/avatar.png') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="far fa-circle nav-icon"></i>
                            Profile Info
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="far fa-circle nav-icon"></i>
                            Languages
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="far fa-circle nav-icon"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-2">
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="STR Furniture"
                    class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text font-weight-light">STR Furniture</span>
            </a>

            <div class="sidebar">
                <nav>
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent mb-5" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header mt-2">
                            <h6>{{ __('app.menu') }}</h6>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('home') }}" class="nav-link {{ Request::is('home') ? 'active' : null }}">
                                <i class="nav-icon fas fa-th-large"></i>
                                <span>
                                    {{ __('app.dashboard') }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-solar-panel"></i>
                                <p>
                                    {{ __('app.sale_dashboard') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('staff-info*') || Request::is('positions*')|| Request::is('workplace*') || Request::is('base-salary*') || Request::is('payroll*') ? 'menu-is-opening menu-open' : null }} ">
                            <a href="#" class="nav-link {{ Request::is('staff-info*') || Request::is('positions*')|| Request::is('workplace*')|| Request::is('base-salary*') || Request::is('payroll*') ? 'active' : null }} ">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{ __('app.staff_management') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/staff-info') }}" class="nav-link {{ Request::is('staff-info*') ? 'active' : null }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.staff_info') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('positions') }}" class="nav-link {{ Request::is('positions*') ? 'active' : null }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.position') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/workplace') }}" class="nav-link {{ Request::is('workplace*') ? 'active' : null }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.work_place') }}</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ url('base-salary') }}" class="nav-link {{ Request::is('base-salary*') ? 'active' : null }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.base_salary') }}</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ url('payroll') }}" class="nav-link {{ Request::is('payroll*') ? 'active' : null }} ">
                                        <i class="fas fa-dollar-sign nav-icon"></i>
                                        <p>{{ __('app.payroll') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('attendances') }}" class="nav-link {{ Request::is('attendances*') ? 'active' : null }} ">
                                <i class="nav-icon fas fa-business-time"></i>
                                <p>
                                    {{ __('app.attendance') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    {{ __('app.sales') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>
                                    {{ __('app.stock') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    {{ __('app.income_expend') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('incomes') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.income_info') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('expends') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.expend_info') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{ __('app.user_management') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/search/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.user_info') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/search/enhanced.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.role_permission') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Request::is('income-options*') || Request::is('expend-options*') || Request::is('times*')  ? 'menu-is-opening menu-open' : null }} ">
                            <a href="#" class="nav-link {{ Request::is('income-options*') || Request::is('expend-options*') || Request::is('times*')  ? 'active' : null }} ">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    {{ __('app.settings') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('income-options') }}" class="nav-link {{ Request::is('income-options*') ? 'active' : null }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.income_options') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('expend-options') }}" class="nav-link {{ Request::is('expend-options*') ? 'active' : null }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('app.expend_options') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('times') }}" class="nav-link {{ Request::is('times*') ? 'active' : null }} ">
                                        <i class="far fa-clock nav-icon"></i>
                                        <p>{{ __('app.time') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title-page')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
        </div>
        </section>
    </div>
    <footer class="mt-3">
    </footer>

    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
            })

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })

            $('#datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "language":{
                    "sProcessing":     "ដំណើរការ...",
                    "sLengthMenu":     "បង្ហាញ _MENU_ ទិន្នន័យ",
                    "sZeroRecords":    "មិនមានទិន្នន័យនៅក្នុងតារាងនេះទេ។",
                    "sEmptyTable":     "មិនមានទិន្នន័យនៅក្នុងតារាងនេះទេ។",
                    "sInfo":           "បង្ហាញ _START_ ទៅ _END_ នៃ _TOTAL_ ទិន្នន័យ",
                    "sInfoEmpty":      "បង្ហាញកំណត់ត្រាពី 0 ដល់ 0 ក្នុងចំណោមកំណត់ត្រាសរុប 0",
                    "sInfoFiltered":   "(ការត្រងចេញពីកំណត់ត្រាសរុប _MAX_)",
                    "sInfoPostFix":    "",
                    "sSearch":         "ស្វែងរកទិន្នន័យ:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "ដំណើរការ...",
                    "oPaginate": {
                        "sFirst":    "ដំបូង",
                        "sLast":     "ចុងក្រោយ",
                        "sNext":     "បន្ត",
                        "sPrevious": "ថយក្រោយ"
                    },
                    "oAria": {
                        "sSortAscending":  ": ធ្វើឱ្យសកម្មដើម្បីតម្រៀបជួរឈរតាមលំដាប់ឡើង",
                        "sSortDescending": ": ធ្វើឱ្យសកម្មដើម្បីតម្រៀបជួរឈរតាមលំដាប់ចុះ"
                    }
                },
            });
        });

        function showTime() {

            var myDate = new Date();

            let daysList = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let monthsList = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Aug', 'Oct', 'Nov', 'Dec'];

            let date = myDate.getDate();
            let month = monthsList[myDate.getMonth()];
            let year = myDate.getFullYear();
            let day = daysList[myDate.getDay()];

            let today = `${day}, ${date} ${month} ${year}`;

            let amOrPm;
            let twelveHours = function() {
                if (myDate.getHours() > 12) {
                    amOrPm = 'PM';
                    let twentyFourHourTime = myDate.getHours();
                    let conversion = twentyFourHourTime - 12;
                    return `${conversion}`

                } else {
                    amOrPm = 'AM';
                    return `${myDate.getHours()}`
                }
            };
            let hours = twelveHours();
            let minutes = myDate.getMinutes();
            let seconds = myDate.getSeconds();

            let currentTime = `${hours}:${minutes}:${seconds} ${amOrPm}`;
            document.getElementById('date').innerHTML = ' ' + today + ' ';
            document.getElementById('time').innerHTML = ' ' + currentTime;
        }
        setInterval(showTime, 1000);
    </script>
</body>

</html>
