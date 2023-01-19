@extends('layouts.master')

@section('title-page', __('app.payroll'))

@section('css')
    <style media="screen">
        .noPrint {
            display: block;
        }

        .yesPrint {
            display: block !important;
        }
    </style>
    <style media="print">
        .noPrint {
            display: none;
        }

        .yesPrint {
            display: block !important;
        }

        .card {
            border: 0px solid #ffffff !important;
        }

        .card-title,
        .card-tools {
            display: none !important;
        }

        .title {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="text-center title hide">{{ __('app.label_info') }}{{ __('app.payroll') }}</h2>
                    <h3 class="card-title">{{ __('app.label_info') }}{{ __('app.payroll') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-print"> <i class="fas fa-print"></i>
                            {{ __('app.btn_print') }} </button>
                        <a href="{{ url('payroll') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body" id="printarea">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('app.table_staff_name') }}</label>
                                    <p>{{ $staff->full_name_kh }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.position') }} </label>
                                <p>{{ $staff->positions->name }}</p>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.base_salary') }}</label>
                                <p>${{ $staff->base_salary }}</p>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <label>{{ __('app.rate_per_hour') }}</label>
                                <p>${{ $staff->rate_per_hour }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.table_date') }}</label>
                                    <p>{{ $payroll->date }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.table_status') }}</label>
                                    <p>{{ $payroll->payroll_status }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6 div-toggle">
                                <div class="form-group">
                                    <label>{{ __('app.label_note') }}</label>
                                    <p class="text-break">{{ $payroll->note }}</p>
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
                            <tbody>
                                @foreach ($data as $i => $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->staff_id }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->check_in }}</td>
                                        <td>{{ $item->check_out }}</td>
                                        <td>{{ $item->num_hour }}</td>
                                        <td>{{ $item->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mt-3">សរុបម៉ោងធ្វើការ​៖​ <span class="total_num_hour">{{ $payroll->total_hour }}</span>
                            ម៉ោង</p>
                        <input type="hidden" name="total_hour" class="total_num_hour_">
                        <p class="mt-3">ប្រាក់ខែ​៖​ $<span class="total_salary">{{ $payroll->total_salary }}</span> </p>
                        <input type="hidden" name="total_salary" class="total_salary_">
                    </div>

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

            $(".btn-print").click(function() {
                //             $(".printarea").clone().appendTo("#print-me");
                // //Apply some styles to hide everything else while printing.
                // $("body").addClass("printing");
                // //Print the window.
                // window.print();
                // //Restore the styles.
                // $("body").removeClass("printing");
                // //Clear up the div.
                // $("#print-me").empty();
                $(".printarea").show();
                window.print();

            });


        });
    </script>
@endsection
