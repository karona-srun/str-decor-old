@extends('layouts.master')

@section('title-page', __('app.base_salary') )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('app.label_info')}}{{ __('app.base_salary') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('base-salary') }}" class="btn btn-primary"> <i class=" fas fa-list"></i> {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('base-salary') }}" method="post">
                      @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_name')}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_amount') }} <small class="text-red">*</small></label>
                                <input type="number" name="amount" class="form-control"
                                    placeholder="{{ __('app.label_required')}}{{__('app.label_amount')}}">
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
                    amount: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        email: "Please enter a valid name"
                    },
                    amount: {
                        required: "Please enter a amount",
                        email: "Please enter a valid amount"
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
