@extends('layouts.master')

@section('title-page', __('app.time') )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('app.label_info')}}{{ __('app.time') }}</h3>
                    @can('Time List')
                    <div class="card-tools">
                        <a href="{{ url('times') }}" class="btn btn-primary"> <i class=" fas fa-list"></i> {{ __('app.label_list') }} </a>
                    </div>
                    @endcan
                </div>

                <div class="card-body">
                    <form action="{{ url('times') }}" method="post">
                      @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_name')}}">
                                    @if ($errors->has('name'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('name') }}</div>
                                            @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{ __('app.label_start_time') }} <small class="text-red">*</small></label>
                                            <input type="time" name="start_time" value="{{ old('start_time') }}"
                                                class="form-control" placeholder="{{ __('app.label_required') }}{{ __('app.label_start_time') }}">
                                            @if ($errors->has('start_time'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('start_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{ __('app.label_end_time') }} <small class="text-red">*</small></label>
                                            <input type="time" name="end_time" value="{{ old('end_time') }}"
                                                class="form-control"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_end_time') }}">
                                            @if ($errors->has('end_time'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('end_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="note" class="form-control" 
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_note')}}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('app.btn_save') }}</button>
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
