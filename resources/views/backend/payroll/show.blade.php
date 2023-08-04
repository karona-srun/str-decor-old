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
            margin-top: 3rem;
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
                    <h2 class="text-center title hide">{{ __('app.payroll') }}</h2>
                    <h4 class="text-center title hide">{{ __('app.table_date') }}: {{ $payroll->start_date }} - {{ $payroll->end_date }}</h4>
                    <h3 class="card-title">{{ __('app.payroll') }} {{ __('app.table_date') }}: {{ $payroll->start_date }} - {{ $payroll->end_date }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('payroll/summary', $payroll->id )}}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-print"></i>
                            {{ __('app.label_summary') }} </a>
                        <button type="button" class="btn btn-sm btn-outline-primary btn-print"> <i class="fas fa-print"></i>
                            {{ __('app.btn_print') }} </button>
                        <a href="{{ url('payroll') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                </div>

                <div class="card-body" id="printarea">
                    <div class="card-body">


                        <dl class="row">
                            <dt class="col-sm-2">{{ __('app.table_staff_name') }}</dt>
                            <dd class="col-sm-10">: {{ $staff->full_name_kh }}</dd>
                            <dt class="col-sm-2">{{ __('app.position') }}</dt>
                            <dd class="col-sm-10">: {{ $staff->positions->name }}</dd>
                            <dt class="col-sm-2">{{ __('app.work_place') }} </dt>
                            <dd class="col-sm-10">: {{ $staff->workplaces->name }}</dd>
                            <dt class="col-sm-2">{{ __('app.base_salary') }}</dt>
                            <dd class="col-sm-10">: ${{ $staff->base_salary }}</dd>
                            <dt class="col-sm-2">{{ __('app.rate_per_hour') }}</dt>
                            <dd class="col-sm-10">: ${{ $staff->rate_per_hour }}</dd>
                            <dt class="col-sm-2">{{ __('app.table_date') }}</dt>
                            <dd class="col-sm-10">: {{ $payroll->date }}</dd>
                            <dt class="col-sm-2">{{ __('app.table_status') }}</dt>
                            <dd class="col-sm-10">: {{ $payroll->payroll_status == 'paid' ? __('app.label_paid') : __('app.label_not_yet') }}</dd>
                            <dt class="col-sm-2">{{ __('app.label_note') }}</dt>
                            <dd class="col-sm-10">: {{ $payroll->note }}</dd>
                        </dl>
                    </div>
                    <div class="card-body">
                        <table id="myAttendance" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('app.table_no') }}</th>
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
                                        <td>{{ $item->date }}</td>
                                        <td>{{ Str::upper($item->status) }}</td>
                                        <td>{{ $item->check_in }}</td>
                                        <td>{{ $item->check_out }}</td>
                                        <td>{{ $item->num_hour }}</td>
                                        <td>{{ $item->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mt-3">{{__('app.label_total_hour_of_working')}}៖​ <span class="total_num_hour">{{ $payroll->total_hour }}</span>
                            {{__('app.label_hour')}}</p>
                        <input type="hidden" name="total_hour" class="total_num_hour_">
                        <p class="mt-3">{{__('app.payroll')}}​៖​ $<span class="total_salary">{{ $payroll->total_salary }}</span> </p>
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
