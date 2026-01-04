@method('PUT')
<div class="row ps-4 pe-4">

    <div class="col-md-12">
        <div class="row">
            <label for="language_id" class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">
                {{ localize('language') }}
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <select name="language_id" id="language_id" class="form-control select-basic-single" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $advertise->language_id == $language->id ? 'selected' : '' }}>
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
            <label for="theme" class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">
                {{ localize('theme') }}
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <select name="theme" id="theme"  class="form-control" onchange="loadPagePositions()" required>
                    <option value="">{{localize('select')}}</option>
                    @foreach ($themes as $theme)
                        <option value="{{ $theme->id }}" {{ $theme->id == $advertise->theme ? 'selected' : '' }}>
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($errors->has('theme'))
                <div class="error text-danger m-2">{{ $errors->first('theme') }}</div>
            @endif
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="page"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('page') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <select name="page" id="page" class="form-control" onchange="loadPagePositions(this.value, {{$advertise->page}})" required>
                    <option value="">{{localize('select')}}</option>
                    <option value="1" {{ $advertise->page == 1 ? 'selected' : '' }}>{{makeString(['home_page'])}}</option>
                    <option value="2" {{ $advertise->page == 2 ? 'selected' : '' }}>{{makeString(['category','page'])}}</option>
                    <option value="3" {{ $advertise->page == 3 ? 'selected' : '' }}>{{makeString(['news','details','page'])}}</option>
                </select>

            </div>

            @if ($errors->has('page'))
                <div class="error text-danger m-2">{{ $errors->first('page') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="ad_position"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('ads_position') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <select name="ad_position" class="form-control" id="position" required>
                    <option value="">{{ localize('select') }}</option>
                    @foreach ($positions as $pos)
                        <option value="{{ $pos['id'] }}" {{ $advertise->ad_position == $pos['id'] ? 'selected' : '' }}>
                            {{ $pos['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($errors->has('ad_position'))
                <div class="error text-danger m-2">{{ $errors->first('ad_position') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="ad_type"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('ads_type') }}<span
                    class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <select name="ad_type" id="ad_type" class="form-control" onchange="ad_type_change(this.value)" required>
                    <option value="">{{localize('select')}}</option>
                    <option value="1" {{ $advertise->ad_type == 1 ? 'selected' : '' }}>{{makeString(['script','ads'])}}</option>
                    <option value="2" {{ $advertise->ad_type == 2 ? 'selected' : '' }}>{{makeString(['image','ads'])}}</option>
                </select>

            </div>

            @if ($errors->has('page'))
                <div class="error text-danger m-2">{{ $errors->first('page') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3 img_ad">
        <div class="row">
            <label for="image"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ localize('image') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">

                <input type="file" class="form-control" id="ad_image" name="ad_image"
                 class="form-control" aria-describedby="categoryNote" accept="image/*" autocomplete="off">

                <small id="categoryNote" class="form-text text-black">N.B: jpg,png,jpeg,gif and max size is 1MB</small>

                <small id="fileHelp" class="text-muted mt-2"><img src="{{ asset('backend/assets/dist/img/signature_signature.jpg') }}" 
                id="output" class="img-thumbnail mt-2" width="300" style="height: 120px !important;">

            </div>
        </div>

        <div class="row">
            <label for="ad_url"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold text-black">{{ localize('url') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <input type="text" name="ad_url" class="form-control">
            </div>
        </div> 

    </div>

    <div class="col-md-12 mt-3 embed_code_ad {{ $advertise->ad_type == 1 ? 'd-block' : '' }}">
        <div class="row">
            <label for="embed_code"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold text-black">{{ localize('script_ads_code') }}</label>
            <div class="col-sm-9 col-md-12 col-xl-9">
                <textarea class="form-control" name="embed_code" id="embed_code" rows="5"
                    placeholder='<script async src="https://..."></script>(script + ins + script)'>{{ $advertise->embed_code }}</textarea>
            </div>

            @if ($errors->has('embed_code'))
                <div class="error text-danger m-2">{{ $errors->first('embed_code') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <label for="embed_code"
                class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold text-black">{{ localize('ads_preview') }}</label>
                <div>{!! $advertise->embed_code !!}</div>
        </div>
    </div>

</div>
