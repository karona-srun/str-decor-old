@extends('layouts.master')

@section('title-page', __('app.customer_management'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.customer_management') }}</h3>
                    <div class="card-tools">
                        @can('Customer Edit')
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning"> <i
                                class=" fas fa-edit"></i>
                            {{ __('app.btn_edit') }}</a>
                        @endcan
                        @can('Customer Delete')
                        <a href="#" class="btn btn-danger btn-sm deleteCustomer"
                            onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                                     data-toggle="modal"
                                                     data-target="#modal-default" data-id="{{ $customer->id }}">
                            <i class="far fa-trash-alt"></i>
                            {{ __('app.btn_delete') }}
                        </a>
                        @endcan
                        {{-- <form id="delete-form" action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                            class="d-none">
                            @csrf
                            @method('DELETE')
                        </form> --}}
                        @can('Customer List')
                        <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-primary"> <i
                                class=" fas fa-list"></i>
                            {{ __('app.label_list') }}{{ __('app.customer') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.label_name') }}{{ __('app.customer') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->customer_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.phone') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->customer_phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.current_place') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->customer_address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.label_note') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->note }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.created_by') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->creator->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.created_at') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->created_at }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.updated_by') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->updator->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.updated_at') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <p>: {{ $customer->updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form class="formDelete" action="{{ route('customers.destroy', $customer->id) }}" method="post">
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
                        <button class="btn btn-primary btn-sm deleteCustomer">{{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
