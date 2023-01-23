@extends('layouts.master')

@section('title-page', __('app.product_category'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.product_category') }}</h3>
                    <div class="card-tools">
                        @can('Product Category List')
                        <a href="{{ url('/product-category') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('product-category') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>{{ __('app.code') }}{{ __('app.product_category') }} <small
                                            class="text-red">*</small></label>
                                    <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                                        placeholder="{{ __('app.label_required') }}{{ __('app.code') }}">
                                    @if ($errors->has('code'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('code') }}</div>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>{{ __('app.label_name') }}{{ __('app.product_category') }} <small
                                            class="text-red">*</small></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="{{ __('app.label_required') }}{{ __('app.product_category') }}">
                                    @if ($errors->has('name'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <textarea rows="3" name="note" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ old('note') }}</textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_save') }}</button>
                            </div>
                        </div>
                    </form>
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
