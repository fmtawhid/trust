@extends('setting::settings')
@section('title', localize('font_setting'))

@section('setting_content')
    <div class="body-content pt-0">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('Edit Font Setting') }}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.font.settings.update', $fontSetting->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="font_name" class="form-label">{{ localize('Font Name') }}</label>
                        <input type="text" class="form-control" id="font_name" name="font_name"
                            value="{{ old('font_name', $fontSetting->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="source_url" class="form-label">{{ localize('Source URL') }}</label>
                        <input type="url" class="form-control" id="source_url" name="source_url"
                            value="{{ old('source_url', $fontSetting->source_url) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="font_family" class="form-label">{{ localize('Font Family') }}</label>
                        <input type="text" class="form-control" id="font_family" name="font_family"
                            value="{{ old('font_family', $fontSetting->font_family) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ localize('Update') }}</button>
                    <a href="{{ route('admin.font.settings.index') }}"
                        class="btn btn-secondary">{{ localize('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
