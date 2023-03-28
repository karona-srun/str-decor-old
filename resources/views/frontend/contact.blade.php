@extends('layouts.frontend')

@section('content')
    <div class="content">
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-sm-12">
                    <h4>{{ __('app.label_contact') }}</h4>
                    <hr>
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-5 col-sm-12 text-center d-flex align-items-center justify-content-center">
                                <div class="">
                                    <img src="{{ asset($profile->photo) }}" alt="Logo" class="img-circle img-size-150"
                                        style="opacity: .8">
                                    <h1 class=" text-center"><strong>{{ $profile->name }}</strong></h1>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 p-5">
                                <div class="form-group">
                                    <h5><i class="fas fa-phone-volume mr-2"></i> <strong>{{ __('app.phone') }}{{ __('app.contact') }}</strong></h5>
                                    <p>{{ $profile->tel }}</p>
                                </div>
                                <div class="form-group">
                                    <h5><i class="fas fa-envelope-open-text mr-2"></i> <strong>{{ __('app.email') }}{{ __('app.contact') }}</strong></h5>
                                    <p>{{ $profile->email }}</p>
                                </div>
                                <div class="form-group">
                                    <h5><i class="fas fa-map-pin mr-2"></i> <strong>{{ __('app.label_address') }}</strong></h5>
                                    <p class="text-break">{{ $profile->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
