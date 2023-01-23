@extends('layouts.master')

@section('title-page', __('app.expend_info'))

@section('css')
<style media="screen">
    .noPrint{ display: block; }
    .yesPrint{ display: block !important; }
  </style> 
  <style media="print">
    .noPrint{ display: none; }
    .yesPrint{ display: block !important; }
    .card {
        border: 0px solid #ffffff !important;
    }
    .card-title,.card-tools{
        display: none !important;
    }
    .title{
        display: block;
    }
  </style>  
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.expend_info') }}</h3>
                    <div class="card-tools">
                        <a href="{{ url('/expends-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a>
                        @can('Expend Create')
                        <a href="{{ url('expends/create') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-plus"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="expendTable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.label_type') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.label_payment_date') }}</th>
                                <th>{{ __('app.label_amount') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expends as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->expendOptions->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>${{ $item->amount }}</td>
                                    <td>
                                        @can('Expend Edit')
                                        <a href="{{ route('expends.show',$item->id) }}" class="btn btn-sm btn-primary"><i
                                                class="far fa-eye"></i></a>
                                        @endcan
                                        @can('Expend Edit')
                                        <a href="{{ route('expends.edit',$item->id) }}"  class="btn btn-sm btn-warning"><i
                                                class="far fa-edit"></i></a>
                                        @endcan
                                        @can('Expend Delete')
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

            $('#expendTable').DataTable({

            });


            $(".deleteIncome").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'expends/' + id);
            });

        });
    </script>
@endsection
