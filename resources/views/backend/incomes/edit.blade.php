@extends('layouts.master')

@section('title-page', __('app.income_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.income_info') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/incomes') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('incomes', $income->id) }}" method="post">
                        {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.income_options') }} <small class="text-red">*</small></label>
                                        <select class="form-control select2" name="income_option" style="width: 100%;">
                                            <option value="" >{{ __('app.table_choose') }}</option>
                                            @foreach ($income_options as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $income->income_option_id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('income_option'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('income_option') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                        <input type="text" name="name" class="form-control" value="{{ $income->name }}"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                        @if ($errors->has('name'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_payment_date') }} <small class="text-red">*</small></label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $income->date }}"
                                            placeholder="{{ __('app.table_date') }}">
                                        @if ($errors->has('date'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('date') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_amount') }} <small class="text-red">*</small></label>
                                        <input type="number" name="amount" class="form-control" value="{{ $income->amount }}"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.label_amount') }}">
                                        @if ($errors->has('amount'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('amount') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <textarea rows="3" name="note" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ $income->note }}</textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('app.btn_save') }}</button>
                            </div>
                        </div>
                    </form>
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