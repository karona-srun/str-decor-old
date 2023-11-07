@extends('layouts.master')

@section('title-page', __('app.sales_order'))

@section('css')
    <style>
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.sales_order') }}</h3>
                    <div class="card-tools">
                        @can('Product Category List')
                            <a href="{{ url('/sales-order') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('/sales-order') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row jsgrid-align-center">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('app.customer_name') }} <small class="text-red">*</small></label>
                                        <select name="customer_id" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%">
                                            @foreach ($customers as $item)
                                                <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('customer_id'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('customer_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light p-2 mb-2">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('app.sale_order') }} <small class="text-red">*</small></label>
                                        <input type="text" name="sale_order" class="form-control">
                                        @if ($errors->has('sale_order'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('sale_order') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-group">
                                        <label>{{ __('app.reference') }} <small class="text-red">*</small></label>
                                        <input type="file" name="reference" class=" form-control" id="reference"
                                            style="line-height: 20px;">
                                        @if ($errors->has('reference'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('reference') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.sale_order_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="sale_order_date"
                                            value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control">
                                        @if ($errors->has('sale_order_date'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('sale_order_date') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.expected_shipment_date') }} <small
                                                class="text-red">*</small></label>
                                        <input type="date" name="expected_shipment_date"
                                            value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control">
                                        @if ($errors->has('expected_shipment_date'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('expected_shipment_date') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.warehouse_name') }} <small class="text-red">*</small></label>
                                        <input type="text" name="warehouse" class="form-control">
                                        @if ($errors->has('warehouse'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('warehouse') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.sale_person') }} <small class="text-red">*</small></label>
                                        <input type="text" name="sale_person" class="form-control">
                                        @if ($errors->has('sale_person'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('sale_person') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.delivery_method') }} <small class="text-red">*</small></label>
                                        <select name="delivery_method"
                                            class="form-control select2 select2-hidden-accessible" style="width: 100%">
                                            <option selected>{{ __('app.table_choose') }}</option>
                                            @foreach (__('app.delivery_method_items') as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('delivery_method'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('delivery_method') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class=" fas fa-save"></i>
                                {{ __('app.btn_save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

        });
    </script>
@endsection
