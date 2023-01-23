@extends('layouts.auth')
@section('title-page','LogIn')
@section('content')
    <div class="col-md-12 col-sm-12">
        <div class="card-header text-center ">
            <a href="{{ url('/') }}" class="h1"><b>{{ config('app.name', 'STR Funiture') }}</b></a>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('app.email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__('app.email')}}{{ __('app.required')}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('app.label_password')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__('app.label_password')}}{{ __('app.required')}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('app.label_remember_me')}}
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-sm btn-primary btn-block">{{ __('app.label_login')}}</button>
                    </div>
                </div>
            </form>
            @if (Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">{{ __('app.label_forgot_password')}}</a>
                </p>
            @endif
            @if (Route::has('register'))
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new account</a>
                </p>
            @endif
        </div>
    </div>
@endsection
