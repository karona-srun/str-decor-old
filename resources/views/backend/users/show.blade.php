@extends('layouts.master')

@section('title-page', __('app.user_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.user_info') }}</h3>
                    <div class="card-tools">
                        @can('User Edit')
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning"> <i
                                    class=" fas fa-edit"></i>
                                {{ __('app.btn_edit') }}</a>
                        @endcan
                        @can('User List')
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-footer shadow-2xl">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>{{ __('app.label_name') }}:
                                            <label>{{ $user->name }}</label>
                                        </p>
                                        <p class="text-black">{{ __('app.email') }}:
                                            <label>{{ $user->email }}</label>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-black">{{ __('app.table_staff_name') }}:
                                            <label>{{ $user->staff->full_name_kh ?? '' }}</label>
                                        </p>
                                        <p class="text-black">{{ __('app.table_status') }}:
                                            <label
                                                class="text-red">{{ $user->blocked ? __('app.label_unblocked') : __('app.label_blocked') }}</label>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="text-primary">{{ __('app.label_creator') }}</p>
                                        <p class="text-black">{{ __('app.created_by') }}:
                                            <label>{{ $user->creator->name ?? '' }}</label>
                                        </p>
                                        <p class="text-black">{{ __('app.created_at') }}:
                                            <label>{{ $user->created_at->format('d-m-Y h:i:s A') }}</label>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-primary">{{ __('app.label_updator') }}</p>

                                        <p class="text-black">{{ __('app.updated_by') }}:
                                            <label>{{ $user->updator->name ?? '' }}</label>
                                        </p>
                                        <p class="text-black">{{ __('app.updated_at') }}:
                                            <label>{{ $user->updated_at->format('d-m-Y h:i:s A') }}</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
