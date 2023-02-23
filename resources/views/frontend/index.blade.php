@extends('layouts.frontend')

@section('content')
<div class="content">
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted mb-3">{{__('app.product_category')}}</h5>
                        <hr>
                        <a href="{{ url('/') }}" class="btn btn-block btn-light text-sm-left">{{ __('app.label_all') }}</a>
                        @foreach ($productCategory as $cate)
                            <a href="{{ url('/product-categories',$cate->id)}}" class="btn btn-block btn-light text-sm-left">{{ $cate->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h5 class="text-muted">{{__('app.label_new_product')}}
                    <a href="{{ url('products-list')}}" class=" float-right btn btn-link text-muted text-md">{{ __('app.label_all')}} <i class="fas fa-angle-double-right"></i></a>
                </h5>
                <hr class="style4">
                <div class="row">
                    @foreach ($productes as $product)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">{{ $product->product_name }}</h5>
                                    <br>
                                    <p class="text-muted">{{ $product->product_code }}</p>
                                    <img src="{{ url('products/' . $product->photo) }}" class="img-item-product img-fluid">
                                    <p class="card-text text-muted">
                                        {{ Str::limit($product->description,50)  }}
                                    </p>

                                    <a href="{{ url('/product-details', $product->id) }}"
                                        class="btn btn-sm btn-outline-primary">{{ __('app.label_more_info') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="content bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 mb-2">
                <h5 class="text-muted">{{__('app.label_pop_product')}}
                    <a href="{{ url('products-list')}}" class=" float-right btn btn-link text-muted text-md">{{ __('app.label_all')}} <i class="fas fa-angle-double-right"></i></a>
                </h5>
                <hr class="style4">
                <div class="row">
                    @foreach ($producteRandom as $product)
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">{{ $product->product_name }}</h5>
                                    <br>
                                    <p class="text-muted">{{ $product->product_code }}</p>
                                    <img src="{{ url('products/' . $product->photo) }}" class="img-item-product img-fluid">
                                    <p class="card-text text-muted">
                                        {{ Str::limit($product->description,50)  }}
                                    </p>

                                    <a href="{{ url('/product-details', $product->id) }}"
                                        class="btn btn-sm btn-outline-primary">{{ __('app.label_more_info') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection