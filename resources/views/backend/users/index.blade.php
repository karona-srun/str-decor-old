@extends('layouts.master')

@section('title-page', __('app.user_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.user_info') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('users.exportexcel') }}" class="btn btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a>
                        @can('User Create')
                            <a href="{{ route('users.create') }}" class="btn btn-primary"> <i class=" fas fa-plus"></i>
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
                                <th>{{ __('app.table_staff_name') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.role_permission') }}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.updated_at') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $item)
                                <tr class="{{ $item->blocked ? 'bg-danger' : '' }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->staff->full_name_kh ?? '' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if (!empty($item->getRoleNames()))
                                            @foreach ($item->getRoleNames() as $v)
                                                <label class="text-sm badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i:s A') }}</td>
                                    <td>{{ $item->updated_at->format('d-m-Y h:i:s A') }}</td>
                                    <td style="width:80px">
                                        <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-primary"><i
                                                class="far fa-eye"></i></a>
                                        @can('User Edit')
                                        <a href="{{ url('/users/reset-password', $item->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-key"></i> </a>
                                        @endcan
                                        @if ($item->blocked == true)
                                            <a href="{{ url('/users/toggle-blocked/' . $item->id . '/' . $item->blocked) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-unlock-alt"></i></a>
                                        @else
                                            <a href="{{ url('/users/toggle-blocked/' . $item->id . '/' . $item->blocked) }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-user-lock"></i></a>
                                            {{-- <button class="btn btn-sm btn-danger toggleBlockUser" data-toggle="modal"
                                                data-target="#modal-default" data-id="{{ $item->id }}" data-block="{{ $item->blocked }}"><i
                                                    class="fas fa-user-lock"></i></button> --}}
                                        @endif
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

            $('.toastsDefaultSuccess').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".toggleBlockUser").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'users/' + id);
            });

        });
    </script>
@endsection
