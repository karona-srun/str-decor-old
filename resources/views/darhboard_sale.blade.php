@extends('layouts.master')

@section('title-page',__('app.sale_dashboard'))

@section('content')
<div class="row">
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
            <a href="{{ url('/sale-report?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString()) }}" class="small-box-footer">{{ __('app.label_more_info') }} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection
