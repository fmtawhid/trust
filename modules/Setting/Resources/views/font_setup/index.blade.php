@php
    use App\Enums\FontSetupEnum;
@endphp

@extends('setting::settings')
@section('title', localize('font_setup'))

@section('setting_content')
    <div class="body-content pt-0">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('font_setup') }}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.font.site.setup.store') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label for="font_name" class="form-label">{{ localize('language') }} <i
                                        class="text-danger">*</i></label>
                                <select name="language_id" id="language_id_" class="form-control select-basic-single"
                                    required>
                                    @php
                                        $language_id = session('language_id') ?? 1;
                                    @endphp
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}"
                                            {{ $language_id == $language->id ? 'selected' : '' }}>
                                            {{ $language->langname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label for="principal_font" class="form-label">{{ localize('principal_font') }}
                                    ({{ localize('default') }}) <i class="text-danger">*</i></label>
                                <select class="form-select select-basic-single" id="principal_font" name="principal_font"
                                    required>
                                    <option value="" disabled selected>{{ localize('select_font') }}</option>
                                    @foreach ($fonts as $font)
                                        <option value="{{ $font->id }}" @selected(($fontSetting[FontSetupEnum::PRINCIPAL->value]->font_setting_id ?? null) == $font->id)>
                                            {{ $font->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label for="alternate_font" class="form-label">{{ localize('alternate_font') }}
                                    ({{ localize('Titles') }}) <i class="text-danger">*</i></label>
                                <select class="form-select select-basic-single" id="alternate_font" name="alternate_font"
                                    required>
                                    <option value="" disabled selected>{{ localize('select_font') }}</option>
                                    @foreach ($fonts as $font)
                                        <option value="{{ $font->id }}" @selected(($fontSetting[FontSetupEnum::ALTERNATE->value]->font_setting_id ?? null) == $font->id)>
                                            {{ $font->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label for="supplementary_font" class="form-label">{{ localize('supplementary_font') }}
                                    ({{ localize('Post and Pages') }}) <i class="text-danger">*</i></label>
                                <select class="form-select select-basic-single" id="supplementary_font"
                                    name="supplementary_font" required>
                                    <option value="" disabled selected>{{ localize('select_font') }}</option>
                                    @foreach ($fonts as $font)
                                        <option value="{{ $font->id }}" @selected(($fontSetting[FontSetupEnum::SUPPLEMENTARY->value]->font_setting_id ?? null) == $font->id)>
                                            {{ $font->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <button type="submit" class="btn btn-primary">{{ localize('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
