<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$profile->name}} | @yield('title-page')</title>
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
    <link
			rel="stylesheet"
			type="text/css"
			href="{{ asset('assets/plugins/fancybox/dist/jquery.fancybox.css') }}"
		/>
     @yield('css')
     <style>
        .navbar-badge {
            font-size: 0.8rem !important;
        }
     </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container-fluid">
                <a href="{{ url('sales') }}" class="navbar-brand">
                    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle" style="opacity: .8">
                    <span class="brand-text">{{$profile->name}}</span>
                </a>
                @if (Request::path() != "sales-cart-list")
                <a href="{{ url('/home') }}" class="nav-link">
                    <p class=" text-muted"> <i class="nav-icon fas fa-arrow-left"></i> {{ __('app.dashboard') }}</p>
                </a>
                @else
                <a href="{{ url('/sales') }}" class="nav-link">
                    <p class=" text-muted"><i class="fas fa-arrow-left"></i> {{ __('app.btn_back') }}</p>
                </a>
                @endif
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            <i class="far fa-calendar-alt"></i><small id="date"></small>
                            <i class="far fa-clock"></i><small id="time"></small>
                        </a>
                    </li>
                    @if (Request::path() != "sales-cart-list")
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                            <i class="fas fa-cart-plus"></i>
                            <p class="badge badge-danger navbar-badge">@yield('count')</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ url('sales-cart-list') }}">
                            <i class="fas fa-chart-bar"></i>
                            <p class="badge badge-warning navbar-badge">@yield('countSales')</p>
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
                                            {{ Auth::user()->name }}
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
                    @endif 
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class=" container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @yield('control-sidebar')
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
