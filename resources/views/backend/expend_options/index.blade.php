@extends('layouts.master')

@section('title-page', __('app.expend_options'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.expend_options') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/expend-options-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a>
                        @can('Option Expend Create')
                        <a href="{{ url('expend-options/create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_note') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.updated_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expends as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>{{ $item->updated_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>
                                        @can('Option Expend Edit')
                                        <button class="btn btn-sm btn-primary editExpend" data-toggle="modal"
                                            data-target="#modal-default-view" data-id="{{ $item->id }}"><i
                                                class="far fa-eye"></i></button>
                                        @endcan
                                        @can('Option Expend Edit')
                                        <button class="btn btn-sm btn-warning editExpend" data-toggle="modal"
                                            data-target="#modal-default-edit" data-id="{{ $item->id }}"><i
                                                class="far fa-edit"></i></button>
                                        @endcan
                                        @can('Option Expend Delete')
                                        <button class="btn btn-sm btn-danger deleteIncome" data-toggle="modal"
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
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">{{ __('app.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.btn_edit') }}{{ __('app.expend_options') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quickForm" action="{{ url('/update-expend-options') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" class="id">
                        <div class="form-group">
                            <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                            <input type="text" name="name" id="name" class="form-control name" required
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('app.label_note') }}</label>
                            <input type="text" name="note" id="note" class="form-control note"
                                placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary updatePosition">{{ __('app.btn_save') }}</button>
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
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_delete') }}</button>
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

            $(".editExpend").click(function() {
                var id = $(this).data("id");
                $('form .formUpdate').attr('action', 'expend-options/' + id);
                $.ajax({
                    type: "get",
                    url: "expend-options/" + id,
                    success: function(response) {
                        console.log(response);
                        $('.id').val(response.id)
                        $('.name').val(response.name)
                        $('.note').val(response.note)
                        $('.name').html(response.name)
                        $('.note').html(response.note)
                        $('.creator').html(response.created_by)
                        $('.created_at').html(response.createdat)
                        $('.updator').html(response.updated_by)
                        $('.updated_at').html(response.updatedat)
                    }
                });
            });

            $(".deleteIncome").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'expend-options/' + id);
            });

        });
    </script>
@endsection
