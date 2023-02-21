@extends('layouts.master')

@section('title-page', __('app.label_list').__('app.quote'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.quote') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/times-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a>
                        @can('Time Create')
                        <a href="{{ url('quotes/create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no')}}</th>
                                <th>{{ __('app.label_quote_no') }}</th>
                                <th>{{ __('app.customer')}}</th>
                                <th>{{ __('app.table_date')}}</th>
                                <th>{{ __('app.label_amount')}}</th>
                                <th>{{ __('app.table_action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $index => $quote)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $quote->quote_no }}</td>
                                    <td><p class=" text-break">{{ $quote->customer->customer_name }} {{ $quote->customer->customer_phone }} {{ $quote->customer->customer_address }}</p></td>
                                    <td>{{ $quote->date }}</td>
                                    <td>${{ $quote->total_amount}}</td>
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
