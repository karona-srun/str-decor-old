<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$profile->name}}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset($profile->photo) }}" alt="AdminLTE Logo"
                        class="img-circle img-size-64" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{$profile->name}}</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

               

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-sm btn-primary" href="{{ route('login') }}" role="button">
                            <i class="fas fa-sign-in-alt"></i> {{ __('app.label_login') }}
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item ml-2">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('register') }}" role="button">
                                <i class="fas fa-sign-out-alt"></i> Register
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header bg-white">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h1 class="m-0"> ស្វាគមន៍ចូលមកកាន់ {{ config('app.name', 'STR Funiture') }}</h1>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-8 offset-md-2">
                            <form action="{{ url('search') }}" method="GET">
                                <div class="input-group">
                                    <input type="search" name="q" value="{{ request()->get('q') }}" class="form-control" placeholder="{{__('app.label_type_your_keyword_here')}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mt-4 mb-4">
            
            </div>

            
            @yield('content')
        </div>
        <footer class="main-footer bg-primary">
            @include('frontend.footer')
        </footer>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    @yield('js')
</body>

</html>
