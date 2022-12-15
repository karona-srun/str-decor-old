@extends('layouts.master')

@section('title-page', __('app.payroll'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                                <th>{{ __('app.base_salary') }}</th>
                                <th>{{ __('app.rate_per_hour') }}</th>
                                <th>{{ __('app.num_hour') }}</th>
                                <th>{{ __('app.table_date') }}</th>
                                <th>{{ __('app.table_status') }}</th>
                                <th>{{ __('app.label_note') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->full_name_kh }}</td>
                                    <td>{{ $item->positions->name }}</td>
                                    <td>${{ $item->base_salary }}</td>
                                    <td>${{ $item->rate_per_hour }}</td>
                                    <td>{{ $item->sumAttendance($item->id) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $item->attendances[$i]['note'] }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning editAttendance" data-toggle="modal"
                                            data-target="#modal-default-edit" data-id="{{ $item->id }}"><i
                                                class="far fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger deleteAttendance" data-toggle="modal"
                                            data-target="#modal-default" data-id="{{ $item->id }}"><i
                                                class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
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

        });
    </script>
@endsection
