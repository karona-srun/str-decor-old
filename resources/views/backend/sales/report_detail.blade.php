@extends('layouts.master')

@section('title-page', __('app.label_sale_report'))
@section('css')
    <style>
        .custom-card-body {
            padding: 0.5rem 1.25rem !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_invoice_no') }} {{$sale->sale_no}}</h3>
                    <div class="card-tools">
                        <a href="{{ url('sale-report') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-arrow-left"></i>
                            {{ __('app.btn_back') }}</a>
                    </div>
                </div>
                <div class="card-body custom-card-body">
                    <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.customer')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_name}}</label>
                        </div>
                      </div>
                      <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.phone')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_phone}}</label>
                        </div>
                      </div>
                      <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.current_place')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_address}}</label>
                        </div>
                      </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.code') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_scale') }}</th>
                                <th>{{ __('app.label_qty') }}</th>
                                <th>{{ __('app.label_price') }}</th>
                                <th>{{ __('app.label_note') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetail as $index => $item)
                               <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$item->product_code}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->scale}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>${{$item->price}}</td>
                                    <td>{{$item->note}}</td>
                               </tr>
                               @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-sm-3">
                            <table class="table">
                                <thead>
                                <tr class="bg-primary">
                                    <th colspan="5"><span>{{__('app.label_total_qty')}}</span></th>
                                    <th>{{$sale->total_qty}}</th>
                                </tr>
                                <tr class="bg-primary">
                                    <td colspan="5"><span>{{__('app.label_total_price')}}</span></td>
                                    <td>${{$sale->total_price}}</td>
                                </tr>
                            </thead>    
                            </table>
                        </div>
                    </div>
                </div>
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
        });
    </script>
@endsection
