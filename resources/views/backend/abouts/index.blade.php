@extends('layouts.master')

@section('title-page', __('app.label_about'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.label_content') }}</h3>
                    <div class="card-tools">
                        @can('About Create')
                        <a href="{{ route('abouts.create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
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
                                <th>{{ __('app.label_content') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($abouts as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! $item->content !!}</td>
                                    <td>
                                        @can('About Edit')
                                        <a href="{{ route('abouts.edit',$item->id)}}" class="btn btn-sm btn-link"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        @can('About Delete')
                                        <button type="button" class="btn btn-sm btn-link text-danger deleteAbout"
                                                data-toggle="modal" data-target="#modal-default"
                                                data-id="{{ $item->id }}"> <i class="fas fa-trash"></i> </button>
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
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                                class="fas fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-check-square"></i>
                            {{ __('app.btn_delete') }}</button>
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

            $('.deleteAbout').click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'abouts/' + id);
            });

        });
    </script>
@endsection
