@extends('layouts.master')

@section('title-page', __('app.income_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.income_info') }}</h3>
                    <div class="card-tools">
                        @can('Income List')
                        <a href="{{ url('/incomes?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString()) }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_type') }}</p>
                                <label class="text-break">{{ $income->incomeOptions->name }}</label>
                            </blockquote>
                        </div>
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_name') }}</p>
                                <label class="text-break">{{ $income->name }}</label>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_payment_date') }}</p>
                                <label>{{ $income->date }}</label>
                            </blockquote>
                        </div>
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_amount') }}</p>
                                <label>${{ $income->amount }}</label>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <blockquote class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>{{ __('app.label_creator') }}</p>
                                        <p class="text-black">{{ __('app.created_by') }}: 
                                        <label>{{ $income->creator->name }}</label></p>
                                        <p class="text-black">{{ __('app.created_at') }}: 
                                        <label>{{ $income->created_at->format('d-m-Y h:i:s A') }}</label></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ __('app.label_updator') }}</p>

                                        <p class="text-black">{{ __('app.updated_by') }}: 
                                        <label>{{ $income->updator->name }}</label></p>
                                        <p class="text-black">{{ __('app.updated_at') }}: 
                                        <label>{{ $income->updated_at->format('d-m-Y h:i:s A') }}</label></p>
                                    </div>
                            </blockquote>
                        </div>
                    </div>
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
