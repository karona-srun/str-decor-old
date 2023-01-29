@extends('layouts.master')

@section('title-page', __('app.product'))

@section('css')
    <style>
        .custom-card-body {
            padding: 0.5rem 1.25rem !important;
        }
        .img-product{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.product') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary btn-transf-product"><i class=" fas fa-save"></i> {{__('app.btn_save')}}</button>
                        <a href="{{ url('productes') }}" class="btn btn-sm btn-outline-primary"> <i
                                class=" fas fa-arrow-left"></i>
                            {{ __('app.btn_back') }}</a>
                    </div>
                </div>
                <div class="card-body custom-card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ '/products/' . $product->photo }}" class="img-thumbnail img-product" srcset="" />
                        </div>
                        <div class="col-sm-8">

                            <dl class="row">
                                <dt class="col-sm-4">{{ __('app.code') }}{{ __('app.product') }}</dt>
                                <dd class="col-sm-8">: {{ $product->product_code }}</dd>
                                <dt class="col-sm-4">{{ __('app.product') }}</dt>
                                <dd class="col-sm-8">: {{ $product->productCategory->name }}</dd>
                                <dt class="col-sm-4">{{ __('app.code') }}{{ __('app.product_category') }}</dt>
                                <dd class="col-sm-8">: {{ $product->productCategory->code }}</dd>
                                <dt class="col-sm-4">{{__('app.product_category')}}</dt>
                                <dd class="col-sm-8">: {{ $product->productCategory->name }}</dd>
                              </dl>

                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ url('transf-productes-qty', $product->id) }}" method="post" class="transf-product">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>{{ __('app.label_warehouse') }}</label>
                                                    <input type="number" min="0" name="warehouse" id="warehouse"
                                                        class="form-control form-control-sm warehouse" readonly value="{{ $product->warehouse }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label>{{ __('app.label_store_stock') }}</label>
                                                    <input type="number" min="0" name="store_stock" id="store_stock"
                                                        class="form-control form-control-sm text-center store_stock">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

        $('.btn-transf-product').click( function() {
            $('.transf-product').submit();
        })

    });
</script>
@endsection
