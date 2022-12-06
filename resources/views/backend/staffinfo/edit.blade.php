@extends('layouts.master')

@section('title-page', __('app.staff_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ url('/staff-info') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.label_info') }}{{ __('app.staff_info') }}</h3>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-save"></i>
                                {{ __('app.btn_save') }}</button>
                            <a href="{{ url('staff-info') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }} </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-2 container">
                                        <img id="blah" src="{{ asset('assets/dist/img/user8-128x128.jpg') }}"
                                            width="150px"​ height="150px" class="rounded-circle img-bordered"
                                            alt="" srcset="">
                                        <input type="file" name="photo" id="imgInp" accept="image/*"
                                            class="btn btn-file mt-2 imgInp" style="display: none">
                                        <button type="button"
                                            class="btn btn-outline-primary mt-2 blah">{{ __('app.btn_browser') }}</button>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.first_name') }}<small class="text-red">*</small></label>
                                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                                    class="form-control" placeholder="{{ __('app.label_required') }} {{ __('app.first_name') }}">
                                                @if ($errors->has('first_name'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('first_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.last_name') }} <small class="text-red">*</small></label>
                                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                    class="form-control"
                                                    placeholder="{{ __('app.label_required') }} {{ __('app.last_name') }}">
                                                @if ($errors->has('last_name'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.first_name_kh') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="first_name_kh"
                                                    value="{{ old('first_name_kh') }}" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.first_name_kh') }}">
                                                @if ($errors->has('first_name_kh'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('first_name_kh') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.last_name_kh') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="last_name_kh" value="{{ old('last_name_kh') }}"
                                                    class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.last_name_kh') }}">
                                                @if ($errors->has('last_name_kh'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('last_name_kh') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.gender') }} <small class="text-red">*</small></label>
                                                <select class="form-control select2bs4" value="{{ old('gender') }}"
                                                    name="gender" style="width: 100%;">
                                                    <option value="female" selected="selected">ស្រី</option>
                                                    <option value="male">ប្រុស</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.phone') }} <small class="text-red">*</small></label>
                                                <input type="text" name="phone" value="{{ old('phone') }}"
                                                    class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.phone') }}">
                                                @if ($errors->has('phone'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('phone') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.email') }} <small class="text-red">*</small></label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.birth_of_date') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="date" name="birth_of_date"
                                                    value="{{ old('birth_of_date') }}" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.birth_of_date') }}">
                                                @if ($errors->has('birth_of_date'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('birth_of_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.birth_of_place') }} <small
                                                        class="text-red">*</small></label>
                                                <textarea name="birth_of_place" class="form-control" rows="4"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.birth_of_place') }}">{{ old('birth_of_place') }}</textarea>
                                                @if ($errors->has('birth_of_place'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('birth_of_place') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.current_place') }} <small
                                                        class="text-red">*</small></label>
                                                <textarea name="current_place" class="form-control" rows="4"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.current_place') }}">{{ old('current_place') }}</textarea>
                                                @if ($errors->has('current_place'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('current_place') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.position') }} <small class="text-red">*</small></label>
                                                <select class="form-control select2bs4" name="position"
                                                    style="width: 100%;">
                                                    @foreach ($position as $item)
                                                        <option value="0" selected="selected">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('position'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('position') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.work_place') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2bs4" name="work_place"
                                                    style="width: 100%;">
                                                    @foreach ($workPlace as $item)
                                                        <option value="0" selected="selected">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('work_place'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('work_place') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.base_salary') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2bs4" name="base_salary"
                                                    style="width: 100%;">
                                                    @foreach ($baseSalary as $item)
                                                        <option value="0" selected="selected">
                                                            {{ $item->name }} : {{ $item->amount }}$</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('base_salary'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('base_salary') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.work_time') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2bs4" name="work_time"
                                                    style="width: 100%;">
                                                    <option value="0" selected="selected">
                                                        {{ __('app.label_status_disabled') }}</option>
                                                    <option value="1">{{ __('app.label_status_visibled') }}</option>
                                                </select>
                                                @if ($errors->has('work_time'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('work_time') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.start_work') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="date" name="start_work" class="form-control"
                                                    value="{{ old('start_work') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.start_work') }}">
                                                @if ($errors->has('start_work'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('start_work') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.stop_work') }}</label>
                                                <input type="date" name="stop_work" class="form-control"
                                                    value="{{ old('stop_work') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.stop_work') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('app.label_note') }}</label>
                                                <textarea name="note" class="form-control" rows="4"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ old('note') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card p-3">
                                                <p>{{ __('app.attachments') }} <button
                                                        class="btn btn-sm btn-outline-primary btn-add-file"
                                                        type="button"><i class="fldemo fas fa-plus"></i>
                                                        {{ __('app.choose_file') }}</button></p>
                                                <div class="input-group hdtuto control-group lst increment">
                                                    <div class="input-group-btn">
                                                        <input type="file" name="filenames[]"
                                                            accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"
                                                            class="myfrm form-control form-control-sm form-no-border">
                                                    </div>
                                                </div>
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames[]"
                                                            accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"
                                                            class="myfrm form-control form-control-sm  form-no-border">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-danger btn-delete-file"
                                                                type="button"><i class="fldemo "></i> Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
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
