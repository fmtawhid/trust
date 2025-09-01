@extends('theme::layouts.master')
@section('content')
    <div class="row justify-content-start">
        @foreach ($themes as $theme)
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
                <div class="layout-item">
                    <form action="{{ route('themes.updateActive') }}" method="POST">
                        @csrf
                        <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                        <button type="submit" class="btn btn-block btn-theme {{ $theme->is_active ? 'active' : '' }}">
                            <div class="image theme-img">
                                <img src="{{ asset($theme->image_path) }}" alt="{{ $theme->name }}" class="img-responsive">
                            </div>
                            <p class="theme-text">{{ $theme->name }}</p>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('outbox_content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('theme_setting') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('themes.updateColors') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label for="themeBackgroundColor"
                            class="form-label">{{ localize('header_background_color') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control color-value" id="themeBackgroundColorCode"
                                name="background_color" value="{{ $activeTheme->background_color }}" readonly>
                            <input type="color" class="form-control form-control-color color-picker"
                                id="themeBackgroundColor" value="{{ $activeTheme->background_color }}"
                                title="{{ localize('choose_your_background_color') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="themeFooterBgColorCode"
                            class="form-label">{{ localize('footer_background_color') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control color-value" id="themeFooterBgColorCode"
                                name="footer_color" value="{{ $activeTheme->footer_color }}" readonly>
                            <input type="color" class="form-control form-control-color color-picker"
                                id="themeFooterBgColor" value="{{ $activeTheme->footer_color }}"
                                title="{{ localize('choose_your_footer_color') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label"></label>
                        <div class="input-group">
                            <a class="text-decoration-underline text-success"
                                href="{{ route('applications.application') }}">
                                {{ localize('Click here to change the footer background
                                                                                                                                                                                                image') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label for="themeTextColor" class="form-label">{{ localize('header_font_color') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control color-value" id="themeTextColorCode" name="text_color"
                                value="{{ $activeTheme->text_color }}" readonly>
                            <input type="color" class="form-control form-control-color color-picker" id="themeTextColor"
                                value="{{ $activeTheme->text_color }}" title="{{ localize('choose_your_font_color') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label"></label>
                        <div class="input-group">
                            <a class="text-decoration-underline text-success"
                                href="{{ route('admin.font.site.setup.index') }}">
                                {{ localize('Font Settings') }}</a>
                        </div>
                    </div>
                </div>
                @can('update_theme')
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ localize('Save Changes') }}</button>
                            <button type="button" class="btn btn-danger" id="resetThemeSettings" @disabled($activeTheme->is_default)>
                                {{ localize('reset_to_default') }}
                            </button>
                        </div>
                    </div>
                @endcan
            </form>
        </div>
    </div>
@endsection
