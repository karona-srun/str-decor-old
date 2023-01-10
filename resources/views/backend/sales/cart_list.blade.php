@extends('layouts.sale_master')

@section('title-page', __('app.sales'))

@section('content')
    <div class="row">
        @foreach ($sales as $item)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100 collapsed mb-2 mt-2" data-toggle="collapse"
                                            href="#collapseOne{{ $item->id }}" aria-expanded="false">
                                            {{ $item->customer == '' ? '' : __('app.customer').': '.$item->customer->customer_name  }}
                                            {{ __('app.table_date') }}: {{ $item->created_at->format('d.m.Y h:i:s A') }}
                                        </a>
                                        <a href="{{ url('/print-add-cart', $item->id) }}" target="_blink"
                                            class="btn btn-outline-primary"><i class="fas fa-print"></i>
                                            {{ __('app.btn_print') }}</a>
                                    </h4>
                                </div>
                                <div id="collapseOne{{ $item->id }}" class="collapse" data-parent="#accordion"
                                    style="">
                                    <div class="card-body">
                                        <p>{{ __('app.customer') }}: {{ $item->customer->customer_name ?? '' }} <br>
                                        {{ __('app.phone') }}: {{ $item->customer->customer_phone ?? '' }} <br>
                                        {{ __('app.current_place') }}: {{ $item->customer->customer_address ?? '' }}</p>
                                        </p>
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('app.table_no') }}</th>
                                                    <th>{{ __('app.code') }}</th>
                                                    <th>{{ __('app.product') }}</th>
                                                    <th>{{ __('app.label_scale') }}</th>
                                                    <th>{{ __('app.label_qty') }}</th>
                                                    <th>{{ __('app.label_price') }}</th>
                                                    <th>{{ __('app.label_note') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item->saleDetail as $index => $item)
                                                    <tr>
                                                        <td>{{ ++$index }}</td>
                                                        <td>{{ $item->product_code }}</td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->scale }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>${{ $item->price }}</td>
                                                        <td>{{ $item->note }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
