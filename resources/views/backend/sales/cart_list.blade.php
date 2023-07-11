@extends('layouts.sale_master')

@section('title-page', __('app.sales'))

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}</h3>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.label_invoice_no') }}</th>
                                <th>{{ __('app.customer') }}</th>
                                <th>{{ __('app.label_total_qty') }}</th>
                                <th>{{ __('app.label_deposit_') }}</th>
                                <th>{{ __('app.label_balance_') }}</th>
                                <th>{{ __('app.label_total_price') }}</th>
                                <th>{{ __('app.request_status') }}</th>
                                <th>{{ __('app.submit_by') }}</th>
                                <th>{{ __('app.approve_status') }}</th>
                                <th>{{ __('app.approve_by') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $index => $items)
                                <tr>
                                    <td>{{ $items->sale_no }}</td>
                                    <td> <p class="text-break">{{ $items->customer->customer_name ?? 'មិនមានព័ត៍មានទេ' }} <br>
                                        {{ $items->customer->customer_phone ?? 'មិនមានព័ត៍មានទេ' }} <br>
                                        {{ $items->customer->customer_address ?? 'មិនមានព័ត៍មានទេ' }}</p></td>
                                    <td>{{ $items->total_qty }}</td>
                                    <td>{{ $items->deposit !=  '' ? '$'.$items->deposit : '$0' }}</td>
                                    <td>{{ $items->balance !=  '' ? '$'.$items->balance : '$0' }}</td>
                                    <td>{{ '$'.$items->total_price }}</td>
                                    <td> <span class="badge {{ $items->colorStatus($items->request_status) }} text-sm">{{ $items->status($items->request_status) }}</span></td>
                                    <td>{{ $items->submitBy['name'] ?? '' }}</td>
                                    <td><span class="badge {{ $items->colorStatus($items->approve_status) }} text-sm">{{ $items->status($items->approve_status) }}</span></td>
                                    <td>{{ $items->approveBy == '' ? 'Administrator' : 'Administrator: '.$items->approveBy['name'] }}</td>
                                    <td>{{ $items->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/sales-cart-list/detail', $items->id )}}" class="btn btn-sm btn-outline-info"> <i class="fas fa-eye"></i> {{ __('app.btn_view')}} </a>
                                        <a href="{{ url('/print-add-cart', $items->id) }}" target="_blink"
                                        class="btn btn-sm btn-outline-primary"><i class="fas fa-print"></i>
                                        {{ __('app.btn_print') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
