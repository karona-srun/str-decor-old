@extends('layouts.master')

@section('title-page', __('app.btn_show').__('app.staff_info'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ url('staff-info',$staffInfo->id) }}" id="target" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.staff_info') }}</h3>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-sm btn-outline-primary" id="btn-save"> <i class="fas fa-save"></i>
                                {{ __('app.btn_save') }}</button>
                            <a type="button" class="btn btn-sm btn-outline-primary" id="btn-edit"> <i class=" fas fa-edit"></i>
                                    {{ __('app.btn_edit') }} </a>
                            <a href="{{ url('staff-info') }}" class="btn btn-sm btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }} </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-2 container">
                                        <img id="blah" src="{{ url('/photos/'.$staffInfo->photo) }}"
                                            width="150px"​ height="150px" class="rounded-circle img-bordered"
                                            alt="" srcset="">
                                        <input type="file" name="photo" id="imgInp" accept="image/*"
                                            class="btn btn-file mt-2 imgInp" style="display: none">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary mt-2 blah">{{ __('app.btn_browser') }}</button>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.first_name') }} <small class="text-red">*</small></label>
                                                <input type="text" name="first_name" value="{{ $staffInfo->first_name }}"
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
                                                <input type="text" name="last_name" value="{{ $staffInfo->last_name }}"
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
                                                    value="{{ $staffInfo->first_name_kh }}" class="form-control"
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
                                                <input type="text" name="last_name_kh" value="{{ $staffInfo->last_name_kh }}"
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
                                                <select class="form-control select2" value="{{ old('gender') }}"
                                                    name="gender" style="width: 100%;">
                                                    <option value="female" {{ "female" == $staffInfo->gender ? 'selected' : '' }}>ស្រី</option>
                                                    <option value="male" {{ "male" == $staffInfo->gender ? 'selected' : '' }}>ប្រុស</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.phone') }} <small class="text-red">*</small></label>
                                                <input type="text" name="phone" value="{{ $staffInfo->phone }}"
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
                                                <input type="email" name="email" value="{{ $staffInfo->email }}"
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
                                                    value="{{ date('Y-m-d', strtotime($staffInfo->birth_of_date)) }}" class="form-control"
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
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.birth_of_place') }}">{{ $staffInfo->birth_of_place }}</textarea>
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
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.current_place') }}">{{ $staffInfo->current_place }}</textarea>
                                                @if ($errors->has('current_place'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('current_place') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.position') }} <small class="text-red">*</small></label>
                                                <select class="form-control select2" name="position"
                                                    style="width: 100%;">
                                                    @foreach ($position as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $staffInfo->position ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('position'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('position') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.work_place') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2" name="work_place"
                                                    style="width: 100%;">
                                                    @foreach ($workPlace as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $staffInfo->work_place ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('work_place'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('work_place') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.base_salary') }} <small
                                                        class="text-red">*</small></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" name="base_salary" value="{{ $staffInfo->base_salary }}" placeholder="{{ __('app.label_required') }}{{ __('app.base_salary') }}">
                                                </div>
                                                @if ($errors->has('base_salary'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('base_salary') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.rate_per_hour') }} <small
                                                        class="text-red">*</small></label>
                                                
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" name="rate_per_hour" value="{{ $staffInfo->rate_per_hour }}" placeholder="{{ __('app.label_required') }}{{ __('app.rate_per_hour') }}">
                                                </div>
                                                @if ($errors->has('rate_per_hour'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('rate_per_hour') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.work_time') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2" name="work_time" style="width: 100%;">
                                                    @foreach ($times as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $staffInfo->work_time ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
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
                                                    value="{{ date('Y-m-d', strtotime($staffInfo->start_work)) }}"
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
                                                    value="{{ $staffInfo->stop_work == '' ? '' : date('Y-m-d', strtotime($staffInfo->stop_work)) }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.stop_work') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('app.label_note') }}</label>
                                                <textarea name="note" class="form-control" rows="4"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ $staffInfo->note }}</textarea>
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
                                                        <input type="file" name="filenames[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"
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
                                                @foreach ($attachments as $item)
                                                <div class="col-md-12">
                                                    <span class="btn-link">{{$item->name}}</span>
                                                    <a href="{{ url('attachments/download',$item->name)}}" class="btn btn-sm btn-outline-primary ml-2 mt-2"><i class="fas fa-download"></i></a>
                                                </div>
                                                @endforeach
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
            $('#btn-save').toggle();
            $("#target :input").prop("disabled", true);

            $("#btn-edit").click(function() {
                $('#btn-save').toggle();
                $('#btn-edit').toggle();
                $("#target :input").prop("disabled", false);
            });

            $("#btn-save").click(function() {
                $('#btn-edit').toggle();
                $('#btn-save').toggle();
                $("#target").submit();
                $("#target :input").prop("disabled", true);
                
            });

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
