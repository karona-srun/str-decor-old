@extends('layouts.master')

@section('title-page', __('app.staff_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.staff_info') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('staff-info/create') }}" class="btn btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.table_photo') }}</th>
                                <th>{{ __('app.table_name') }}</th>
                                <th>{{ __('app.table_name_kh') }}</th>
                                <th>{{ __('app.phone') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.position') }}</th>
                                <th>{{ __('app.work_place') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.updated_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffInfo as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td style="width:70px !important"><img src="{{ 'photos/'.$item->photo }}" class="img-size-50 img-thumbnail" srcset=""/></td>
                                    <td>{{ $item->first_name}} {{ $item->last_name}}</td>
                                    <td>{{ $item->first_name_kh}} {{ $item->last_name_kh}}</td>
                                    <td>{{ $item->phone}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->positions->name ?? '' }}</td>
                                    <td>{{ $item->workplaces->name ?? '' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('staff-info',$item->id) }}" class="btn btn-sm btn-primary"><i
                                                class="far fa-eye"></i></a>
                                        <button class="btn btn-sm btn-danger deleteStaff" data-toggle="modal"
                                        data-target="#modal-default" data-id="{{ $item->id }}"><i
                                                class="far fa-trash-alt"></i></button>
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

            $(".deleteStaff").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'staff-info/' + id);
            });

        });
    </script>
@endsection
