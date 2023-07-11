@extends('layouts.sale_master')

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
                        <a href="{{ url('sales') }}" class="btn btn-outline-primary"> <i class=" fas fa-arrow-left"></i>
                            {{ __('app.btn_back') }}</a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="card-tools">
                        @if(Auth::user()->getIDRoles())
                            <form action="{{ url('sale-status') }}" method="post">
                                @csrf
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <div class=" float-right ml-2">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-eye"></i>
                                    {{ __('app.btn_accepted') }}</button>
                            </div>
                            <div class="float-right">
                                <select class="form-control select2s" required name="status">
                                    <option value="">{{ __('app.table_choose') }}</option>
                                    <option value="4">{{ __('app.status_approved') }}</option>
                                    <option value="3">{{ __('app.status_rejected') }}</option>
                                </select>
                            </div>
                            </form>
                            @endif
                    </div>
                </div>
                <div class="card-body custom-card-body">
                    <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.customer')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_name ?? ''}}</label>
                        </div>
                      </div>
                      <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.phone')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_phone ?? ''}}</label>
                        </div>
                      </div>
                      <div class="row">
                        <label for="inputEmail3" class="col-sm-2">{{__('app.current_place')}}</label>
                        <div class="col-sm-10">
                            <label for="">: {{$sale->customer->customer_address ?? ''}}</label>
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
                                <th>{{ __('app.label_unit') }}</th>
                                <th>{{ __('app.label_price') }}</th>
                                <th>{{ __('app.label_discount') }}</th>
                                <th>{{ __('app.label_amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetail as $index => $item)
                               <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$item->product_code}}</td>
                                    <td><dl class="row">
                                        <dt class="col-sm-auto">
                                            <input type="hidden" name="product_photo[]" value="{{$item->photo}}">
                                            <img src="{{ asset('products/' . $item->photo) }}" class="float-left img-size-50">
                                        </dt>
                                        <dt class="col-sm-auto">
                                            <span>{{ $item->product_name }}</span>
                                            <input type="hidden" name="product_name[]" value="{{ $item->product_name }}">
                                            <br>
                                            <input type="hidden" name="product_note[]" value="{{ $item->note }}">
                                            <small class="text-red">{{ $item->note }}</small>
                                        </dt>
                                    </dl></td>
                                    <td>{{$item->scale}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>${{$item->price}}</td>
                                    <td>${{$item->discount}}</td>
                                    <td>${{$item->amount}}</td>
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
