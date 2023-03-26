@extends('layouts.master')

@section('title-page', __('app.attendance'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.attendance') }}</h3>
                    <div class="card-tools">
                        @can('Attandance List')
                            <a href="{{ url('/attendances') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('attendances') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.table_choose') }}{{ __('app.table_staff_name') }} <small
                                                class="text-red">*</small></label>
                                        <select class="form-control select2" name="staff_id" style="width: 100%;">
                                            <option value="">{{ __('app.table_choose') }}</option>
                                            @foreach ($staffs as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->full_name_kh ?? $item->full_name }}</option>
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
                                        <label>{{ __('app.label_payment_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ old('date') }}" placeholder="{{ __('app.table_date') }}">
                                        @if ($errors->has('date'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('date') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('app.table_choose') }} <small class="text-red">*</small></label>
                                <div class="row pl-3">
                                    <div class="form-group pr-3">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input presence" type="radio" id="customRadio1"
                                                name="status_" value="presence">
                                            <label for="customRadio1"
                                                class="custom-control-label">{{ __('app.label_presence') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group pr-3">

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input adsent_permission" type="radio"
                                                id="customRadio2" name="status_" value="adsent">
                                            <label for="customRadio2"
                                                class="custom-control-label">{{ __('app.label_adsent') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input adsent_permission" type="radio"
                                                id="customRadio3" name="status_" value="permission">
                                            <label for="customRadio3"
                                                class="custom-control-label">{{ __('app.label_permission_request') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row div-check">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.table_checkin') }} <small class="text-red">*</small></label>
                                        <input type="time" name="checkin" value="{{ old('first_name') }}"
                                            class="form-control"
                                            placeholder="{{ __('app.label_required') }} {{ __('app.table_checkin') }}">
                                        @if ($errors->has('checkin'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('checkin') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.table_checkout') }} <small class="text-red">*</small></label>
                                        <input type="time" name="checkout" value="{{ old('last_name') }}"
                                            class="form-control"
                                            placeholder="{{ __('app.label_required') }} {{ __('app.table_checkout') }}">
                                        @if ($errors->has('checkout'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('checkout') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.num_hour') }} <small class="text-red">*</small></label>
                                        <input type="number" name="num_hour" value="{{ old('num_hour') }}"
                                            class="form-control"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.num_hour') }}">
                                        @if ($errors->has('num_hour'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('num_hour') }}</div>
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
            $(".div-check").hide();

            $(".presence").click(function() {
                $(".div-check").show();
            });

            $(".adsent_permission").click(function() {
                $(".div-check").hide();
            });
        });
    </script>
@endsection
