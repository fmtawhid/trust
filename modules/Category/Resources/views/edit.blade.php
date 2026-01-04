@method('PUT')
<div class="row ps-4 pe-4">

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="language_id"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('language') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <select name="language_id" id="language_id" class="form-control select-basic-single" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $category->language_id == $language->id ? 'selected' : '' }}>
                            {{ $language->langname }}
                        </option>
                    @endforeach
                </select>

            </div>

            @if ($errors->has('language_id'))
                <div class="error text-danger m-2">{{ $errors->first('language_id') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="category_type"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('select_type') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <select name="category_type" id="category_type" class="form-control select-basic-single" required>
                    <option value="">--{{ localize('select') }}--</option>
                    <option value="1" {{ $category->category_type == 1 ? 'selected' : '' }} >{{ localize('category') }}</option>
                    <option value="2" {{ $category->category_type == 2 ? 'selected' : '' }} >{{ localize('topic') }}</option>
                </select>

            </div>

            @if ($errors->has('category_type'))
                <div class="error text-danger m-2">{{ $errors->first('category_type') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="category_name"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('category_name') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <input type="text" class="form-control" id="category_name" name="category_name"
                    placeholder="{{ localize('category_name') }}" value="{{ old('category_name') ?? $category->category_name }}" required>
            </div>

            @if ($errors->has('category_name'))
                <div class="error text-danger m-2">{{ $errors->first('category_name') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3 {{ $category->category_type == 2 ? 'd-none':''}}" id="parents-id-section">
        <div class="row">
            <label for="parents_id"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('parent_category') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <select name="parents_id" id="parents_id"
                    class="form-control select-basic-single"
                    data-placeholder="{{ localize_uc('select_parent_category') }}">
                    <option value=""></option>
                    @foreach ($parent_categories as $parent_catg)
                        <option value="{{ $parent_catg->id }}"  {{ $parent_catg->id == $category->parents_id ? 'selected' : '' }}>{{ $parent_catg->category_name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($errors->has('parents_id'))
                <div class="error text-danger m-2">{{ $errors->first('parents_id') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        
        @php
            $image = '';
            $image = $category->category_imgae != NULL ? asset('storage/' . $category->category_imgae) : asset('backend/assets/dist/img/signature_signature.jpg');
        @endphp

        <div class="row">
            <label for="category_topic"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('category_topic') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <select name="category_topic[]" id="category_topic" class="form-control select-basic-single" multiple="multiple">
                    @foreach ($categories as $category_show)
                        <option value="{{ $category_show->slug }}" {{ in_array($category_show->slug, $topics) ? 'selected' : '' }}>{{ $category_show->category_name }}
                        </option>
                    @endforeach
                </select>

            </div>

            @if ($errors->has('category_topic'))
                <div class="error text-danger m-2">{{ $errors->first('category_topic') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="slug"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('slug') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">
            
                <input type="text" class="form-control" id="slug" name="slug"
                    placeholder="{{ localize('slug') }}" value="{{ old('slug') ?? $category->slug }}" required>
            </div>

            @if ($errors->has('slug'))
                <div class="error text-danger m-2">{{ $errors->first('slug') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="description"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('description') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <textarea  class="form-control" id="description" name="description"
                    placeholder="{{ localize('description') }}" rows ="5">{{ $category->description }}</textarea>
            </div>

            @if ($errors->has('description'))
                <div class="error text-danger m-2">{{ $errors->first('description') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="meta_keyword" class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">
                {{ localize('meta_keyword') }}
            </label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <input type="text" id="tags" name="meta_keyword" class="form-control" data-role="tagsinput" placeholder="{{ localize_uc('keyword1') }},{{ localize_uc('keyword2') }}" value="{{ $category->meta_keyword }}">
            </div>

            @if ($errors->has('meta_keyword'))
                <div class="error text-danger m-2">{{ $errors->first('meta_keyword') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="meta_description" class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">
                {{ localize('meta_description') }}
            </label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <textarea name="meta_description" id="meta_description" class="form-control"
                    placeholder="{{ localize_uc('meta_description') }}" rows ="2">{{ $category->meta_description }}</textarea>
            </div>

            @if ($errors->has('meta_description'))
                <div class="error text-danger m-2">{{ $errors->first('meta_description') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row align-items-center">
            <label for="color_code" class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">
                {{ localize('color_code') }}
            </label>
            <div class="col-sm-9 col-md-12 col-xl-9 d-flex">
                <input type="text" name="color_code" id="color_code" class="form-control me-2" 
                    placeholder="#000000" 
                    value="{{ old('color_code', $category->color_code ?? '#000000') }}" 
                    oninput="syncColorPicker(this)">
                
                <input type="color" id="color_picker" class="form-control form-control-color" 
                    value="{{ old('color_code', $category->color_code ?? '#000000') }}" 
                    oninput="syncTextInput(this)">
            </div>

            @if ($errors->has('color_code'))
                <div class="error text-danger m-2">{{ $errors->first('color_code') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="category_image"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('category_image') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <input type="file" class="form-control" id="category_image" name="category_image"
                 class="form-control" aria-describedby="categoryNote" accept="image/*" autocomplete="off">

                <small id="categoryNote" class="form-text text-black">N.B: {{ localize('1350*350 & max size 1MB') }}</small>

                <small id="fileHelp" class="text-muted mt-2">
                <img src="{{ $image }}"
                 id="output" class="img-thumbnail mt-2" width="300" style="height: 120px !important;">

            </div>

        </div>
    </div>

</div>

<script src="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.js') }}"></script>