@extends('layouts.master')

@section('title-page', __('app.work_place') )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('app.label_info')}}{{ __('app.work_place') }}</h3>
                    <div class="card-tools">
                        @can('WorkPlace List')
                        <a href="{{ url('workplace') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i> {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('workplace') }}" method="post">
                      @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_name')}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_status') }}</label>
                                <select class="form-control select2" name="status" style="width: 100%;">
                                    <option value="0" selected="selected">{{ __('app.label_status_disabled') }}</option>
                                    <option value="1">{{ __('app.label_status_visibled') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="note" class="form-control" 
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_note')}}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_save') }}</button>
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
            $.validator.setDefaults({
                submitHandler: function() {
                    alert("Form successful submitted!");
                }
            });
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                        text: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a position",
                        email: "Please enter a valid position"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
