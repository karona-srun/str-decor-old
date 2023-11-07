@extends('layouts.master')

@section('title-page', __('app.sales_order'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.sales_order') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/sales-order-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i
                                class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a>
                        @can('WorkPlace Create')
                            <a href="{{ url('sales-order/create') }}" class="btn btn-sm btn-primary"> <i
                                    class=" fas fa-plus"></i>
                                {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <table id="datatable" class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.table_no') }}</th>
                                        <th>{{ __('app.customer_name') }}</th>
                                        <th>{{ __('app.sale_order') }}</th>
                                        <th>{{ __('app.reference') }}</th>
                                        <th>{{ __('app.sale_order_date') }}</th>
                                        <th>{{ __('app.expected_shipment_date') }}</th>
                                        <th>{{ __('app.warehouse_name') }}</th>
                                        <th>{{ __('app.sale_person') }}</th>
                                        <th>{{ __('app.delivery_method') }}</th>
                                        <th>{{ __('app.created_at') }}</th>
                                        <th>{{ __('app.updated_at') }}</th>
                                        <th>{{ __('app.table_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saleOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->customer->customer_name ?? 'N/A' }}</td>
                                            <td>{{ $item->sale_order }}</td>
                                            <td>
                                                <a href="{{ url('sales-order-download-file', $item->id) }}">
                                                    {{ __('app.reference') }}<i class="fas fa-download"></i></a>
                                            </td>
                                            <td>{{ $item->sale_order_date }}</td>
                                            <td>{{ $item->expected_shipment_date }}</td>
                                            <td>{{ $item->warehouse }}</td>
                                            <td>{{ $item->sale_person }}</td>
                                            <td>{{ $item->delivery_method }}</td>
                                            <td>{{ $item->created_at->format('Y-m-d h:m A') }}</td>
                                            <td>{{ $item->updated_at->format('Y-m-d h:m A') }}</td>
                                            <td>
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <a href="{{ url('sales-order/' . $item->id . '/edit') }}"
                                                            class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                                                    </div>
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto">
                                                        <form action="{{ url('sales-order/' . $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-3">
                            <div class="row items-center align-content-center">
                                <div class="col-lg-12 col-12">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $saleOrderDaily }}</h3>
                                            <h6>{{ __('app.label_sale_order_daily') }}</h6>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-dolly"></i>
                                        </div>
                                        <a href="#" class="small-box-footer"> <i class="fas fa-dot"></i> </a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $saleOrderMonthly }}</h3>
                                            <h6>{{ __('app.label_sale_order_monthly') }}</h6>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-dolly"></i>
                                        </div>
                                        <a href="#" class="small-box-footer"><i class="fas fa-dot"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('app.label_confirm_delete') }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".deletePosition").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'workplace/' + id);
            });

        });
    </script>
@endsection
