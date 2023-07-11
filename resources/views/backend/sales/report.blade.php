@extends('layouts.master')

@section('title-page', __('app.label_sale_report'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ url('/sale-report') }}" method="get">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_sale_report') }}</h3>
                        <div class="card-tools">
                            <input type="hidden" name="export" class="export" value="">
                            <button type="submit" class="btn btn-sm btn-outline-primary exportexcel"> <i
                                    class=" fas fa-download"></i>
                                {{ __('app.btn_download') }}</button>
                        </div>
                    </div>


                    <div class="card-body custom-card-body">

                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <label for="">{{ __('app.customer') }}</label>
                                <select class="form-control select2" name="customer" id="customer" style="width: 100%;">
                                    <option value="">{{ __('app.label_all') }}</option>
                                    @foreach($customers as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == request()->get('customer') ? 'selected' : '' }}>{{ $item->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <label for="">{{ __('app.phone') }}</label>
                                <input type="number" class="form-control" name="customer_phone" id="customer_phone"
                                    value="{{ request()->get('customer_phone') }}">
                            </div>
                            <div class="col-sm-2 mb-2">
                                <label for="">{{ __('app.label_start') }}</label>
                                <input type="date" class="form-control" name="start_date" id="start_date"
                                    value="{{ request()->get('start_date') }}">
                            </div>
                            <div class="col-sm-2 mb-2">
                                <label for="">{{ __('app.label_end') }}</label>
                                <input type="date" class="form-control " name="end_date" id="end_date"
                                    value="{{ request()->get('end_date') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 noexportexcel"> <i class="fas fa-search"></i>
                            {{ __('app.label_search') }}</button>
                        <a href="{{ url('sale-report') }}" class="btn btn-danger mb-3"> <i class="fas fa-broom"></i>
                            {{ __('app.btn_clean') }}</a>
                    </div>
                </form>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.label_invoice_no') }}</th>
                                <th>{{ __('app.table_date') }}</th>
                                <th>{{ __('app.customer') }}</th>
                                <th>{{ __('app.phone') }}</th>
                                <th>{{ __('app.label_total_qty') }}</th>
                                <th>{{ __('app.label_deposit_') }}</th>
                                <th>{{ __('app.label_balance_') }}</th>
                                <th>{{ __('app.label_total_price') }}</th>
                                <th>{{ __('app.request_status') }}</th>
                                <th>{{ __('app.submit_by') }}</th>
                                <th>{{ __('app.approve_status') }}</th>
                                <th>{{ __('app.approve_by') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saleDaily as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->sale_no }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>{{ $item->customer->customer_name ?? 'មិនមានព័ត៍មានទេ' }}</td>
                                    <td>{{ $item->customer->customer_phone ?? 'មិនមានព័ត៍មានទេ'}}</td>
                                    <td>{{ $item->total_qty }}</td>
                                    <td>{{ $item->deposit ? '$'.$item->deposit : '$0' }}</td>
                                    <td>{{ $item->balance ? '$'.$item->balance : '$0' }}</td>
                                    <td>${{ $item->total_price }}</td>
                                    <td> <span class="badge {{ $item->colorStatus($item->request_status) }} text-sm">{{ $item->status($item->request_status) }}</span></td>
                                    <td>{{ $item->submitBy['name'] ?? '' }}</td>
                                    <td><span class="badge {{ $item->colorStatus($item->approve_status) }} text-sm">{{ $item->status($item->approve_status) }}</span></td>
                                    <td>{{ $item->approveBy == '' ? 'Administrator' : 'Administrator: '.$item->approveBy['name'] }}</td>
                                    <td>
                                        <a href="{{ url('sale-report', $item->id) }}" class="btn btn-sm btn-light"> <i
                                                class="fas fa-eye"></i> </a>
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

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.exportexcel').click(function() {
                $('.export').val('enabled');
            });

            $('.noexportexcel').click(function() {
                $('.export').val('');
            });
        });
    </script>
@endsection
