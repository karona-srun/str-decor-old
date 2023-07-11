<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name }} | {{ __('app.btn_print') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <style type="text/css">
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
        }

        @page {
            size: A4;
            margin: 0mm;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                padding: 5mm;
            }

            .font-1rem {
                font-size: 1rem;
            }
        }

        .text-end {
            text-align: end;
        }

        .font-1rem {
            font-size: 1rem;
        }

        th:nth-child(odd) {
            color: #ffffff;
            background-color: #007bff !important;
        }

        th:nth-child(even) {
            color: #ffffff;
            background-color: #007bff !important;
        }
    </style>
</head>

<body>
    <div class="content page p-3">
        <div class=" container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="margin-top: -7px;">
                        <img src="{{ asset($profile->photo) }}" class="img-size-150" alt="logo">
                        {{ $profile->name }}
                    </h3>
                    <p class="mt-4">{{ __('app.customer')}} {{ $quote->customer->customer_name ?? '' }} <br>
                        {{ __('app.phone')}} {{ $quote->customer->customer_phone ?? '' }} <br>
                        {{__('app.label_address')}} {{ $quote->customer->customer_address ?? '' }}</p>
                </div>
                <div class="col-sm-6">
                    <div class="float-right text-end">
                        <h3>{{ $profile->name }}
                            <br> <span class="font-1rem">{{ __('app.phone')}} {{ $profile->tel }}</span> <br><span
                                class="font-1rem">{{__('app.label_address')}} {{ $profile->address }}</span>
                        </h3>

                        <h6>{{ __('app.label_quote_no') }} :{{ $quote->quote_no }}</h6>

                        <h6>{{ __('app.table_date') }} :{{ $quote->date }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-2 mb-3">
                <div class="col-sm-12">
                    <h4 class=" text-center">{{ __('app.label_quote') }}</h4>
                </div>
            </div>
            <div class="row">
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
                                    <td>{{ $item->productes->product_name }}</td>
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
                <div class="col-sm-3">
                    <table class=" table table-bordered">
                        <tfoot>
                            <tr>
                                <td>{{ __('app.label_total_amount') }}:</td>
                                <td>${{ $quote->total_amount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <h5>{{ __('app.label_term_and_conditions_quote') }}</h5>
                    {!! $quote->contract !!}
                </div>
                <div class="col-sm-3">
                    <p>{{ __('app.label_recipient_signature') }}</p>
                </div>
                <div class="col-sm-3">
                    <p>{{ __('app.label_handover_signature') }}</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
        window.onafterprint = back;

        function back() {
            window.history.back();
        }
    </script>
</body>

</html>
