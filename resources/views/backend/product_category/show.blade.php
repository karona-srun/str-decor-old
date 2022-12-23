@extends('layouts.master')

@section('title-page', __('app.product_category'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.product_category') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/product-category') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.code') }}{{ __('app.product_category') }}</p>
                                <label>{{ $product_category->code }}</label>
                                <p class="text-black">{{ __('app.label_name') }}{{ __('app.product_category') }}</p>
                                <label>{{ $product_category->name }}</label>
                            </blockquote>
                        </div>
                        <div class="col-sm-6">
                            <blockquote>
                                <p class="text-black">{{ __('app.label_note') }}</p>
                                <label>{{ $product_category->note }}</label>
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
                                        <label>{{ $product_category->creator->name }}</label></p>
                                        <p class="text-black">{{ __('app.created_at') }}: 
                                        <label>{{ $product_category->created_at->format('d-m-Y h:i:s A') }}</label></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ __('app.label_updator') }}</p>

                                        <p class="text-black">{{ __('app.updated_by') }}: 
                                        <label>{{ $product_category->updator->name }}</label></p>
                                        <p class="text-black">{{ __('app.updated_at') }}: 
                                        <label>{{ $product_category->updated_at->format('d-m-Y h:i:s A') }}</label></p>
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
