@extends('layouts.frontend')

@section('content')
    <div class="content bg-light">
        <div class="container mt-4 mb-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-muted mb-3">{{ __('app.product_category') }}</h5>
                            <hr>
                            <a href="{{ url('/') }}"
                                class="btn btn-block btn-light text-sm-left">{{ __('app.label_all') }}</a>
                            @foreach ($productCategory as $cate)
                                <a href="#" class="btn btn-block btn-light text-sm-left">{{ $cate->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <h5 class="text-muted">ផលិតផលដែលពេញនិយម</h5>
                    <hr class="style4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-solid">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="col-12">
                                                <img src="{{ '/products/' . $product->photo }}" class="product-image"
                                                    alt="Product Image">
                                            </div>
                                            <div class="col-12 product-image-thumbs">
                                                <div class="product-image-thumb"><img
                                                        src="{{ '/products/' . $product->photo }}" alt="Product Image">
                                                </div>
                                                @foreach ($attachments as $item)
                                                    <div class="product-image-thumb"><img
                                                            src="{{ url('/attachments/', $item->name) }}"
                                                            alt="Product Image"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <h3 class="my-3">{{ $product->product_name }}</h3>
                                            <p>{{ Str::limit($product->description, 200) }}</p>
                                            <hr>

                                            <h5 class="mt-3">{{ __('app.label_scale') }}</h5>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-default btn-sm text-center">
                                                    <input type="radio" name="color_option" id="color_option_b1"
                                                        autocomplete="off">
                                                    <span class="text-lg">{{ $product->scale }}</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <nav class="w-100">
                                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                                    href="#product-desc" role="tab" aria-controls="product-desc"
                                                    aria-selected="true">{{ __('app.label_description') }}</a>
                                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                                    href="#product-comments" role="tab" aria-controls="product-comments"
                                                    aria-selected="false">{{ __('app.label_note') }}</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content p-3" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                                                aria-labelledby="product-desc-tab">
                                                {{ $product->description }}
                                            </div>
                                            <div class="tab-pane fade" id="product-comments" role="tabpanel"
                                                aria-labelledby="product-comments-tab"> {{ $product->note }} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content bg-white pt-1 pb-1">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-muted">ផលិតផលដែលពេញនិយម
                        <a href="http://" class=" float-right btn btn-link text-muted text-md">{{ __('app.label_all') }} <i
                                class="fas fa-angle-double-right"></i></a>
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
                                        <img src="{{ url('products/', $product->photo) }}"
                                            class="img-item-product img-fluid">
                                        <p class="card-text text-muted">
                                            {{ Str::limit($product->description, 50) }}
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
