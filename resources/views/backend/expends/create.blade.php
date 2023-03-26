@extends('layouts.master')

@section('title-page', __('app.expend_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.expend_info') }}</h3>
                    <div class="card-tools">
                        @can('Expend List')
                        <a href="{{ url('/expend?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString()) }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                            @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('expend') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.expend_options') }} <small class="text-red">*</small></label>
                                        <select class="form-control select2" name="expend_option" style="width: 100%;">
                                            <option value="">{{ __('app.table_choose') }}</option>
                                            @foreach ($expend_options as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('expend_option'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('expend_option') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                        @if ($errors->has('name'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_payment_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ old('date') }}" placeholder="{{ __('app.table_date') }}">
                                        @if ($errors->has('date'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('date') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_amount') }} <small class="text-red">*</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="amount" step="any" class="form-control"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_amount') }}"
                                                value="{{ old('amount') }}">
                                        </div>
                                        @if ($errors->has('amount'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('amount') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.table_photo') }} <small class="text-red">*</small></label>
                                        <input type="file" name="photo" class="form-control">
                                        @if ($errors->has('photo'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('photo') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <textarea rows="3" name="note" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}"></textarea>
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
