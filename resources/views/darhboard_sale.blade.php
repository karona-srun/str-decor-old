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
                    <i class="ion ion-bag"></i>
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
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('/sale-report?start_date=' .Carbon::now()->firstOfMonth()->toDateString() .'&end_date=' .Carbon::now()->lastOfMonth()->toDateString()) }}"
                    class="small-box-footer">{{ __('app.label_more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('app.label_sale_report') }}</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
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
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="barchart_material" class="chart"
                            style=" height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span  class="mr-2">
                            <i class="fas fa-square text-gray"></i> Last year
                        </span>
                        <span>
                            <i class="fas fa-square text-primary"></i> This year
                        </span>
                    </div>
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

        var label = 'របាយការណ៍'+ new Date().getFullYear();

        const data = {
            labels: labels,
            datasets: [
            {
                label: label,
                backgroundColor: '#6c757d',
                borderColor: 'rgb(255, 99, 132)',
                data: oldRecords,
            },{
                label: 'របាយការណ៍',
                backgroundColor: '#007bff',
                borderColor: 'rgb(255, 99, 132)',
                data: records,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('barchart_material'),
            config
        );
    </script>

@endsection
