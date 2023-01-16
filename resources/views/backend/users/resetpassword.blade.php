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
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary"><i class="has-icon fas fa-arrow-left"></i>
                            {{ __('app.btn_back') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form id="customerForm" action="{{ url('/users/update-password') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.label_password')}}</label>
                                    <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                                        placeholder="{{ __('app.label_password') }}">
                                    @if ($errors->has('password'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('app.label_confirm_password') }}</label>
                                    <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" value="{{ old('password_confirmation') }}"
                                        placeholder="{{ __('app.label_confirm_password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error text-danger text-sm mt-1">
                                            {{ $errors->first('password_confirmation') }}</div>
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