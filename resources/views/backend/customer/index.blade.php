@extends('layouts.master')

@section('title-page', __('app.customer_management'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.customer_management') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('customers.create') }}" class="btn btn-outline-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.label_name') }}{{ __('app.customer') }}</th>
                                <th>{{ __('app.phone') }}</th>
                                <th>{{ __('app.current_place') }}</th>
                                <th>{{ __('app.label_note') }}</th>
                                <th>{{ __('app.created_by') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.updated_by') }}</th>
                                <th>{{ __('app.updated_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($customers as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->customer_phone }}</td>
                                    <td>{{ $item->customer_address }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{{ $item->creator->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updator->name }}</td>
                                    <td>{{ $item->updated_at     }}</td>
                                    <td>
                                        <a href="{{ route('customers.show',$item->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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
