@extends('setting::settings')
@section('title', localize('google_recaptcha_v3'))
@push('css')
@endpush
@section('setting_content')

    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('google_recaptcha_v3') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                <form action="{{ route('google.recaptcha.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="site_key" class="col-form-label">{{ localize('site_key') }}</label>
                        <input type="text" class="form-control" id="site_key" name="site_key"
                            value="{{ old('site_key', $recaptchaInfo->site_key ?? '') }}" placeholder="6LeB3KUrAAAAAMXtQaFCCixKll......">
                    </div>

                    <div class="mb-3">
                        <label for="secret_key" class="col-form-label">{{ localize('secret_key') }}</label>
                        <input type="text" class="form-control" id="secret_key" name="secret_key"
                            value="{{ old('secret_key', $recaptchaInfo->secret_key ?? '') }}" placeholder="6LeB3KUrAAAAALf4K1c4HsjI.......">
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
