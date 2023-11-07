@extends('layouts.master')

@section('title-page', __('app.sale_dashboard'))

@section('content')
    <div class="row items-center align-content-center">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $saleDaily }}</h3>
                    <h6>{{ __('app.label_sale_daily') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
                <a href="{{ url('/sale-report') }}" class="small-box-footer">{{ __('app.label_more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $saleMonthly }}</h3>
                    <h6>{{ __('app.label_sale_monthly') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
                <a href="{{ url('/sale-report?start_date=' .Carbon::now()->firstOfMonth()->toDateString() .'&end_date=' .Carbon::now()->lastOfMonth()->toDateString()) }}"
                    class="small-box-footer">{{ __('app.label_more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $saleOrderDaily }}</h3>
                    <h6>{{ __('app.label_sale_order_daily') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
                <a href="{{ url('/sales-order') }}" class="small-box-footer">{{ __('app.label_more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>{{ $saleOrderMonthly }}</h3>
                    <h6>{{ __('app.label_sale_order_monthly') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dolly-flatbed"></i>
                </div>
                <a href="{{ url('/sales-order') }}"
                    class="small-box-footer">{{ __('app.label_more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row items-center align-content-center">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-fuchsia">
                <div class="inner">
                    <h3>${{ $saleAmountDaily }}</h3>
                    <h6>{{ __('app.label_sale_daily') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="{{ url('/sale-report') }}" class="small-box-footer">{{ __('app.label_more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-orange">
                <div class="inner">
                    <h3>${{ $saleAmountMonthly }}</h3>
                    <h6>{{ __('app.label_sale_monthly') }}</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="{{ url('/sale-report?start_date=' .Carbon::now()->firstOfMonth()->toDateString() .'&end_date=' .Carbon::now()->lastOfMonth()->toDateString()) }}"
                    class="small-box-footer">{{ __('app.label_more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('app.label_sale_report') }}</h3>
                        <a href="{{ url('sale-report') }}">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">$18,230.00</span>
                            <span>Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </p>
                    </div> --}}
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="barchart_material" class="chart"
                            style=" height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('app.label_report') }}{{ __('app.product') }}</h3>
                        {{-- <a href="javascript:void(0);">View Report</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var labels = {!! json_encode($labels) !!};
        var records = {!! json_encode($data) !!};
        var oldRecords = {!! json_encode($oldData) !!};

        var label = 'របាយការណ៍ ' + new Date().getFullYear();
        var date = new Date();
        var oldLabel = 'របាយការណ៍ ' + parseInt(date.getFullYear() - 1);

        const data = {
            labels: labels,
            datasets: [{
                    label: oldLabel,
                    backgroundColor: '#6c757d',
                    data: oldRecords,
                    borderWidth: 1,
                },
                {
                    label: label,
                    backgroundColor: '#007bff',
                    data: records,
                    borderWidth: 1,
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        fontColor: "#333",
                        fontSize: 14
                    }
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('barchart_material'),
            config
        );

        //pie chart data
        var cData = JSON.parse(`<?php echo $chart_data; ?>`);
        var ctx = $("#pie-chart");

        var data1 = {
            labels: cData.label,
            datasets: [{
                data: cData.data,
                backgroundColor: [
                    "#DEB887",
                    "#A9A9A9",
                    "#DC143C",
                    "#F4A460",
                    "#2E8B57",
                    "#1D7A46",
                    "#CDA776",
                ],
                borderColor: [
                    "#CDA776",
                    "#989898",
                    "#CB252B",
                    "#E39371",
                    "#1D7A46",
                    "#F4A460",
                    "#CDA776",
                ],
                borderWidth: [1, 1, 1, 1, 1, 1, 1]
            }]
        };

        //options
        var options = {
            responsive: true,
            legend: {
                display: true,
                position: "top",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            },
            title: {
                display: true,
                text: "ចំនួនប្រភេទ និងផលិតផល",
                position: "top",
                fontSize: 18,
                fontColor: "#111"
            }
        };

        //create Pie Chart class object
        var chart1 = new Chart(ctx, {
            type: "pie",
            data: data1,
            options: options
        });
    </script>

@endsection
