@extends('layouts.master')

@section('title-page', __('app.time'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.time') }}</h3>
                    <div class="card-tools">
                        @can('Time Create')
                        <a href="{{ url('times/create') }}" class="btn btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.label_no') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_start_time') }}</th>
                                <th>{{ __('app.label_end_time') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.updated_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($times as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>{{ $item->updated_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>
                                        @can('Time List')
                                        <button class="btn btn-sm btn-primary editPosition" data-toggle="modal"
                                            data-target="#modal-default-view" data-id="{{ $item->id }}"><i
                                                class="far fa-eye"></i></button>
                                        @endcan
                                        @can('Time Edit')
                                        <button class="btn btn-sm btn-warning editPosition" data-toggle="modal"
                                            data-target="#modal-default-edit" data-id="{{ $item->id }}"><i
                                                class="far fa-edit"></i></button>
                                        @endcan
                                        @can('Time Dalete')
                                        <button class="btn btn-sm btn-danger deletePosition" data-toggle="modal"
                                            data-target="#modal-default" data-id="{{ $item->id }}"><i
                                                class="far fa-trash-alt"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">បង្ហាញព័តមាន</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>{{ __('app.label_name') }}:</dt>
                        <dd class="name text-primary"></dd>
                        <dt>{{ __('app.label_start_time') }}:</dt>
                        <dd class="start_time text-primary"></dd>
                        <dt>{{ __('app.label_end_time') }}:</dt>
                        <dd class="end_time text-primary"></dd>
                        <dt>{{ __('app.label_note') }}:</dt>
                        <dd class="note text-primary"></dd>
                        <dt>{{ __('app.created_by') }}:</dt>
                        <dd class="creator text-primary"></dd>
                        <dt>{{ __('app.created_at') }}:</dt>
                        <dd class="created_at text-primary"></dd>
                        <dt>{{ __('app.updated_by') }}:</dt>
                        <dd class="updator text-primary"></dd>
                        <dt>{{ __('app.updated_at') }}:</dt>
                        <dd class="updated_at text-primary"></dd>
                    </dl>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('app.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.btn_edit') }}{{ __('app.label_amount') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quickForm" action="{{ url('/update-times') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" class="id">
                        <div class="form-group">
                            <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                            <input type="text" name="name" id="name" class="form-control name" required
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.label_start_time') }} <small class="text-red">*</small></label>
                            <input type="time" name="start_time" class="form-control start_time" required
                                placeholder="{{ __('app.label_required')}}{{__('app.label_amount')}}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.label_end_time') }} <small class="text-red">*</small></label>
                            <input type="time" name="end_time" class="form-control end_time" required
                                placeholder="{{ __('app.label_required')}}{{__('app.label_amount')}}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.label_note') }}</label>
                            <input type="text" name="note" id="note" class="form-control note"
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary updatePosition">{{ __('app.btn_save') }}</button>
                    </div>
                </form>
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
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('app.btn_delete') }}</button>
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

            $(".editPosition").click(function() {
                var id = $(this).data("id");
                $('form .formUpdate').attr('action', 'times/' + id);
                $.ajax({
                    type: "get",
                    url: "times/" + id,
                    success: function(response) {
                        $('.id').val(response.id)
                        $('.name').val(response.name)
                        $('.start_time').val(response.start_time)
                        $('.end_time').val(response.end_time)
                        $('.note').val(response.note)
                        $('.name').html(response.name)
                        $('.start_time').html(response.start_time)
                        $('.end_time').html(response.end_time)
                        $('.note').html(response.note)
                        $('.creator').html(response.created_by)
                        $('.created_at').html(response.createdat)
                        $('.updator').html(response.updated_by)
                        $('.updated_at').html(response.updatedat)
                    }
                });
            });

            $(".deletePosition").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'times/' + id);
            });

        });
    </script>
@endsection
