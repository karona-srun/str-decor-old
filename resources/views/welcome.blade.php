<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'STR Funiture') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav bg-primary">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name', 'STR Funiture') }}</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Some action </a></li>
                                <li><a href="#" class="dropdown-item">Some other action</a></li>

                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Hover for action</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                        </li>

                                        <!-- Level three dropdown-->
                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu3" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownSubMenu3"
                                                class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li>
                                        <!-- End Level three -->

                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                    </ul>
                </div>

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
            <div class="content-header bg-primary">
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

            <div class="content bg-light">
                <div class="container mt-4 mb-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted mb-3">{{__('app.product_category')}}</h5>
                                    <hr>
                                    <a href="{{ url('/') }}" class="btn btn-block btn-light text-sm-left">{{ __('app.label_all') }}</a>
                                    @foreach ($productCategory as $cate)
                                        <a href="#" class="btn btn-block btn-light text-sm-left">{{ $cate->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <h5 class="text-muted">ផលិតផលដែលពេញនិយម
                                <a href="http://" class=" float-right btn btn-link text-muted text-md">{{ __('app.label_all')}} <i class="fas fa-angle-double-right"></i></a>
                            </h5>
                            <hr class="style4">
                            <div class="row">
                                @foreach ($productes as $product)
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-muted">{{ $product->product_name }}</h5>
                                                <br>
                                                <p class="text-muted">{{ $product->product_code }}</p>
                                                <img src="{{ 'products/' . $product->photo }}" class="img-item-product img-fluid">
                                                <p class="card-text text-muted">
                                                    {{ Str::limit($product->description,50)  }}
                                                </p>

                                                <a href="#"
                                                    class="btn btn-sm btn-outline-primary">{{ __('app.label_more_info') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="content bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-4 mb-2">
                            <h5 class="text-muted">ផលិតផលថ្មីៗ
                                <a href="http://" class=" float-right btn btn-link text-muted text-md">{{ __('app.label_all')}} <i class="fas fa-angle-double-right"></i></a>
                            </h5>
                            <hr class="style4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer bg-primary">
            @include('frontend.footer')
        </footer>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
