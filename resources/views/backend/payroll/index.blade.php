@extends('layouts.master')

@section('title-page', __('app.payroll'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.payroll') }}</h3>
                    <div class="card-tools">
                        @can('Payroll Create')
                            <a href="{{ url('payroll/create') }}" class="btn btn-sm btn-outline-primary"> <i
                                    class=" fas fa-plus"></i>
                                {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body" style="padding-bottom: 0px;">
                    <div class="card p-3">
                        <form action="{{ url('/payroll') }}" method="get">
                            <div class="row" style="margin-bottom: -40px;">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_start_date') }}</label>
                                        <input type="date" name="start_date" class="form-control start_date"
                                            value="{{ request()->get('start_date') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_end_date') }}</label>
                                        <input type="date" name="end_date" class="form-control end_date"
                                            value="{{ request()->get('end_date') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.table_staff_name') }}</label>
                                        <select class="form-control select2 selectStaff" name="staff"
                                            style="width: 100%;">
                                            <option value="0">{{ __('app.table_staff_name') }}</option>
                                            @foreach ($staffs as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == request()->get('staff') ? 'selected' : '' }}>{{ $item->full_name_kh }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3" style="line-height: 6.6;">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"> <i class=" fas fa-search"></i>
                                                {{ __('app.label_search') }}</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                <th>{{ __('app.label_duration') }}</th>
                                <th>{{ __('app.table_date') }}</th>
                                <th>{{ __('app.table_status') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payroll as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->staff->full_name_kh }}</td>
                                    <td>{{ $item->staff->positions->name }}</td>
                                    <td>${{ $item->staff->rate_per_hour }}</td>
                                    <td>{{ $item->total_hour }}</td>
                                    <td>${{ $item->total_salary }}</td>
                                    <td>{{ $item->start_date }} - {{ $item->end_date }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->payroll_status == 'paid' ? __('app.label_paid') : __('app.label_not_yet') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('payroll', $item->id) }}" class="btn btn-sm btn-warning"><i
                                                class="fas fa-file-invoice text-white"></i></a>
                                        @can('Payroll Delete')
                                            <button class="btn btn-sm btn-danger deletePayroll" data-toggle="modal"
                                                data-target="#modal-default" data-id="{{ $item->id }}"><i
                                                    class="far fa-trash-alt"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="formDelete" action="foo" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-header">
                        <h5 class="modal-title text-bold">ផ្ទៀងផ្ទាត់</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('app.label_confirm_delete') }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_delete') }}</button>
                    </div>
                </form>
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

            $(".deletePayroll").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'payroll/' + id);
            });
        });
    </script>
@endsection
