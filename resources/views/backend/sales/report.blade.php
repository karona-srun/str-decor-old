@extends('layouts.master')

@section('title-page', __('app.label_sale_report'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.payroll') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('payroll/create') }}" class="btn btn-outline-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.table_staff_name') }}</th>
                                <th>{{ __('app.position') }}</th>
                                <th>{{ __('app.rate_per_hour') }}</th>
                                <th>{{ __('app.num_hour') }}</th>
                                <th>{{ __('app.label_amount') }}</th>
                                <th>{{ __('app.table_date') }}</th>
                                <th>{{ __('app.table_status') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
