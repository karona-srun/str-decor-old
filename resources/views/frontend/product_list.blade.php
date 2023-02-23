@extends('layouts.frontend')

@section('content')
<div class="content">
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-muted">{{__('app.label_new_product')}}
                    <a href="{{ url()->previous() }}" class=" float-right btn btn-link text-muted text-md"> <i class="fas fa-angle-double-left"></i> {{ __('app.btn_back')}}</a>
                </h5>
                <hr class="style4">
                <div class="row">
                    @foreach ($productes as $product)
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
@section('js')
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
@endsection
