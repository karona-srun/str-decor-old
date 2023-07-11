@extends('layouts.master')

@section('title-page', __('app.label_list') . __('app.quote'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        @can('Quote Edit')
                            <a href="{{ url('quotes-print', $quote->id) }}" class="btn btn-sm btn-light"> <i
                                    class="fas fa-print"></i>
                                {{ __('app.btn_print') }}</a>
                        @endcan
                        @can('Quote Edit')
                            <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-sm btn-warning"> <i
                                    class="fas fa-edit"></i>
                                {{ __('app.btn_edit') }}</a>
                        @endcan
                        @can('Quote List')
                            <a href="{{ url('quotes') }}" class="btn btn-sm btn-primary"> <i class="fas fa-arrow-left"></i>
                                {{ __('app.btn_back') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <dd class="col-md-12">
                            <div class=" float-none">
                                <div class="float-left">
                                    <h4>{{ $quote->quote_no }}</h4>
                                </div>
                            </div>
                            @if(Auth::user()->getIDRoles())
                            <form action="{{ url('quote-status') }}" method="post">
                                @csrf
                                <input type="hidden" name="quote_id" value="{{ $quote->id }}">
                            <div class=" float-right ml-2">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-eye"></i>
                                    {{ __('app.btn_accepted') }}</button>
                            </div>
                            <div class="float-right">
                                <select class="form-control form-control-sm select2s" required name="status">
                                    <option value="">{{ __('app.table_choose') }}</option>
                                    <option value="4" {{old('status',$quote->approve_status) == "4"? 'selected':''}}>{{ __('app.status_approved') }}</option>
                                    <option value="3" {{old('status',$quote->approve_status) == "3"? 'selected':''}}>{{ __('app.status_rejected') }}</option>
                                </select>
                            </div>
                            </form>
                            @endif
                        </dd>
                        <dd class=" col-sm-12">
                            <h6>{{ date('j-M-Y', strtotime($quote->date)) }}</h6>
                        </dd>
                        <dt class="col-sm-2">{{ __('app.customer') }}</dt>
                        <dd class="col-sm-10">: {{ $quote->customer->customer_name }}</dd>
                        <dt class="col-sm-2">{{ __('app.phone') }}</dt>
                        <dd class="col-sm-10">: {{ $quote->customer->customer_phone }}
                        <dt class="col-sm-2">{{ __('app.label_address') }}</dt>
                        <dd class="col-sm-10">: {{ $quote->customer->customer_address }}
                            </dl>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.code') }}</th>
                                        <th>{{ __('app.product') }}</th>
                                        <th>{{ __('app.label_qty') }}</th>
                                        <th>{{ __('app.label_unit') }}</th>
                                        <th>{{ __('app.label_price') }}</th>
                                        <th>{{ __('app.label_total_amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quote->quoteDetail as $item)
                                        <tr>
                                            <td>{{ $item->productes->product_code }}</td>
                                            <td>{{ $item->productes->product_name }}
                                                <dl class="row">
                                                    <dt class="col-sm-auto">
                                                        <input type="hidden" name="product_photo[]"
                                                            value="{{ $item->photo }}">
                                                        <img src="{{ asset('products/' . $item->productes->photo) }}"
                                                            class="float-left img-size-50">
                                                    </dt>
                                                    <dt class="col-sm-auto">
                                                        <span>{{ $item->product_name }}</span>
                                                        <input type="hidden" name="product_name[]"
                                                            value="{{ $item->productes->product_name }}">
                                                        <br>
                                                        <input type="hidden" name="product_note[]"
                                                            value="{{ $item->productes->note }}">
                                                        <small class="text-red">{{ $item->note }}</small>
                                                    </dt>
                                                </dl>
                                            </td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>${{ $item->amount }}</td>
                                            <td>${{ $item->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.label_total_amount') }}</th>
                                        <th>${{ $quote->total_amount }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>{{ __('app.label_term_and_conditions') }}</label>
                            <p>{!! $quote->contract !!}</p>
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
