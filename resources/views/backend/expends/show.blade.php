@extends('layouts.master')

@section('title-page', __('app.expend_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.expend_info') }}</h3>
                    <div class="card-tools">
                        @can('Expend List')
                        <a href="{{ url('/expend?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString()) }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_type') }}</p>
                                <label class="text-break">{{ $expend->expendOptions->name }}</label>
                            </blockquote>
                        </div>
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_name') }}</p>
                                <label class="text-break">{{ $expend->name }}</label>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_payment_date') }}</p>
                                <label>{{ $expend->date }}</label>
                            </blockquote>
                        </div>
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_amount') }}</p>
                                <label>${{ $expend->amount }}</label>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                            <p class="text-sm">{{ __('app.attachments') }} <small class="text-red">*</small></p>
                            <button type="button" class="btn btn-link btn-preview">{{$expend->photo}} <i class="fas fa-expand ml-2"></i></button>
                            <div class="form-group div-preview">
                                <iframe src="{{asset('expends/'.$expend->photo )}}" frameborder="1" style="width:100vh; min-height:440px;"></iframe>
                            </div>   
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
                                        <label>{{ $expend->creator->name }}</label></p>
                                        <p class="text-black">{{ __('app.created_at') }}: 
                                        <label>{{ $expend->created_at->format('d-m-Y h:i:s A') }}</label></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ __('app.label_updator') }}</p>

                                        <p class="text-black">{{ __('app.updated_by') }}: 
                                        <label>{{ $expend->updator->name }}</label></p>
                                        <p class="text-black">{{ __('app.updated_at') }}: 
                                        <label>{{ $expend->updated_at->format('d-m-Y h:i:s A') }}</label></p>
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
            $('.div-preview').hide();
            $('.btn-preview').click(function() {
                $(".div-preview").toggle();
            });
        });
    </script>
@endsection
