<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name }} | {{ __('app.btn_print') }}</title>
    <link rel="shortcut icon" sizes="114x114" href="{{ url($profile->photo) }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <style>
        @font-face {
            font-family: "Hanuman";
            src: url({{ url('assets/font/Hanuman.woff') }}) format("truetype");
        }

        html body {
            font-family: "Hanuman";
        }

        @page {
            size: auto;
            margin: 0mm;
        }

        @media print {
            html,
            body {
                padding: 0mm;
            }
            
            @page {
                size: auto;
                margin: 0mm;
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
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-12">
                    <h4 class=" text-center">{{ __('app.label_invoice') . ' - ' . __('app.sales_order') }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-12">
                            {{ __('app.customer_name') . ' : ' . $saleOrder->customer->customer_name }}
                            </dd>
                        <dt class="col-sm-12">
                            {{ __('app.label_address') . ' : ' . $saleOrder->customer->customer_address }}</dd>
                    </dl>
                </div>
                <div class="col-md-6 justify-content-end text-right">
                    <dl class="row justify-content-end">
                        <dt class="col-sm-12">#{{ $saleOrder->sale_order_no }}</dt>
                        <dt class="col-sm-12">{{ __('app.table_date') }} : {{ $saleOrder->created_at}}</dt>
                        <dt class="col-sm-12">{{ __('app.table_staff_name') }} :
                            {{ app()->getLocale() == 'kh' ? $saleOrder->user->staff->full_name : $saleOrder->user->staff->full_name_kh }}
                        </dt>
                        <dt class="col-sm-12">{{ __('app.position') }} :
                            {{ app()->getLocale() == 'kh' ? $saleOrder->user->staff->positions->name : $saleOrder->user->staff->positions->name }}
                        </dt>
                    </dl>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-border" border="1">
                        <thead>
                            <th>{{ __('app.sale_order') }}</th>
                            <th>{{ __('app.warehouse_name') }}</th>
                            <th>{{ __('app.sale_person') }}</th>
                            <th>{{ __('app.sale_order_date') }}</th>
                            <th>{{ __('app.expected_shipment_date') }}</th>
                            <th>{{ __('app.delivery_method') }}</th>
                        </thead>
                        <tbody>
                            <td>{{ $saleOrder->sale_order }}</td>
                            <td>{{ $saleOrder->warehouse }}</td>
                            <td>{{ $saleOrder->sale_person }}</td>
                            <td>{{ $saleOrder->sale_order_date }}</td>
                            <td>{{ $saleOrder->expected_shipment_date }}</td>
                            <td>{{ $saleOrder->delivery_method }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">{{ __('app.label_term_and_conditions_invoice') }}</label><br>
                    <p for="" class="text-break">{!! $profile->descrip_contract_invoice !!}</p>
                </div>
                <div class="col-sm-3"><dt>{{ __('app.label_recipient_signature') }}</dt></div>
                <div class="col-sm-3"><dt>{{ __('app.label_handover_signature') }}</dt></div>
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
