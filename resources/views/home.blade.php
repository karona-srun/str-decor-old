@extends('layouts.master')

@section('title-page',__('app.dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-3 col-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $datas['customer'] }}</h3>
                <h6>{{ __('app.customer')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('customers') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $datas['staff'] }}</h3>
                <h6>{{ __('app.staff_info')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('staff-info') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $datas['position'] }}</h3>
                <h6>{{ __('app.position')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-road"></i>
            </div>
            <a href="{{ url('positions') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $datas['workplace'] }}</h3>
                <h6>{{ __('app.work_place')}}</h6>
            </div>
            <div class="icon">
                <i class="far fa-building"></i>
            </div>
            <a href="{{ url('workplace') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-5 col-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $datas['attendance'] }}</h3>
                <h6>{{ __('app.attendance')}}</h6>
            </div>
            <div class="icon">
                <i class="far fa-calendar-check"></i>
            </div>
            <a href="{{ url('attendances') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $datas['sale'] }}</h3>
                <h6>{{ __('app.sales')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ url('sales') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $datas['productCategory'] }}</h3>
                <h6>{{ __('app.product_category')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="{{ url('product-category') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $datas['product'] }}</h3>
                <h6>{{ __('app.product')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ url('productes') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-blue">
            <div class="inner">
                <h3>{{ $datas['income'] }}</h3>
                <h6>{{ __('app.income_info')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-history"></i>
            </div>
            <a href="{{ url('incomes') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient">
            <div class="inner">
                <h3>{{ $datas['expend'] }}</h3>
                <h6>{{ __('app.expend_info')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-history"></i>
            </div>
            <a href="{{ url('expends') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ $datas['user'] }}</h3>
                <h6>{{ __('app.user_info')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-users-cog"></i>
            </div>
            <a href="{{ url('users') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-olive">
            <div class="inner">
                <h3>{{ $datas['role'] }}</h3>
                <h6>{{ __('app.role_permission')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="{{ url('roles') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $datas['optionIncome'] }}</h3>
                <h6>{{ __('app.income_options')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="{{ url('income-options') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ $datas['optionExpend'] }}</h3>
                <h6>{{ __('app.expend_options')}}</h6>
            </div>
            <div class="icon">
                <i class="fas fa-chart-area"></i>
            </div>
            <a href="{{ url('expend-options') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-6">
        <div class="small-box bg-pink">
            <div class="inner">
                <h3>{{ $datas['time'] }}</h3>
                <h6>{{ __('app.work_time')}}</h6>
            </div>
            <div class="icon">
                <i class="far fa-clock"></i>
            </div>
            <a href="{{ url('times') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
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
