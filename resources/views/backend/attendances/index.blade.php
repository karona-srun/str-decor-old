@extends('layouts.master')

@section('title-page', __('app.attendance'))

@section('css')
    <style>
        .custom-card-body {
            padding: 0.5rem 1.25rem !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ url('/attendances') }}" method="get">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.attendance') }}</h3>
                        <div class="card-tools">
                            <div class="btn-group">
                                <input type="hidden" name="export" class="export" value="">
                                <button type="submit" class="btn btn-sm btn-outline-primary exportexcel"> <i
                                        class=" fas fa-download"></i>
                                    {{ __('app.btn_download') }}</button>

                                @can('Attandance Create')
                                    {{-- <a href="{{ url('attendances/create') }}" class="btn btn-sm ml-2 btn-primary"> <i
                                            class=" fas fa-plus"></i>
                                        {{ __('app.btn_add') }}</a> --}}
                                    <button type="button" class="btn btn-sm ml-2 btn-primary createAttendance"
                                        data-toggle="modal" data-target="#modal-default-create"> <i class=" fas fa-plus"></i>
                                        {{ __('app.btn_add') }}</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-card-body">

                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <label for="">{{ __('app.table_choose') }}{{ __('app.table_staff_name') }}</label>
                                <select class="form-control select2" name="staff" id="staff" style="width: 100%;">
                                    <option value="">{{ __('app.label_all') }}</option>
                                    @foreach ($staff as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == request()->get('staff') ? 'selected' : '' }}>
                                            {{ $item->full_name_kh == null ? $item->full_name : $item->full_name_kh }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <label for="">{{ __('app.label_start') }}</label>
                                <input type="date" class="form-control" name="start_date" id="start_date"
                                    value="{{ request()->get('start_date') }}">
                            </div>
                            <div class="col-sm-2 mb-2">
                                <label for="">{{ __('app.label_end') }}</label>
                                <input type="date" class="form-control " name="end_date" id="end_date"
                                    value="{{ request()->get('end_date') }}">
                            </div>
                            <div class="col-sm-5 mb-2">
                                <label for="">{{ __('app.label_status') }}</label>
                                <div class="row pl-3">

                                    <div class="form-group pr-3">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="Radio1" name="status"
                                                value="" {{ request()->get('status') == '' ? 'checked' : '' }}>
                                            <label for="Radio1"
                                                class="custom-control-label">{{ __('app.label_all') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group pr-3">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="Radio2" name="status"
                                                value="presence"
                                                {{ request()->get('status') == 'presence' ? 'checked' : '' }}>
                                            <label for="Radio2"
                                                class="custom-control-label">{{ __('app.label_presence') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group pr-3">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="Radio3" name="status"
                                                value="adsent" {{ request()->get('status') == 'adsent' ? 'checked' : '' }}>
                                            <label for="Radio3"
                                                class="custom-control-label">{{ __('app.label_adsent') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input adsent_permission" type="radio"
                                                id="Radio4" name="status" value="permission"
                                                {{ request()->get('status') == 'permission' ? 'checked' : '' }}>
                                            <label for="Radio4"
                                                class="custom-control-label">{{ __('app.label_permission_request') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 noexportexcel"> <i class="fas fa-search"></i>
                            {{ __('app.label_search') }}</button>
                        <a href="{{ url('attendances') }}" class="btn btn-danger mb-3"> <i class="fas fa-broom"></i>
                            {{ __('app.btn_clean') }}</a>
                    </div>
                </form>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.table_staff_name') }}</th>
                                <th>{{ __('app.table_date') }}</th>
                                <th>{{ __('app.table_status') }}</th>
                                <th>{{ __('app.table_checkin') }}</th>
                                <th>{{ __('app.table_checkout') }}</th>
                                <th>{{ __('app.num_hour') }}</th>
                                <th>{{ __('app.label_note') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->staff->full_name_kh }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        @if ($item->status == 'presence')
                                            <span class="text-sm badge badge-success">{{ __('app.label_presence') }}</span>
                                        @elseif($item->status == 'adsent')
                                            <span
                                                class="text-sm badge badge-secondary">{{ __('app.label_adsent') }}</span>
                                        @elseif($item->status == 'permission')
                                            <span
                                                class="text-sm badge badge-danger">{{ __('app.label_permission_request') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->check_in }}</td>
                                    <td>{{ $item->check_out }}</td>
                                    <td>{{ $item->num_hour }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>
                                        @can('Attandance Edit')
                                            <button class="btn btn-sm btn-warning editAttendance" data-toggle="modal"
                                                data-target="#modal-default-edit" data-id="{{ $item->id }}"><i
                                                    class="far fa-edit"></i></button>
                                        @endcan
                                        @can('Attandance Delete')
                                            <button class="btn btn-sm btn-danger deleteAttendance" data-toggle="modal"
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


    <div class="modal fade" id="modal-default-create">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.attendance') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/attendances') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('app.table_choose') }}{{ __('app.table_staff_name') }} <small
                                    class="text-red">*</small></label>
                            <select class="form-control select2 listStaff" id="listStaff" required name="staff_id"
                                style="width: 100%;">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.table_date') }} <small class="text-red">*</small></label>
                            <input type="date" name="date" id="date" required class="form-control"
                                placeholder="{{ __('app.label_required') }} {{ __('app.table_date') }}">
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
                            <textarea name="note" id="" cols="30" class="form-control" rows="3"
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm pl-3 pr-3 btn-danger"
                            data-dismiss="modal"><i class="fas fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit"
                            class="btn btn-sm pl-3 pr-3 btn-outline-primary"><i class="fas fa-save"></i> {{ __('app.btn_save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.btn_edit') }}{{ __('app.attendance') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quickForm" action="{{ url('/update-attendance') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" class="form-control id">
                        <div class="form-group">
                            <label>{{ __('app.table_date') }} <small class="text-red">*</small></label>
                            <input type="date" name="date" id="date" required class="form-control date"
                                required placeholder="{{ __('app.label_required') }} {{ __('app.table_date') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.table_choose') }} <small class="text-red">*</small></label>
                            <div class="row pl-3">
                                <div class="form-group pr-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input presence status_presence" type="radio"
                                            id="customRadio4" name="status" value="presence">
                                        <label for="customRadio4"
                                            class="custom-control-label">{{ __('app.label_presence') }}</label>
                                    </div>
                                </div>
                                <div class="form-group pr-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input adsent_permission status_adsent" type="radio"
                                            id="customRadio5" name="status" value="adsent">
                                        <label for="customRadio5"
                                            class="custom-control-label">{{ __('app.label_adsent') }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input adsent_permission status_permission"
                                            type="radio" id="customRadio6" name="status" value="permission">
                                        <label for="customRadio6"
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
                                        class="form-control checkin"
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
                                        class="form-control checkout"
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
                                        class="form-control num_hour"
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
                            <textarea name="note" id="" cols="30" class="form-control note" rows="3"
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm pl-3 pr-3 btn-danger"
                            data-dismiss="modal"><i class="fas fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit"
                            class="btn pl-3 pr-3 btn-sm btn-outline-primary"><i class="fas fa-save"></i> {{ __('app.btn_save') }}</button>
                    </div>
                </form>
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
                            data-dismiss="modal"><i class="fas fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i> {{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

            var countriesList = '/api/list-staff',
                listStaff = $('.listStaff');
            $.ajax({
                type: 'POST',
                url: countriesList,
                dataType: 'json',
                success: function(response) {
                    listStaff.select2({
                        data: response.map(item => ({
                            id: item.id,
                            text: item.text,
                        })),
                        width: '100%',
                        dropdownAutoWidth: true,
                        matcher: startWithMatcher,
                        placeholder: 'ជ្រើសរើសបុគ្គលិក',
                        theme: 'bootstrap4',
                        language: 'km'
                    });
                }
            });

            listStaff.on('select2:select', function(e) {
                var data = e.params.data;
            });

            function startWithMatcher(params, data) {
                params.term = params.term || '';
                if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                    return data;
                }
                return false;
            }


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('.exportexcel').click(function() {
                $('.export').val('enabled');
            });

            $('.noexportexcel').click(function() {
                $('.export').val('');
            });

            $(".div-check").hide();

            $(".presence").click(function() {
                $(".div-check").show();
            });

            $(".adsent_permission").click(function() {
                $(".div-check").hide();
            });

            $(".editAttendance").click(function() {
                var id = $(this).data("id");
                $('form .formUpdate').attr('action', 'attendances/' + id);
                $.ajax({
                    type: "get",
                    url: "attendances/" + id,
                    success: function(response) {
                        $('.id').val(response.id)
                        $('.date').val(response.date)
                        $('.checkin').val(response.check_in)
                        $('.checkout').val(response.check_out)
                        $('.num_hour').val(response.num_hour)
                        $('.note').val(response.note)
                        if (response.status == 'presence') {
                            $('.status_presence').prop("checked", true);
                            $(".div-check").show();
                        } else if (response.status == 'adsent') {
                            $('.status_adsent').prop("checked", true);
                            $(".div-check").hide();
                        } else if (response.status == 'permission') {
                            $('.status_permission').prop("checked", true);
                            $(".div-check").hide();
                        }
                    }
                });
            });

            $(".deleteAttendance").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'attendances/' + id);
            });

        });
    </script>
@endsection
