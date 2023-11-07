@extends('layouts.master')

@section('title-page', __('app.product'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.product') }}</h3>
                    <div class="card-tools">
                        @can('Product')
                        <a href="{{ url('/productes')                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('productes') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-2 container">
                                        <img id="blah" src="{{ asset('images/product_image.png') }}" width="150px"​
                                            height="150px" class="rounded-circle img-bordered" alt=""
                                            srcset="">
                                        <input type="file" name="photo" id="imgInp" accept="image/*"
                                            class="btn btn-sm btn-file mt-2 imgInp" style="display: none">
                                        @if ($errors->has('photo'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('photo') }}</div>
                                        @endif
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary mt-2 blah">{{ __('app.btn_browser') }}</button>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.product_category') }} <small
                                                        class="text-red">*</small></label>
                                                <select class="form-control select2" name="product_category"
                                                    style="width: 100%;">
                                                    <option value="">{{ __('app.table_choose') }}</option>
                                                    @foreach ($product_category as $item)
                                                        <option value="{{ $item->id }}" {{ old('product_category') == $item->id ? "selected" : "" }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('product_category'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('product_category') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.code') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="code" class="form-control"
                                                    value="{{ old('code') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.code') }}">
                                                @if ($errors->has('code'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_color_code') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="color_code" class="form-control"
                                                    value="{{ old('color_code') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_color_code') }}">
                                                @if ($errors->has('code'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('color_code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{ __('app.label_name') }}<small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                                @if ($errors->has('name'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_scale') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="text" name="scale" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_scale') }}"
                                                    value="{{ old('scale') }}" />
                                                @if ($errors->has('scale'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('scale') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_buying_price') }} <small
                                                        class="text-red">*</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="number" name="buying_price" class="form-control"
                                                    value="{{ old('buying_price') }}"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_buying_price') }}">
                                                        </div>
                                                
                                                @if ($errors->has('buying_price'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('buying_price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_salling_price') }} <small
                                                        class="text-red">*</small></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" name="salling_price" step="any"
                                                        class="form-control"
                                                        placeholder="{{ __('app.label_required') }}{{ __('app.label_salling_price') }}"
                                                        value="{{ old('salling_price') }}" />
                                                </div>

                                                @if ($errors->has('salling_price'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('salling_price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_buying_date') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="date" name="buying_date" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.buying_date') }}"
                                                    value="{{ old('buying_date') }}" />
                                                @if ($errors->has('buying_date'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('buying_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_qty_store_stock') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="number" name="store_stock" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_qty_store_stock') }}"
                                                    value="{{ old('store_stock') }}" />
                                                @if ($errors->has('store_stock'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('store_stock') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_qty_warehouse') }} <small
                                                        class="text-red">*</small></label>
                                                <input type="number" name="warehouse" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_qty_warehouse') }}"
                                                    value="{{ old('warehouse') }}" />
                                                @if ($errors->has('warehouse'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('warehouse') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.label_description') }}</label>
                                                <textarea rows="3" name="description" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_description') }}">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{ __('app.label_note') }}</label>
                                                <textarea rows="3" name="note" class="form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">{{ old('note') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card p-3">
                                                <p>{{ __('app.table_photo') }} <button
                                                        class="btn btn-sm btn-outline-primary btn-add-file"
                                                        type="button"><i class="fldemo fas fa-plus"></i>
                                                        {{ __('app.table_choose') }}{{ __('app.table_photo') }}</button>
                                                </p>
                                                <div class="input-group hdtuto control-group lst increment">
                                                    <div class="input-group-btn">
                                                        <input type="file" name="filenames[]" accept="image/*"
                                                            class="myfrm form-control form-control-sm form-no-border">
                                                    </div>
                                                </div>
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames[]" accept="image/*"
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

                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('app.btn_save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
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
