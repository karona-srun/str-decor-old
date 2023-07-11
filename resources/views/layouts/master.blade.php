<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name }} | @yield('title-page')</title>
    <meta name="csrf-token" id="csrf" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <link rel="shortcut icon" sizes="114x114" href="{{ url($profile->photo) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/fancybox/dist/jquery.fancybox.css') }}" />
    <style>
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
        }

        .pre-wrap {
            white-space: pre-wrap;
        }

        @page {
            size: A4;
            margin: 10mm 0mm;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        .div-with-scroll {
            height: max-content;
            overflow: scroll;
            overflow-x: hidden;
            padding: 10px;
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
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a href="{{ route('lang.switch', $lang) }}" class="text-white nav-link">
                                <img src="{{ asset(app()->getLocale() == 'en' ? '/images/en_flag.png' : '/images/km_flag.png') }}"
                                    class="img-size-32 mr-3" alt="language">
                            </a>
                        @endif
                    @endforeach
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span
                            class="badge badge-light bg-danger badge-xs navbar-badge" style="margin-top: -5px;font-size: 12px; padding: 4px 4px 1px 4px;">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right div-with-scroll">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <a href="{{ $notification->data['data'] == 'View sales' ? url("/mark-as-read/sales", $notification->id ) : url("/mark-as-read/quotes", $notification->id ) }}" class="dropdown-item">
                                <div class="media">
                                    <img src="{{ asset('images/avatar.png') }}" alt="User Avatar"
                                        class="img-size-32 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title text-sm mt-1">
                                            <i class="{{ $notification->data['data'] == 'View sales' ? "nav-icon fas fa-shopping-cart" : "nav-icon fas fa-hand-holding-usd"}}"></i>
                                        {{ __('app.label_received_notification') }} <br>
                                            {{ $notification->data['name'] }} {{ __('app.label_request') }}<strong>{{ $notification->data['data'] == 'View sales' ? __('app.sales') : __('app.quote') }}</strong>{{ __('app.label_to_you')}}
                                            <span class="float-right text-sm"><i class="far fa-clock"></i>
                                                {{ $notification->created_at->diffForHumans() }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="row">
                        @if (auth()->user()->unreadNotifications)
                        
                            @if (auth()->user()->unreadNotifications->count() != 0)
                            <div class="col-sm-12">
                                <a href="{{ route('mark-as-read') }}" class="text-primary dropdown-item">{{__('app.label_mask_all_as_Read')}}</a>
                                </div>
                                <div class="col-sm-12">
                                    <a href="{{ url('notification') }}" class="text-primary dropdown-item">{{__('app.label_all_notifications')}}</a>
                                </div>
                            @else
                            <div class="col-sm-12 col-md-12">
                                <a href="{{ route('mark-as-read') }}" class="text-muted dropdown-item">{{__('app.lable_no_notification')}}</a>
                                </div>
                            @endif
                        @endif
                        </div>
                    </div>
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
                                    <h3 class="dropdown-item-title mt-1">
                                        សួស្តី {{ Auth::user()->name }}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm text-muted mt-1"><i class="far fa-clock mr-1"></i>
                                        {{ Auth::user()->uptime }}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ url('users/profile', Auth::user()->id) }}" class="dropdown-item">
                            <i class="far fa-user-circle nav-icon"></i>
                            {{ __('app.label_profile') }}
                        </a>
                        {{-- <a href="#" class="dropdown-item">
                            <i class="far fa-circle nav-icon"></i>
                            Languages
                        </a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            {{ __('app.label_logout') }}
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
                <img src="{{ url($profile->photo) }}" alt="STR Furniture" class="brand-image img-circle"
                    style="opacity: .7">
                <span class="brand-text font-weight-light pre-wrap">{{ $profile->name }}</span>
            </a>

            <div class="sidebar">
                <nav>
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent mb-5" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <li class="nav-header mt-2">
                            <h6>{{ __('app.menu') }}</h6>
                        </li>
                        @can('Dashboard')
                            <li class="nav-item">
                                <a href="{{ url('home') }}"
                                    class="nav-link {{ Request::is('home') ? 'active' : null }}">
                                    <i class="nav-icon fas fa-th-large"></i>
                                    <p>
                                        {{ __('app.dashboard') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('Dashboard Sale')
                            <li class="nav-item">
                                <a href="{{ url('dashboard-sale') }}"
                                    class="nav-link {{ Request::is('dashboard-sale') ? 'active' : null }}">
                                    <i class="nav-icon fas fa-solar-panel"></i>
                                    <p>
                                        {{ __('app.sale_dashboard') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('Customer List')
                            <li class="nav-item">
                                <a href="{{ url('customers') }}"
                                    class="nav-link  {{ Request::is('customers*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        {{ __('app.customer_management') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @if (Auth::user()->can('Staff List') ||
                                Auth::user()->can('Position List') ||
                                Auth::user()->can('WorkPlace List') ||
                                Auth::user()->can('Payroll List'))
                            <li
                                class="nav-item {{ Request::is('staff-info*') || Request::is('positions*') || Request::is('workplace*') || Request::is('base-salary*') || Request::is('payroll*') ? 'menu-is-opening menu-open' : null }} ">
                                <a href="#"
                                    class="nav-link {{ Request::is('staff-info*') || Request::is('positions*') || Request::is('workplace*') || Request::is('base-salary*') || Request::is('payroll*') ? 'active' : null }} ">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        {{ __('app.staff_management') }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/staff-info') }}"
                                            class="nav-link {{ Request::is('staff-info*') ? 'active' : null }} ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('app.staff_info') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('positions') }}"
                                            class="nav-link {{ Request::is('positions*') ? 'active' : null }} ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('app.position') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/workplace') }}"
                                            class="nav-link {{ Request::is('workplace*') ? 'active' : null }} ">
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
                                        <a href="{{ url('payroll') }}"
                                            class="nav-link {{ Request::is('payroll*') ? 'active' : null }} ">
                                            <i class="fas fa-dollar-sign nav-icon"></i>
                                            <p>{{ __('app.payroll') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @can('Attandance List')
                            <li class="nav-item">
                                <a href="{{ url('attendances') }}"
                                    class="nav-link {{ Request::is('attendances*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-business-time"></i>
                                    <p>
                                        {{ __('app.attendance') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('Quote List')
                            <li class="nav-item">
                                <a href="{{ url('quotes') }}"
                                    class="nav-link {{ Request::is('quotes*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                    <p>
                                        {{ __('app.quote') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('Sale List')
                            <li class="nav-item">
                                <a href="{{ route('sales.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        {{ __('app.sales') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('sale-report') }}" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        {{ __('app.label_sale_report') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @if (Auth::user()->can('Product Category List') || Auth::user()->can('Product List'))
                            <li
                                class="nav-item {{ Request::is('product-category*') || Request::is('productes*') || Request::is('import-product*') ? 'menu-is-opening menu-open' : null }} ">
                                <a href="#"
                                    class="nav-link {{ Request::is('product-category*') || Request::is('productes*') || Request::is('import-product*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-cube"></i>
                                    <p>
                                        {{ __('app.stock') }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('Product Category List')
                                        <li class="nav-item">
                                            <a href="{{ url('product-category') }}"
                                                class="nav-link {{ Request::is('product-category*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.product_category') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Product List')
                                        <li class="nav-item">
                                            <a href="{{ url('/productes') }}"
                                                class="nav-link {{ Request::is('productes*') || Request::is('import-product*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.product') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('Revenue List') || Auth::user()->can('Expend List'))
                            <li
                                class="nav-item {{ Request::is('revenue*') || Request::is('expends*') ? 'menu-is-opening menu-open' : null }} ">
                                <a href="#"
                                    class="nav-link {{ Request::is('revenue*') || Request::is('expends*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-money-check-alt"></i>
                                    <p>
                                        {{ __('app.income_expend') }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('Revenue List')
                                        <li class="nav-item">
                                            <a href="{{ URL('/revenue?start_date=' .Carbon::now()->firstOfMonth()->toDateString() .'&end_date=' .Carbon::now()->lastOfMonth()->toDateString()) }}"
                                                class="nav-link {{ Request::is('revenue*') ? 'active' : null }} ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.income_info') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Expend List')
                                        <li class="nav-item">
                                            <a href="{{ url('expend?start_date=' .Carbon::now()->firstOfMonth()->toDateString() .'&end_date=' .Carbon::now()->lastOfMonth()->toDateString()) }}"
                                                class="nav-link {{ Request::is('expends*') ? 'active' : null }} ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.expend_info') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('User List') || Auth::user()->can('Role List'))
                            <li
                                class="nav-item {{ Request::is('users*') || Request::is('roles*') ? 'menu-is-opening menu-open' : null }} ">
                                <a href="#"
                                    class="nav-link {{ Request::is('users*') || Request::is('roles*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        {{ __('app.user_management') }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('User List')
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}"
                                                class="nav-link {{ Request::is('users*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.user_info') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Role List')
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}"
                                                class="nav-link {{ Request::is('roles*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.role_permission') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('Option Income List') ||
                                Auth::user()->can('Option Expend List') ||
                                Auth::user()->can('Time List') ||
                                Auth::user()->can('About List') ||
                                Auth::user()->can('System Profile List'))
                            <li
                                class="nav-item {{ Request::is('income-options*') || Request::is('expend-options*') || Request::is('times*') || Request::is('system-profile*') || Request::is('abouts*') ? 'menu-is-opening menu-open' : null }} ">
                                <a href="#"
                                    class="nav-link {{ Request::is('income-options*') || Request::is('expend-options*') || Request::is('times*') || Request::is('system-profile*') ? 'active' : null }} ">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        {{ __('app.settings') }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('System Profile List')
                                        <li class="nav-item">
                                            <a href="{{ url('system-profile') }}"
                                                class="nav-link {{ Request::is('system-profile*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.settings') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Option Income List')
                                        <li class="nav-item">
                                            <a href="{{ url('income-options') }}"
                                                class="nav-link {{ Request::is('income-options*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.income_options') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Option Expend List')
                                        <li class="nav-item">
                                            <a href="{{ url('expend-options') }}"
                                                class="nav-link {{ Request::is('expend-options*') ? 'active' : null }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('app.expend_options') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Time List')
                                        <li class="nav-item">
                                            <a href="{{ url('times') }}"
                                                class="nav-link {{ Request::is('times*') ? 'active' : null }} ">
                                                <i class="far fa-clock nav-icon"></i>
                                                <p>{{ __('app.time') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('About List')
                                        <li class="nav-item">
                                            <a href="{{ url('abouts') }}"
                                                class="nav-link {{ Request::is('abouts*') ? 'active' : null }} ">
                                                <i class="fas fa-newspaper nav-icon"></i>
                                                <p>{{ __('app.label_content') }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
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
                    @include('flash_message')
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
    <script src="{{ asset('assets/plugins/fancybox/dist/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        $(function() {
            $('#toastsContainerTopRight').delay(5000).fadeOut('slow');

            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });

            $('.select2').select2({
                theme: 'bootstrap4',
            });

            $('.select2s').select2({
                theme: 'bootstrap4',
                minimumResultsForSearch: Infinity,
            });

            if (document.documentElement.lang.toLowerCase() === "km") {
                $('#datatable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "language": {
                        "sProcessing": "ដំណើរការ...",
                        "sLengthMenu": "បង្ហាញ _MENU_ ទិន្នន័យ",
                        "sZeroRecords": "មិនមានទិន្នន័យនៅក្នុងតារាងនេះទេ។",
                        "sEmptyTable": "មិនមានទិន្នន័យនៅក្នុងតារាងនេះទេ។",
                        "sInfo": "បង្ហាញ _START_ ទៅ _END_ នៃ _TOTAL_ ទិន្នន័យ",
                        "sInfoEmpty": "បង្ហាញកំណត់ត្រាពី 0 ដល់ 0 ក្នុងចំណោមកំណត់ត្រាសរុប 0",
                        "sInfoFiltered": "(ការត្រងចេញពីកំណត់ត្រាសរុប _MAX_)",
                        "sInfoPostFix": "",
                        "sSearch": "ស្វែងរកទិន្នន័យ:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "ដំណើរការ...",
                        "oPaginate": {
                            "sFirst": "ដំបូង",
                            "sLast": "ចុងក្រោយ",
                            "sNext": "បន្ត",
                            "sPrevious": "ថយក្រោយ"
                        },
                        "oAria": {
                            "sSortAscending": ": ធ្វើឱ្យសកម្មដើម្បីតម្រៀបជួរឈរតាមលំដាប់ឡើង",
                            "sSortDescending": ": ធ្វើឱ្យសកម្មដើម្បីតម្រៀបជួរឈរតាមលំដាប់ចុះ"
                        }
                    },
                });
            } else {
                $('#datatable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "language": {
                        "sProcessing": "Progress...",
                        "sLengthMenu": "Show _MENU_ Records",
                        "sZeroRecords": "There is no data in this table.",
                        "sEmptyTable": "There is no data in this table.",
                        "sInfo": "Show _START_ to _END_ of _TOTAL_ Records",
                        "sInfoEmpty": "Show records from _START_ to _END_ out of _TOTAL_ Records",
                        "sInfoFiltered": "(Filtering out total records _MAX_)",
                        "sInfoPostFix": "",
                        "sSearch": "Search Records:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Progress...",
                        "oPaginate": {
                            "sFirst": "First",
                            "sLast": "Last",
                            "sNext": "Next",
                            "sPrevious": "Previous"
                        },
                        "oAria": {
                            "sSortAscending": ": Activate to sort rows in ascending order",
                            "sSortDescending": ": Activate to sort standing rows in descending order"
                        }
                    },
                });
            }
        });

        function showTime() {

            var myDate = new Date();

            let daysList = [],
                monthsList = [];
            if (document.documentElement.lang.toLowerCase() === "km") {
                daysList = ['ថ្ងៃអាទិត្យ', 'ថ្ងៃច័ន្ទ', 'ថ្ងៃអង្គារ៍', 'ថ្ងៃពុធ', 'ថ្ងៃព្រហស្បត្តិ៍', 'ថ្ងៃសុក្រ',
                    'ថ្ងៃសៅរ៍'
                ];
                monthsList = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា',
                    'វិច្ឆិកា', 'ធ្នូ'
                ];
            } else {
                daysList = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                monthsList = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Aug', 'Oct', 'Nov', 'Dec'];
            }
            let date = myDate.getDate();
            let month = monthsList[myDate.getMonth()];
            let year = myDate.getFullYear();
            let day = daysList[myDate.getDay()];

            let today = `${day}, ${date} ${month} ${year}`;

            let amOrPm;
            let twelveHours = function() {
                if (myDate.getHours() > 12) {
                    amOrPm = 'ល្ងាច';
                    let twentyFourHourTime = myDate.getHours();
                    let conversion = twentyFourHourTime - 12;
                    return `${conversion}`

                } else {
                    amOrPm = 'ព្រឹក';
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
