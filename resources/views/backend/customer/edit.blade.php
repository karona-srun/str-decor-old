@extends('layouts.master')

@section('title-page', __('app.customer_management'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.customer_management') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-outline-primary btn-sm"> <i class="fas fa-arrow-left"></i>
                            {{ __('app.btn_back') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="customerForm" action="{{ route('customers.update', $customer->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.label_name') }}{{ __('app.customer') }} <small
                                            class="text-red">*</small></label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ $customer->customer_name }}"
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
                                    <input type="text" name="customer_phone" class="form-control" value="{{ $customer->customer_phone }}"
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
                                        placeholder="{{ __('app.label_required') }}{{ __('app.current_place') }}">{{ $customer->customer_address }}</textarea>
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
                                        placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ $customer->note }}DFDFSD</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn pl-3 pr-3 btn-sm btn-primary"> <i class="fas fa-save"></i>
                            {{ __('app.btn_save') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
