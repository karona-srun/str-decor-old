@extends('layouts.master')

@section('title-page', __('app.payroll'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form id="quickForm" action="{{ url('payroll') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_info') }}{{ __('app.payroll') }}</h3>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-sm btn-outline-primary btn-payroll"> <i
                                    class=" fas fa-dollar-sign"></i>
                                {{ __('app.payroll') }} </button>
                            @can('Payroll List')
                                <a href="{{ url('payroll') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                                    {{ __('app.label_list') }} </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body" style="padding-bottom: 0px;">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_start_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="start_date" class="form-control start_date" value="{{ old('start_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_end_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="end_date" class="form-control end_date" value="{{ old('end_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.table_staff_name') }} <small class="text-red">*</small></label>
                                        <select class="form-control select2 selectStaff" name="staff"
                                            style="width: 100%;">
                                            <option value="0">{{ __('app.table_staff_name') }}</option>
                                            @foreach ($staffs as $item)
                                                <option value="{{ $item->id }}" >{{ $item->full_name_kh }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top: 0px;">
                        <div class="row">
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.position') }} </label>
                                <input type="text" name="position" class="position form-control" readonly>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.base_salary') }} [$]</label>
                                <input type="number" name="base_salary" class="base_salary form-control" readonly>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.rate_per_hour') }} [$]</label>
                                <input type="number" name="rate_per_hour" class="rate_per_hour form-control" readonly>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.table_date') }} <small class="text-red">*</small></label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-3 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.table_status') }} <small class="text-red">*</small></label>
                                    <select class="form-control select2" name="payroll_status" style="width: 100%;"
                                        required>
                                        <option value="" selected>{{ __('app.table_choose') }}</option>
                                        <option value="not_yet">{{ __('app.label_not_yet') }}</option>
                                        <option value="paid">{{ __('app.label_paid') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.label_note') }}</label>
                                    <textarea name="note" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="myAttendance" class="table table-bordered table-striped">
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
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>
                        </table>
                        <p class="mt-3">សរុបម៉ោងធ្វើការ​៖​ <span class="total_num_hour"></span> ម៉ោង</p>
                        <input type="hidden" name="total_hour" class="total_num_hour_">
                        <p class="mt-3">ប្រាក់ខែ​៖​ $<span class="total_salary"></span> </p>
                        <input type="hidden" name="total_salary" class="total_salary_">
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

            $('.div-toggle').hide();
            $('.btn-payroll').hide();

            function clearElements() {
                $('.total_num_hour').html('0');
                $('.total_salary').html('0');
                $('.total_num_hour_').val(0);
                $('.total_salary_').val(0);
            }

            $('.selectStaff').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                $('#myAttendance').find('tbody').empty();
                $('.div-toggle').show();
                $('.btn-payroll').show();

                var startDate = $('.start_date').val();
                var endDate = $('.end_date').val();

                if (valueSelected == 0) {
                    // $('.div-toggle').hide();
                    // $('.btn-payroll').hide();
                    // $('.total_num_hour').hide();
                    // $('.total_salary').hide();
                    clearElements();
                }

                if (startDate == "") {
                    $('.start_date').addClass('is-invalid');
                    clearElements();
                }else{
                    $('.start_date').removeClass('is-invalid');
                }
                
                if( endDate == ""){
                    $('.end_date').addClass('is-invalid');
                    clearElements();
                }else{
                    $('.end_date').removeClass('is-invalid');
                }
                
                if(startDate >= endDate){
                    $('.start_date').addClass('is-invalid');
                    $('.end_date').addClass('is-invalid');
                    clearElements();
                } else{
                    $('.start_date').removeClass('is-invalid');
                    $('.end_date').removeClass('is-invalid');
                }
                
                if( startDate <= endDate && endDate != "" && startDate != "") {
                    $.ajax({
                        type: "get",
                        url: "/filter-attendances?id="+valueSelected+"&start_date="+startDate+"&end_date="+endDate,
                        success: function(response) {
                            console.log(response.data);
                            $('.position').val(response.staff.position.name);
                            $('.base_salary').val(response.staff.base_salary);
                            $('.rate_per_hour').val(response.staff.rate_per_hour);
                            // $('.total_num_hour').html('0');
                            // $('.total_salary').html('0');
                            // $('.total_num_hour_').val(0);
                            // $('.total_salary_').val(0);
                            clearElements();
                            $.each(response.data, function(i, item) {

                                var status = "";
                                if (item.status == "permission") {
                                    status = "<span class='text-info'>សុំច្បាប់</span>";
                                } else if (item.status == "adsent") {
                                    status =
                                    "<span class='text-danger'>អវត្តមាន</span>";
                                } else {
                                    status =
                                    "<span class='text-primary'>វត្តមាន</span>";
                                }
                                $('.tbody').append('[<tr class="child">' +
                                    '<td>' + ++i + '</td>' +
                                    '<td>' + item.staff_id + '</td>' +
                                    '<td>' + item.date + '</td>' +
                                    '<td>' + status + '</td>' +
                                    '<td>' + item.check_in + '</td>' +
                                    '<td>' + item.check_out + '</td>' +
                                    '<td>' + item.num_hour + '</td>' +
                                    '<td>' + item.note + '</td>' +
                                    '</tr>]');

                                $('.total_num_hour').html(item.total_num_hour);
                                $('.total_salary').html(item.total_salary);
                                $('.total_num_hour_').val(item.total_num_hour);
                                $('.total_salary_').val(item.total_salary);
                            });
                        }
                    });
                }
            });

        });
    </script>
@endsection
