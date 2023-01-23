@extends('layouts.master')

@section('title-page', __('app.role_permission'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.role_permission') }}</h3>
                    <div class="card-tools">
                        @can('Role List')
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary"> <i class="fas fa-arrow-left"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form id="customerForm" action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="{{ __('app.label_name') }}">
                                    @if ($errors->has('name'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('app.label_permission') }} <small class="text-red">*</small></label>
                                    <select name="permission[]" class=" form-control select2" multiple>
                                        @foreach ($permission as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('permission'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('permission') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm pl-3 pr-3 btn-primary"> <i class="fas fa-save"></i>
                            {{ __('app.btn_save') }}</button>

                    </form>
                </div>
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
        });
    </script>
@endsection
