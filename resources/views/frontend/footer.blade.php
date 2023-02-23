<div class="container">
    <footer class="mt-5">
        <div class="row">
            <div class="col-6 col-md-4 mb-3">
               <img src="{{ url($profile->photo)}}" class=" img-size-64" alt="" srcset="">
              <h5 class="mt-2">{{$profile->name}}</h5>
            </div>

            <div class="col-6 col-md-4 mb-3">
              <h6>{{ __('app.phone')}}{{__('app.contact')}}</h6>
                <p>{{$profile->tel}}</p>
            </div>

            <div class="col-6 col-md-4 mb-3">
                <h6>{{__('app.label_address')}}</h6>
                <p>{{$profile->address}}</p>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between border-top">
            <p class="mt-3"><strong>Copyright &copy; {{ now()->year - 1 }} - {{ now()->year }} <a
                        href="https://www.karonasrun.com" class=" text-white">Karona</a>.</strong> All rights
                reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#instagram"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </div>
    </footer>
</div>
