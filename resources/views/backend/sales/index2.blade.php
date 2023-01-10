@extends('layouts.sale_master')

@section('title-page', __('app.sales'))

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div>
                <form action="{{ route('sales.index') }}" class="p-3 card card-primary card-outline" method="get">
                    <p class="label-box">{{ __('app.label_search') }}{{ __('app.product') }}</p>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ __('app.table_choose') }}</label>
                                <select class="select2 form-control" name="product_category" style="width: 100%">
                                    <option value="">{{ __('app.table_choose') }}</option>
                                    @foreach ($productCategory as $item)
                                        <option value="{{ $item->id }}"
                                            {{ Request::get('product_category') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ __('app.code') }}{{ __('app.product') }}</label>
                                <input type="text" class="form-control search_code" name="product_code"
                                    value="{{ Request::get('product_code') }}" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }}{{ __('app.product') }}</label>
                                <input type="text" class="form-control" name="product_name"
                                    value="{{ Request::get('product_name') }}" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>.</label>
                                <button type="submit"
                                    class="form-control btn btn-primary">{{ __('app.btn_accepted') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-body">
                            @if ($productes->isEmpty())
                                <h5 class="text-center"><i class="fas fa-info-circle"></i> {{ __('app.label_no_records') }}
                                </h5>
                            @else
                                <div class="row">
                                    @foreach ($productes as $i => $item)
                                        <div class="col-md-2 col-lg-3 col-xl-1-2">
                                            <div class="card">
                                                <img src="{{ 'products/' . $item->photo }}" class="card-img-top"
                                                    alt="...">
                                                <p class="badge badge-primary badge-price">
                                                    @foreach (explode('/', $item->salling_price) as $i => $row)
                                                        <span>${{ $row }}.00
                                                            @if ($i == 0)
                                                                <span>ចន្លោះ</span>
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                </p>
                                                <div class="card-body-cutom mb-2">
                                                    <p class="card-text">
                                                        {{ $item->product_code }} <br>
                                                        {{ $item->product_name }} <br>
                                                        {{ __('app.label_store_stock') }}៖ {{ $item->store_stock }}
                                                    </p>
                                                    <button type="button"
                                                        class=" justify-content-end card-link btn btn-primary btn-sm btn-add-cart"
                                                        data-toggle="modal" data-backdrop="static" data-target="#modal-lg"
                                                        data-id="{{ $item->id }}"><i
                                                            class="fas fa-cart-arrow-down"></i>
                                                        {{ __('app.label_add_cart') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! $productes->links() !!}
                        </div>
                    </div>
                </ul>
              </nav>

        </div>

        <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('app.label_fill_data') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('add-cart') }}" class="formAddCart" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="product_id" class="product_id">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.code') }}{{ __('app.product') }}</label>
                                        <input type="text" name="product_code" class="form-control product_code"
                                            readonly></input>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_name') }}{{ __('app.product') }}</label>
                                        <input type="text" name="product_name" class="form-control product_name"
                                            readonly></input>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_scale') }}</label>
                                        <input type="text" name="product_scale" class="form-control product_scale"
                                            readonly></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_qty') }}{{ __('app.product') }} <small
                                                class="text-red">*</small></label>
                                        <input type="number" name="product_qty" class="form-control input-qty"
                                            required></input>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_salling_price') }} <small
                                                class="text-red">*</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="product_price" step="any"
                                                class="form-control input-price"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_salling_price') }}"
                                                value="{{ old('salling_price') }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('app.label_note') }}</label>
                                        <textarea name="note" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-modal-close"
                                data-dismiss="modal">{{ __('app.btn_close') }}</button>
                            <button type="button" class="btn btn-link btn-alert" style="display: none"
                                data-toggle="modal" data-target="#myModalAlert"></button>
                            <button type="button" class="btn btn-link btn-alert-price" style="display: none"
                                data-toggle="modal" data-target="#myModalAlertPrice"></button>
                            <button type="submit"
                                class="btn btn-primary btn-submit">{{ __('app.btn_accepted') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal new customer --}}
    <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('app.label_new_customer') }}</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('new-customer') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('app.label_name') }}{{ __('app.customer') }} <small
                                        class="text-red">*</small></label>
                                <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name') }}"
                                    placeholder="{{ __('app.label_name') }}{{ __('app.customer') }}">
                                @if ($errors->has('customer_name'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('customer_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('app.phone') }} <small class="text-red">*</small></label>
                                <input type="text" name="customer_phone" class="form-control" required value="{{ old('customer_phone') }}"
                                    placeholder="{{ __('app.phone') }}">
                                @if ($errors->has('customer_phone'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('customer_phone') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('app.current_place') }} <small class="text-red">*</small></label>
                                <textarea name="customer_address" class="form-control" rows="3" required
                                    placeholder="{{ __('app.label_required') }}{{ __('app.current_place') }}">{{ old('customer_address') }}</textarea>
                                @if ($errors->has('customer_address'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('customer_address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <textarea name="note" id="" cols="30" class="form-control" rows="3"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ __('app.btn_close') }}</button>
                    <button type="submit"
                        class="btn btn-primary btn-submit">{{ __('app.btn_accepted') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    {{-- end modal new customer --}}

    <div class="modal fade" id="myModalAlert" tabindex="0" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.label_confirm') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('app.label_alert_qty') }} {{ __('app.label_qty') }}{{ __('app.label_store_stock') }} <span
                            class="span-qty"></span> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ __('app.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalAlertPrice" tabindex="0" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.label_confirm') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('app.label_alert_price') }} <span class="minPirce"></span> {{ __('app.label_to') }} <span
                            class="maxPirce"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ __('app.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete-cart">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form class="formDelete" action="foo" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-header">
                        <h5 class="modal-title text-bold">ផ្ទៀងផ្ទាត់</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('app.label_confirm_delete') }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalSubmitCart">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold">ផ្ទៀងផ្ទាត់</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('app.label_confirm_pay') }} <br><span class="text-danger">{{__('app.label_confirm_pay_1')}}</span> </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ __('app.btn_no') }}</button>
                    <button type="submit" class="btn btn-primary btn-accepted">{{ __('app.btn_yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('control-sidebar')
    <aside class="control-sidebar control-sidebar-light">
    @section('count', $addCart->count())
    @section('countSales', $sales->count())
    <div class="row p-3">
        <div class="col-sm-12" id="printarea">
            <h4 class="mb-3">{{ __('app.label_cart') }}</h4>
            <div class="card">
                <form action="{{ url('sales') }}" class="formCartList" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="customer" class="form-control select2" id="customer">
                                    <option value="">{{ __('app.table_choose')}}{{__('app.customer')}}</option>
                                    @foreach ($customers as $item)
                                        <option value="{{ $item->id }}">
                                            <p>{{ $item->customer_name }}</p>
                                            <p>{{ $item->customer_address }}</p>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modalNewCustomer" data-backdrop="static" >{{__('app.label_new_customer')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-responsive-xl" style="height: auto; width: 1229px; max-width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ __('app.label_no') }}</th>
                                    <th>{{ __('app.code') }}</th>
                                    <th>{{ __('app.label_name') }}</th>
                                    <th>{{ __('app.label_scale') }}</th>
                                    <th>{{ __('app.label_qty') }}</th>
                                    <th>{{ __('app.label_price') }}</th>
                                    <th>{{ __('app.label_note') }}</th>
                                    <th>{{ __('app.table_action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addCart as $index => $item)
                                    <tr>
                                        <td>{{ ++$index }}
                                            <input type="hidden" name="add_cart_id[]" value="{{ $item->id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                        </td>
                                        <td>{{ $item->product_code }}
                                            <input type="hidden" name="product_code[]" value="{{ $item->product_code }}">
                                        </td>
                                        <td>{{ $item->product_name }}
                                            <input type="hidden" name="product_name[]" value="{{ $item->product_name }}">
                                        </td>
                                        <td>{{ $item->scale }}
                                            <input type="hidden" name="scale[]" value="{{ $item->scale }}">
                                        </td>
                                        <td>{{ $item->qty }}
                                            <input type="hidden" name="qty[]" value="{{ $item->qty }}">
                                        </td>
                                        <td>{{ $item->price }}
                                            <input type="hidden" name="price[]" value="{{ $item->price }}">
                                        </td>
                                        <td>{{ $item->note }}
                                            <input type="hidden" name="note[]" value="{{ $item->note }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger deleteAddCart"
                                                data-toggle="modal" data-target="#modal-delete-cart"
                                                data-id="{{ $item->id }}"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{-- <a href="{{ url('/print-add-cart') }}" target="_blink" class="btn btn-outline-primary" {{ $addCart->isEmpty() ? 'disabled' : '' }}><i class="fas fa-print"></i> {{ __('app.btn_print') }}</a> --}}
                        <button type="button" class="btn btn-primary btn-pay" data-toggle="modal" data-target="#modalSubmitCart" {{ $addCart->isEmpty() ? 'disabled' : '' }}><i class="fas fa-save"></i> {{ __('app.btn_accepted') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>
@endsection

@section('js')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-accepted').click(function(){
            $('.formCartList, .btn-pay').removeAttr("type").attr("type", "submit").click();
        })

        var maxQty = 0,
            minPrice = 0
        maxPrice = 0;
        $('.btn-add-cart').click(function() {
            var product_id = $(this).data("id");
            var qty = $(this).closest("tr").find(".qty").val();
            var price = $(this).closest("tr").find(".price").val();
            var note = $(this).closest("tr").find(".note").val();
            $.ajax({
                url: "/get-product/" + product_id,
                method: "get",
                success: function(data) {
                    console.log(data);
                    $('.product_id').val(data.id)
                    $('.product_code').val(data.product_code)
                    $('.product_scale').val(data.scale)
                    $('.product_name').val(data.product_name)
                    maxQty = data.store_stock;
                    price = data.salling_price.split('/');
                    minPrice = price[0];
                    maxPrice = price[1];
                },
            });
        })

        var inputQty = 0;
        $('.input-qty').keyup(function() {
            inputQty = $(this).val();
            if (maxQty < inputQty) {
                $('.btn-alert').click();
                $('.span-qty').html(maxQty);
                $('.btn-submit').addClass('disabled')
            } else {
                $('.btn-submit').removeClass('disabled')
            }
        })

        var inputPrice = 0;
        minPrice
        $('.input-price').focusout(function(e) {
            inputPrice = $(this).val();
            var arr = minPrice.split('/');

            if (inputPrice <= minPrice) {
                $('.btn-alert-price').click();
                $('.minPirce').html('$' + minPrice);
                $('.maxPirce').html('$' + maxPrice);
                $('.btn-submit').addClass('disabled')
            } else {
                $('.btn-submit').removeClass('disabled')
            }
        });

        $('.input-qty, .input-price').focusout(function() {
            if ((maxQty < inputQty) || (inputPrice <= minPrice)) {
                $('.btn-submit').addClass('disabled')
            } else {
                $('.btn-submit').removeClass('disabled')
            }
        })

        $('.btn-modal-close').click(function() {
            $('.input-qty').val('')
            $('.input-price').val('')
        });

        $('.deleteAddCart').click(function() {
            var id = $(this).data("id");
            $('.formDelete').attr('action', '/add-cart/' + id);
        });

    });
</script>
@endsection
