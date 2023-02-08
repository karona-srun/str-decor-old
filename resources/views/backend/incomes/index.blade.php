@extends('layouts.master')

@section('title-page', __('app.income_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">

                <form action="{{ url('incomes') }}" class="p-3" method="get">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.income_info') }}</h3>
                    <div class="card-tools">
                            <input type="hidden" name="export" class="export" value="enabled">
                            <button type="submit" class="btn btn-sm btn-outline-primary exportexcel"> <i class=" fas fa-download"></i>
                                {{ __('app.btn_download') }}</button>
                       
                            @can('Income List')
                            <a href="{{ url('incomes/create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
                                {{ __('app.btn_add') }}</a>
                            @endcan 
                    </div>
                </div>
                    <div class="row mt-2">
                        <div class="col-sm-3 mb-2">
                            <select class="select2 form-control" name="income_option" style="width: 100%">
                                <option value="">{{ __('app.table_choose') }}</option>
                                @foreach ($income_options as $item)
                                    <option value="{{ $item->id }}"
                                        {{ Request::get('income_option') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 mb-2">
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ Request::get('start_date') != null ? Request::get('start_date') : Carbon::today()->toDateString() }}"" placeholder="{{ __('app.code') }}{{ __('app.product') }}" />
                        </div>
                        <div class="col-sm-2 mb-2">
                            <input type="date" class="form-control" name="end_date"
                                value="{{ Request::get('end_date') != null ? Request::get('end_date') : Carbon::today()->toDateString() }}" placeholder="{{ __('app.label_name') }}{{ __('app.product') }}" />
                        </div>
                        <div class="col-sm-3 mb-2">
                            <button type="submit"
                                    class="btn btn-primary noexportexcel"> <i class="fas fa-search"></i> {{ __('app.label_search') }}</button>
                            <a href="{{ url('incomes' )}}" class="btn btn-danger"><i class="fas fa-broom"></i> {{__('app.btn_clean')}}</a>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.label_type') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_payment_date') }}</th>
                                <th>{{ __('app.label_amount') }}</th>
                                <th>{{ __('app.label_total_amount') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($incomes->groupby('income_option_id') as $index => $items)
                                @foreach ($items as $row)
                                    <tr>
                                        @php
                                            $span = $items->count();
                                        @endphp
                                        @if ($loop->first)
                                            @php
                                                ++$i;
                                            @endphp
                                            <td rowspan="{{ $span }}">{{ $i  }}</td>
                                            <td rowspan="{{ $span }}">{{ $row->incomeOptions->name }}</td>
                                        @endif
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>${{ $row->amount }}</td>
                                        @if ($loop->first)
                                            <td rowspan="{{ $span }}" class="bg-success">
                                                ${{ $row->sumTotalAmount($row->incomeOptions->id, Request::get('start_date') != null ? Request::get('start_date') : Carbon::today()->toDateString(), Request::get('end_date') != null ? Request::get('end_date') : Carbon::today()->toDateString()) }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ url('incomes', $row->id) }}" class="btn btn-sm btn-ligth"> <i
                                                    class="fas fa-eye"></i> </a>
                                            <a href="{{ route('incomes.edit', $row->id) }}" class="btn btn-sm btn-link"> <i
                                                    class="fas fa-edit"></i> </a>
                                            <button type="button" class="btn btn-sm btn-link text-danger deleteIncome"
                                                data-toggle="modal" data-target="#modal-default"
                                                data-id="{{ $row->id }}"> <i class="fas fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered">
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
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal"><i class="fas fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-check-square"></i> {{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.exportexcel').click(function() {
                $('.export').val('enabled');
            });

            $('.noexportexcel').click(function() {
                $('.export').val('');
            });

            $(".deleteIncome").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'incomes/' + id);
            });

        });
    </script>
@endsection
