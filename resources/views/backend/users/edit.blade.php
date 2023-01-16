@extends('layouts.master')

@section('title-page', __('app.user_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.user_info') }}</h3>
                    <div class="card-tools">
                        @can('User List')
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form id="customerForm" action="{{ route('users.update', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('app.table_staff_name') }} <small
                                            class="text-red">*</small></label>
                                    <select name="staff_id" class=" form-control select2">
                                        <option value="">{{ __('app.table_choose') }}</option>
                                        @foreach ($staffInfo as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $user->staff_id ? 'selected' : '' }}>{{ $item->full_name_kh}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('customer_name'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('customer_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        placeholder="{{ __('app.label_name') }}">
                                    @if ($errors->has('name'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('app.email') }} <small class="text-red">*</small></label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        placeholder="{{ __('app.email') }}">
                                    @if ($errors->has('email'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('app.role_permission') }} <small
                                            class="text-red">*</small></label>
                                    <select name="roles[]" class=" form-control select2" multiple>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item }}" {{ in_array($item, $userRole) ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('roles'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('roles') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn pl-3 pr-3 btn-primary"> <i class="fas fa-save"></i>
                            {{ __('app.btn_save') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection