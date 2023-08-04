@extends('layouts.master')

@section('title-page', __('app.notification'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.notification') }}</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.label_no') }}</th>
                                <th>{{ __('app.label_requester') }}</th>
                                <th>{{ __('app.label_notify_type') }}</th>
                                <th>{{ __('app.label_description') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $i => $notification)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $notification->data['name'] }}</td>
                                    <td><a href="#">{{ $notification->data['data'] == 'View sales' ? __('app.sales') : __('app.quote') }}</a></td>
                                    <td>{{ __('app.label_received_notification') }} <br>
                                        {{ $notification->data['name'] }} {{ __('app.label_request') }}<strong>{{ $notification->data['data'] == 'View sales' ? __('app.sales') : __('app.quote') }}</strong>{{ __('app.label_to_you')}}</td>
                                    <td>{{ $notification->created_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>
                                        <a href="{{ $notification->data['data'] == 'View sales' ? url("/mark-as-read/sales", $notification->id ) : url("/mark-as-read/quotes", $notification->id ) }}" class="btn btn-sm btn-primary" data-id="{{ $notification->id }}"><i
                                                class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {});
    </script>
@endsection
