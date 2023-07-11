@extends('layouts.master')

@section('title-page', __('app.settings'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ url('system-profile', $profile->id) }}" class="system-profile" method="post"enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.settings') }}</h3>
                        <div class="card-tools">
                            @can('System Profile Create')
                                <button type="submit" class="btn btn-sm btn-primary btn-save"> <i
                                        class=" fas fa-save"></i>
                                    {{ __('app.btn_save') }}</button>
                            @endcan
                            @can('System Profile Edit')
                                <a href="#" class="btn btn-sm btn-warning btn-edit"> <i
                                        class=" fas fa-edit"></i>
                                    {{ __('app.btn_edit') }}</a>
                                <a href="#" class="btn btn-sm btn-danger btn-cancel"> 
                                    <i class="far fa-times-circle"></i>
                                    {{ __('app.btn_cancel') }}</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center mb-2 container">
                                    <img id="blah"
                                        src="{{ $profile->photo == ' ' ? asset('logo.png') : url($profile->photo) }}"
                                        width="150px"​ height="150px" class="rounded-circle img-bordered" alt=""
                                        srcset="">
                                    <input type="file" name="photo" id="imgInp" accept="image/*"
                                        class="btn btn-sm btn-file mt-2 imgInp" style="display: none">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-primary mt-2 blah">{{ __('app.btn_browser') }}</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.label_name') }}</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter ..."
                                                value="{{ $profile->name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.phone') }}</label>
                                            <input type="text" name="tel" class="form-control" placeholder="Enter ..."
                                                value="{{ $profile->tel }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.email') }}</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter ..."
                                                value="{{ $profile->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('app.label_address') }}</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Enter ...">{{ $profile->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('app.label_term_and_conditions_invoice') }} {{__('app.label_invoice')}}</label>
                                            <textarea id="summernote" name="descrip_contract_invoice">
                                                {{ $profile->descrip_contract_invoice }}
                                            </textarea>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('app.label_term_and_conditions_quote') }} {{__('app.label_quote')}}</label>
                                            <textarea id="summernote_quote" name="descrip_contract_quote">
                                                {{ $profile->descrip_contract_quote }}
                                            </textarea>                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {

            $('.btn-save').toggle();
            $('.btn-cancel').toggle();
            $('.system-profile *').prop('disabled', true);
            $('#summernote').summernote('disable');
            $('#summernote_quote').summernote('disable');

            $('.btn-edit').click( function() {
                $('.btn-save').toggle();
                $('.btn-edit').toggle(); 
                $('.btn-cancel').toggle(); 
                $('.system-profile *').prop('disabled', false);
                $('#summernote').summernote('enable');
                $('#summernote_quote').summernote('enable');
            });

            $('.btn-cancel').click( function() {
                $('.btn-save').toggle();
                $('.btn-edit').toggle(); 
                $('.btn-cancel').toggle(); 
                $('.system-profile *').prop('disabled', true);
                $('#summernote').summernote('disable');
                $('#summernote_quote').summernote('disable');
            });

            $('#summernote').summernote({
                height: 200,
                placeholder: 'សរសេរពិពណ៌នាកិច្ចសន្យា',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']], //Specific toolbar display
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['fontname', ['fontname']],
                    ['insert', ['link', 'picture']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['view', ['fullscreen']],
                ]
            })

            
            $('#summernote_quote').summernote({
                height: 200,
                placeholder: 'សរសេរពិពណ៌នាកិច្ចសន្យា',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']], //Specific toolbar display
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['fontname', ['fontname']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture']],
                    ['table', ['table']],
                    []
                    ['view', ['fullscreen']],
                ]
            })


            $(".btn-add-file").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-delete-file", function() {
                $(this).parents(".hdtuto").remove();
            });

            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }

            $('.blah').on('click', function() {
                $('.imgInp').trigger('click');
            });
        });
    </script>
@endsection
