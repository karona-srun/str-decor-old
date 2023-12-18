@extends('layouts.master')

@section('title-page', __('app.customer_management'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.customer_management') }}</h3>
                    <div class="card-tools">
                        @can('Customer List')
                        <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }}{{ __('app.customer') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form id="customerForm" action="{{ url('/customers') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.customer_name') }} <small
                                            class="text-red">*</small></label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}"
                                        placeholder="{{ __('app.label_name') }}{{ __('app.customer') }}">
                                    @if ($errors->has('customer_name'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('customer_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.phone') }} <small class="text-red">*</small></label>
                                    <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}"
                                        placeholder="{{ __('app.phone') }}">
                                    @if ($errors->has('customer_phone'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('customer_phone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.current_place') }} <small class="text-red">*</small></label>
                                    <textarea name="customer_address" class="form-control" rows="3"
                                        placeholder="{{ __('app.label_required') }}{{ __('app.current_place') }}">{{ old('customer_address') }}</textarea>
                                    @if ($errors->has('customer_address'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('customer_address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.label_note') }}</label>
                                    <textarea name="note" id="" cols="30" class="form-control" rows="3"
                                        placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn pl-3 pr-3 btn-primary btn-sm"> <i class="fas fa-save"></i>
                            {{ __('app.btn_save') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
