@extends('layouts.master')

@section('title-page', __('app.label_list').__('app.quote'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.quote') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/quote-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }} {{__('app.label_all')}}</a>
                        @can('Time Create')
                        <a href="{{ url('quotes/create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no')}}</th>
                                <th>{{ __('app.label_quote_no') }}</th>
                                <th>{{ __('app.customer')}}</th>
                                <th>{{ __('app.table_date')}}</th>
                                <th>{{ __('app.label_amount')}}</th>
                                <th>{{ __('app.request_status') }}</th>
                                <th>{{ __('app.submit_by') }}</th>
                                <th>{{ __('app.approve_status') }}</th>
                                <th>{{ __('app.approve_by') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.table_action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $index => $quote)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $quote->quote_no }}</td>
                                    <td><p class=" text-break">{{ $quote->customer->customer_name }} <br><small>{{ $quote->customer->customer_phone }}</small> <br><small>{{ $quote->customer->customer_address }}</small></p></td>
                                    <td>{{ $quote->date }}</td>
                                    <td>${{ $quote->total_amount}}</td>
                                    <td> <span class="badge {{ $quote->colorStatus($quote->request_status) }} text-sm">{{ $quote->status($quote->request_status) }}</span></td>
                                    <td>{{ $quote->submitBy['name'] ?? '' }}</td>
                                    <td><span class="badge {{ $quote->colorStatus($quote->approve_status) }} text-sm">{{ $quote->status($quote->approve_status) }}</span></td>
                                    <td>{{ $quote->approveBy == '' ? 'Administrator' : 'Administrator: '.$quote->approveBy['name'] }}</td>
                                    <td>{{ $quote->created_at }}</td>
                                    <td>
                                        <a href="{{ route('quotes.show', $quote->id )}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
            
        });
    </script>
@endsection
