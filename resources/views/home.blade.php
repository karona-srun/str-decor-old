@extends('layouts.master')

@section('title-page','ទំព័រដើម')

@section('content')
<div class="row">
    <div class="col-lg-3 col-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $data['customer'] }}</h3>
                <h6>{{ __('app.customer')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('customers') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $data['staff'] }}</h3>
                <h6>{{ __('app.staff_info')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('staff-info') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $data['position'] }}</h3>
                <h6>{{ __('app.position')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('positions') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $data['workplace'] }}</h3>
                <h6>{{ __('app.work_place')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('workplace') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-5 col-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $data['attendance'] }}</h3>
                <h6>{{ __('app.attendance')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('attendances') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $data['sale'] }}</h3>
                <h6>{{ __('app.sales')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('sales') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $data['productCategory'] }}</h3>
                <h6>{{ __('app.product_category')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('product-category') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $data['product'] }}</h3>
                <h6>{{ __('app.product')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('productes') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-blue">
            <div class="inner">
                <h3>{{ $data['income'] }}</h3>
                <h6>{{ __('app.income_info')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('incomes') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient">
            <div class="inner">
                <h3>{{ $data['expend'] }}</h3>
                <h6>{{ __('app.expend_info')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('expends') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ $data['user'] }}</h3>
                <h6>{{ __('app.user_info')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('users') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-olive">
            <div class="inner">
                <h3>{{ $data['role'] }}</h3>
                <h6>{{ __('app.role_permission')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('roles') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $data['optionIncome'] }}</h3>
                <h6>{{ __('app.income_options')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('income-options') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ $data['optionExpend'] }}</h3>
                <h6>{{ __('app.expend_options')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('expend-options') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-6">
        <div class="small-box bg-pink">
            <div class="inner">
                <h3>{{ $data['time'] }}</h3>
                <h6>{{ __('app.work_time')}}</h6>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('times') }}" class="small-box-footer">{{ __('app.label_more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
@endsection
