@extends('layouts.frontend')

@section('content')
    <div class="content">
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{ __('app.label_about') }}</h4>
                    <hr>

                    <div id="accordion">
                        @foreach ($abouts as $item)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse{{$item->id}}"
                                        aria-expanded="false">
                                        <strong> {{ $item->name }}</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{$item->id}}" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <h1>{!! $item->content !!}</h1>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
