@extends('setting::settings')
@section('title', localize('cookie_content'))
@push('css')
@endpush
@section('setting_content')

    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('cookie_content') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                <form action="{{ route('cookie.content.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="alert_title" class="col-form-label">{{ localize('cookie_alert_title') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alert_title" name="alert_title"
                            value="{{ old('alert_title', $cookieInfo->alert_title ?? '') }}" placeholder="{{ localize('cookie_alert_title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="alert_content" class="col-form-label">{{ localize('cookie_alert_content') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alert_content" name="alert_content" rows="5" placeholder="{{ localize('cookie_alert_content') }}"
                            required>{{ old('alert_content', $cookieInfo->alert_content ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="page_title" class="col-form-label">{{ localize('page_title') }}</label>
                        <input type="text" class="form-control" id="page_title" name="page_title"
                            value="{{ old('page_title', $cookieInfo->page_title ?? '') }}" placeholder="{{ localize('page_title') }}">
                    </div>

                    <div class="mb-3">
                        <label for="page_url" class="col-form-label">{{ localize('page_url') }}</label>
                        <input type="text" class="form-control" id="page_url" name="page_url"
                            value="{{ old('page_url', $cookieInfo->page_url ?? '') }}" placeholder="https://latestnews365.bdtask-demo.com/privacy-policy">
                    </div>

                    <div class="mb-4">
                        <label for="cookie_duration" class="col-form-label">{{ localize('cookie_duration_days') }}</label>
                        <input type="number" class="form-control" id="cookie_duration" name="cookie_duration"
                            value="{{ old('cookie_duration', $cookieInfo->cookie_duration ?? '30') }}"
                            placeholder="{{ localize('cookie_duration_days') }}" min="1" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ localize('save') }}
                    </button>
                </form>
                
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
