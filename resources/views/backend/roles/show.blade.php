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
                        <a href="{{ route('roles.index') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i>
                            {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.label_name') }}</label>
                        </div>
                        <div class="col-sm-10">
                            <p>: {{ $role->name }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <label>{{ __('app.label_permission') }}</label>
                        </div>
                        <div class="col-sm-10">:
                            @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $v)
                                    <p class="text-md badge badge-primary">{{ $v->name }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
