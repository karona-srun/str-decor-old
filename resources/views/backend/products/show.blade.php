@extends('layouts.master')

@section('title-page', __('app.product'))

@section('css')
    <style>
        .attachments {
            width: 150px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.product') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('productes.edit', $product->id) }}" class="btn btn-outline-warning"> <i
                                class=" fas fa-edit"></i>
                            {{ __('app.btn_edit') }} </a>
                        <a href="{{ url('/productes') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <a href="{{ url('products/', $product->photo) }}" data-fancybox="images">
                                    <img src="{{ url('products/', $product->photo) }}" class="img-rounded img-thumbnail"
                                        alt="" srcset="">
                                </a>
                                @if(sizeof($attachments))
                                    <p class="mt-3 ">{{ __('app.table_photo') }}</p>
                                @endif
                                @foreach ($attachments as $item)
                                    <a href="{{ url('attachments/', $item->name) }}" data-fancybox="images">
                                        <img src="{{ url('attachments/', $item->name) }}"
                                            class="mb-2 mr-2 img-rounded img-thumbnail attachments product-list-image" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 200px">{{ __('app.code') }}{{ __('app.product') }}</th>
                                    <td class=" text-break">: {{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_name') }}{{ __('app.product_category') }}</th>
                                    <td class=" text-break">: {{ $product->productCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_name') }}{{ __('app.product') }}</th>
                                    <td class=" text-break">: {{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_scale') }}{{ __('app.product') }}</th>
                                    <td class=" text-break">: {{ $product->scale }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_buying_price') }}</th>
                                    <td class=" text-break">: ${{ $product->buying_price }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_salling_price') }}</th>
                                    <td class=" text-break">: ${{ $product->salling_price }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_buying_date') }}</th>
                                    <td class=" text-break">: {{ $product->buying_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_product_qty') }}{{ __('app.label_store_stock') }}</th>
                                    <td class=" text-break">: {{ $product->store_stock }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_product_qty') }}{{ __('app.label_warehouse') }}</th>
                                    <td class=" text-break">: {{ $product->warehouse }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_product_qty') }}{{ __('app.label_sold_out') }}</th>
                                    <td class=" text-break">: {{ $product->sold_out ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_description') }}</th>
                                    <td class=" text-break">: {{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.label_note') }}</th>
                                    <td class=" text-break">: {{ $product->note }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('app.created_by') }}</th>
                                    <td class=" text-break">: {{ $product->creator->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.created_at') }}</th>
                                    <td class=" text-break">: {{ $product->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.updated_by') }}</th>
                                    <td class=" text-break">: {{ $product->updator->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('app.updated_at') }}</th>
                                    <td class=" text-break">: {{ $product->updated_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
