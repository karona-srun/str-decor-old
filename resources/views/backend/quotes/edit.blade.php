@extends('layouts.master')

@section('title-page', __('app.label_create') . __('app.quote'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ route('quotes.update', $quote->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_create') }}{{ __('app.quote') }}</h3>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-save"></i>
                                {{ __('app.btn_save') }}</button>
                            @can('Time Create')
                                <a href="{{ url('quotes') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-arrow-left"></i>
                                    {{ __('app.btn_back') }}</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <label>{{ __('app.customer') }}</label>
                                <select class="form-control select2 customer" name="customer" style="width: 100%;">
                                    <option value="">{{ __('app.table_choose') }}</option>
                                    @foreach ($customers as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $quote->customer->id ? 'selected' : '' }}>
                                            {{ $item->customer_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('customer'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('customer') }}</div>
                                @endif
                            </div>
                            <div class="col-3 div-toggle">
                                <label>{{ __('app.phone') }}</label>
                                <input type="text" name="customer_phone" class="form-control customer_phone" value="{{ $quote->customer->customer_phone }}" readonly>
                            </div>
                            <div class="col-3 div-toggle">
                                <label>{{ __('app.label_address') }}</label>
                                <input type="text" name="customer_address" class="form-control customer_address"
                                    readonly value="{{ $quote->customer->customer_address }}">
                            </div>
                            <div class="col-3 div-toggle">
                                <label>{{ __('app.table_date') }}</label>
                                <input type="date" name="date" class="form-control" value="{{ $quote->date}}">
                                @if ($errors->has('date'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-sm btn-light mb-2" id="addBtn" type="button">
                                    <i class="fas fa-plus"></i> {{ __('app.label_create') }}
                                </button>
                                <table id="item-table" class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('app.code') }}</th>
                                            <th style="width: 30%">{{ __('app.product') }}</th>
                                            <th>{{ __('app.label_qty') }}</th>
                                            <th>{{ __('app.label_price') }}</th>
                                            <th>{{ __('app.label_unit') }}</th>
                                            <th>{{ __('app.label_total_amount') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($quote->quoteDetail as $item)
                                            <tr>
                                                <td>
                                                    <input type="text" name="code[]" class="form-control code" readonly
                                                        value="{{ $item->productes->product_code }}">
                                                </td>
                                                <td>
                                                    <select class="form-control select2_el product" name="product[]">
                                                        @foreach ($products as $prod)
                                                            <option value="{{ $prod->id }}"
                                                                {{ $prod->id == $item->product_id ? 'selected' : '' }}>
                                                                {{ $prod->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="qty[]" class="form-control qty"
                                                        value="{{ $item->qty }}">
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="number" name="amount[]" class="form-control amount"
                                                            value="{{ $item->amount }}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="unit[]" class="form-control unit"
                                                        value="{{ $item->unit }}">
                                                </td>
                                                <td>
                                                    <input type="number" id="total_amount" name="total_amount[]"
                                                        class="form-control total_amount" value="{{ $item->total_amount }}"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm remove"><i
                                                            class="fas fa-minus"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('app.label_descrip_contract') }}</label>
                                    <textarea class="summernote" name="contract">{{ $quote->contract }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(e) {

            if (e.type === 'keyup' && e.keyCode !== 10 && e.keyCode !== 13) return;
            calculate();

            $('.div-toggle').show();

            $('.customer').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                $.ajax({
                    type: "get",
                    url: "/get-customer/" + $(this).val(),
                    cache: "false",
                    dataType: "json",
                    success: function(data) {
                        $('.customer_phone').val(data.customer_phone)
                        $('.customer_address').val(data.customer_address)
                    }
                });

                if (valueSelected == 0) {
                    $('.div-toggle').hide();
                } else {
                    $('.div-toggle').show();
                }
            });

            $('.summernote').summernote({
                height: 200,
                placeholder: 'សរសេរពិពណ៌នាកិច្ចសន្យា',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']], //Specific toolbar display
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['fontname', ['fontname']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['view', ['fullscreen']],
                ]
            })

            // Denotes total number of rows
            var rowIdx = 0;

            // jQuery button click event to add a row
            $('#addBtn').on('click', function() {
                $('#tbody').append(`
                    <tr id="R${++rowIdx}">
                        <td>
                            <input type="text" name="code[]" id="code${rowIdx}" class="form-control code" readonly>
                        </td>
                        <td>
                            <select class="form-control select2_el product" name="product[]">
                                <option value="0">{{ __('app.table_choose') }}</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control qty" >
                        </td>
                        <td>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount[]" class="form-control amount" id="amount${rowIdx}" readonly>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="unit[]" class="form-control unit" >
                        </td>
                        <td>
                            <input type="number" id="total_amount" name="total_amount[]" class="form-control total_amount" readonly>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger btn-sm remove"><i class="fas fa-minus"></i></button>
                        </td>
                    </tr>
                `);
                initailizeSelect2(rowIdx);
                calculate();
            });

            $('#tbody').on('click', '.remove', function() {
                var child = $(this).closest('tr').nextAll();
                $(this).closest('tr').remove();
                rowIdx--;
            });

            function initailizeSelect2(rowIdx) {
                $(".product").change(function(e) {
                    $.ajax({
                        type: "get",
                        url: "/get-product/" + $(this).val(),
                        cache: "false",
                        dataType: "json",
                        success: function(data) {
                            $('#code' + rowIdx).val(data.product_code)
                            $('#amount' + rowIdx).val(data.salling_price)
                        }
                    });
                });

                $(".select2_el").select2({
                    ajax: {
                        url: "/get-products",
                        type: "get",
                        dataType: 'json',
                        delay: 150,
                        data: function(params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: $.map(response, function(item) {
                                    return {
                                        text: item.product_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            }

            function calculate() {
                $(".qty, .amount").on("keyup", function() {
                    var selectors = $(this).closest('tr'); //get closest tr
                    var quantity = selectors.find('.qty').val(); //get qty
                    if (!quantity || quantity < 0) {
                        selectors.find('.total_amount').val('');
                    }
                    var price = parseFloat(selectors.find('.amount').val());
                    var total = (price * quantity);
                    selectors.find('.total_amount').val(total); //add total
                    // var mult = 0;
                    // //loop through trs
                    // $("tr").each(function() {
                    //     //get total value check its not "" else give value =0 to avoid Nan error
                    //     var total = $(this).find(".total").text() != "" ? $(this).find(".total")
                    //     .text() : 0;
                    //     mult = parseFloat(total) + mult;
                    // })
                    // //add value to div
                    // $(".total_amount").text(mult);
                });
            }
        });
    </script>
@endsection
