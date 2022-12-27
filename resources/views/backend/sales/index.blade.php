@extends('layouts.master')

@section('title-page', __('app.sales'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.label_list') }}{{ __('app.time') }}</h3>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection