<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
</head>

<body>
    <table class="table table-bordered table-striped" align="center" width="100%" style="border:1px solid #000">
        <thead>
            <tr>
                <th>{{ __('app.table_no') }}</th>
                <th>{{ __('app.label_type') }}</th>
                <th>{{ __('app.label_name') }}</th>
                <th>{{ __('app.label_payment_date') }}</th>
                <th>{{ __('app.label_amount') }}</th>
                <th>{{ __('app.label_total_amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($datas->groupby('expend_option_id') as $index => $items)
                @foreach ($items as $row)
                    <tr>
                        @php
                            $span = $items->count();
                        @endphp
                        @if ($loop->first)
                            @php
                                ++$i;
                            @endphp
                            <td rowspan="{{ $span }}">{{ $i }}</td>
                            <td rowspan="{{ $span }}">
                                {{ $row->expendOptions->name }}</td>
                        @endif
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->date }}</td>
                        <td>${{ $row->amount }}</td>
                        @if ($loop->first)
                            <td rowspan="{{ $span }}" class="bg-success">
                                ${{ $row->sumTotalAmount($row->expendOptions->id, Request::get('start_date') != null ? Request::get('start_date') : Carbon::today()->toDateString(), Request::get('end_date') != null ? Request::get('end_date') : Carbon::today()->toDateString()) }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
