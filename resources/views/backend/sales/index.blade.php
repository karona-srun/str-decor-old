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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/fancybox/dist/jquery.fancybox.css') }}" />
    <style>
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
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
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container-fluid">
                <a href="{{ url('sales') }}" class="navbar-brand">
                    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name', 'STR Funiture') }}</span>
                </a>
                <a href="{{ url('/home') }}" class="nav-link">
                    <p class=" text-muted"> <i class="nav-icon fas fa-th-large"></i> {{ __('app.dashboard') }}</p>
                </a>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            <i class="far fa-calendar-alt"></i><small id="date"></small>
                            <i class="far fa-clock"></i><small id="time"></small>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-cart-plus"></i>
                            <span class="badge badge-danger navbar-badge">{{ $addCart->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Languages</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> Khmer
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> English
                            </a>
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
                                        <h3 class="dropdown-item-title">
                                            {{ Auth::user()->name }}
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <form action="{{ route('sales.index') }}" class="p-3 card card-primary card-outline"
                                    method="get">
                                    <p class="label-box">{{ __('app.label_search') }}{{ __('app.product') }}</p>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>{{ __('app.table_choose') }}</label>
                                                <select class="select2 form-control" name="product_category"
                                                    style="width: 100%">
                                                    <option value="">{{ __('app.table_choose') }}</option>
                                                    @foreach ($productCategory as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ Request::get('product_category') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>{{ __('app.code') }}{{ __('app.product') }}</label>
                                                <input type="text" class="form-control search_code"
                                                    name="product_code" value="{{ Request::get('product_code') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>{{ __('app.label_name') }}{{ __('app.product') }}</label>
                                                <input type="text" class="form-control" name="product_name"
                                                    value="{{ Request::get('product_name') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>.</label>
                                                <button type="submit"
                                                    class="form-control btn btn-primary">{{ __('app.btn_accepted') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row p-2 mt-4">
                                <div class="col-sm-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ __('app.table_no') }}</th>
                                            <th>{{ __('app.table_photo') }}</th>
                                            <th>{{ __('app.code') }}</th>
                                            <th>{{ __('app.product') }}</th>
                                            <th>{{ __('app.label_scale') }}</th>
                                            <th>{{ __('app.label_salling_price') }}</th>
                                            <th>{{ __('app.label_qty') }}</th>
                                            <th></th>
                                        </tr>
                                        <tbody>
                                            @foreach ($productes as $i => $item)
                                                <tr class="{{ $item->product_category_id }}">
                                                    <td>{{ ++$i }}
                                                        <input type="hidden" class="id"
                                                            data-id="{{ $item->id }}" name="id">
                                                    </td>
                                                    <td><img class=" img-size-64 "
                                                            src="{{ 'products/' . $item->photo }}"
                                                            alt="Dist Photo 1">
                                                    </td>
                                                    <td class="product_code">{{ $item->product_code }}</td>
                                                    <td class="product_name">{{ $item->product_name }}</td>
                                                    <td class="scale">{{ $item->scale }}</td>
                                                    <td>
                                                        @foreach (explode('/', $item->salling_price) as $row)
                                                            <span>${{ $row }}<br></span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->store_stock }}</td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-info btn-sm btn-add-cart"
                                                            data-product-id="{{ $item->id }}" data-toggle="modal"
                                                            data-backdrop="static" data-target="#modal-lg"><i
                                                                class="fas fa-cart-plus"></i>
                                                            {{ __('app.label_add_cart') }}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        {!! $productes->links() !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('app.label_no') }}</th>
                                                <th>{{ __('app.code') }}</th>
                                                <th>{{ __('app.label_name') }}</th>
                                                <th>{{ __('app.label_qty') }}</th>
                                                <th>{{ __('app.label_price') }}</th>
                                                <th>{{ __('app.label_note') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($addCart as $i => $item)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $item->product_code }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger deleteAddCart"
                                                            data-toggle="modal" data-target="#modal-default"
                                                            data-id="{{ $item->id }}"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('app.label_fill_data') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('add-cart') }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="product_id" class="product_id">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.code') }}{{ __('app.product') }}</label>
                                                        <input type="text" name="product_code"
                                                            class="form-control product_code" readonly></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_name') }}{{ __('app.product') }}</label>
                                                        <input type="text" name="product_name"
                                                            class="form-control product_name" readonly></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_scale') }}</label>
                                                        <input type="text" name="product_scale"
                                                            class="form-control product_scale" readonly></input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_qty') }}{{ __('app.product') }} <small
                                                                class="text-red">*</small></label>
                                                        <input type="number" name="product_qty" class="form-control"
                                                            required></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_salling_price') }} <small
                                                                class="text-red">*</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="number" name="product_price" step="any"
                                                                class="form-control"
                                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_salling_price') }}"
                                                                value="{{ old('salling_price') }}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_note') }}</label>
                                                        <textarea name="note" rows="2" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ __('app.btn_close') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary btn-submit">{{ __('app.btn_accepted') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form class="formDelete" action="foo" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <div class="modal-header">
                                            <h5 class="modal-title text-bold">ផ្ទៀងផ្ទាត់</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ __('app.label_confirm_delete') }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ __('app.btn_close') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('app.btn_delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('app.label_fill_data') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('add-cart') }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="product_id" class="product_id">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.code') }}{{ __('app.product') }}</label>
                                                        <input type="text" name="product_code"
                                                            class="form-control product_code" readonly></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_name') }}{{ __('app.product') }}</label>
                                                        <input type="text" name="product_name"
                                                            class="form-control product_name" readonly></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_scale') }}</label>
                                                        <input type="text" name="product_scale"
                                                            class="form-control product_scale" readonly></input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_qty') }}{{ __('app.product') }} <small
                                                                class="text-red">*</small></label>
                                                        <input type="number" name="product_qty" class="form-control"
                                                            required></input>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_salling_price') }} <small
                                                                class="text-red">*</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="number" name="product_price" step="any"
                                                                class="form-control"
                                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_salling_price') }}"
                                                                value="{{ old('salling_price') }}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>{{ __('app.label_note') }}</label>
                                                        <textarea name="note" rows="2" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ __('app.btn_close') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary btn-submit">{{ __('app.btn_accepted') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script type="text/javascript">
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({})

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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-add-cart').click(function() {
            var product_id = $(this).data("product-id");
            var qty = $(this).closest("tr").find(".qty").val();
            var price = $(this).closest("tr").find(".price").val();
            var note = $(this).closest("tr").find(".note").val();

            $.ajax({
                url: "/get-product/" + product_id,
                method: "get",
                success: function(data) {
                    $('.product_id').val(data.id)
                    $('.product_code').val(data.product_code)
                    $('.product_scale').val(data.scale)
                    $('.product_name').val(data.product_name)
                },
            });
        })

        $(".deleteAddCart").click(function() {
            var id = $(this).data("id");
            $('.formDelete').attr('action', '/add-cart/' + id);
        });

        $('.btn-submit').click(function() {
        console.info('log of button submit');
        });
    });
    </script>
</body>

</html>
