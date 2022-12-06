@extends('layouts.master')

@section('title-page', __('app.expend_options'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_info') }}{{ __('app.expend_options') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/expend-options') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('expend-options') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                @if ($errors->has('name'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="note" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
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
