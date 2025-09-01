@extends('backend.layouts.app')
@section('title', localize('auto_posting_social_media'))
@push('css')
    
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('auto_posting_social_media') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                
                <form method="POST" action="{{ route('autopost.update') }}">
                    @csrf
                    <div class="row">
                        <!-- Facebook Card -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white fw-medium fs-16">
                                    {{ localize('facebook_settings') }}
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3 d-flex align-items-center">
                                        <input class="form-check-input auto-post-checkbox" type="checkbox" name="facebook[is_active]" id="fb_active" {{ old('facebook.is_active', $facebook->is_active ?? false) ? 'checked' : '' }} value="1">
                                        <label class="form-check-label text-capitalize ms-2" for="fb_active">{{ localize('enable_auto_posting') }}</label>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('page_id') }}</label>
                                        <input type="text" name="facebook[page_id]" class="form-control" value="{{ old('facebook.page_id', $facebook->page_id ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('access_token') }}</label>
                                        <textarea name="facebook[access_token]" class="form-control" rows="4">{{ old('facebook.access_token', $facebook->access_token ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Twitter Card -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-info text-white fw-medium fs-16">
                                    {{ localize('twitter_settings') }}
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3 d-flex align-items-center">
                                        <input class="form-check-input auto-post-checkbox" type="checkbox" name="twitter[is_active]" id="tw_active" {{ old('twitter.is_active', $twitter->is_active ?? false) ? 'checked' : '' }} value="1">
                                        <label class="form-check-label text-capitalize ms-2" for="tw_active">{{ localize('enable_auto_posting') }}</label>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('usage_type') }}</label>
                                        <select name="twitter[is_test_mode]" class="form-control select-basic-single">
                                            <option value="1" {{ old('twitter.is_test_mode', $twitter->is_test_mode ?? 1) == 1 ? 'selected' : '' }}>
                                                {{ localize('free') }}
                                            </option>
                                            <option value="0" {{ old('twitter.is_test_mode', $twitter->is_test_mode ?? 1) == 0 ? 'selected' : '' }}>
                                                {{ localize('paid') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('api_key') }}</label>
                                        <input type="text" name="twitter[api_key]" class="form-control" value="{{ old('twitter.api_key', $twitter->api_key ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('api_secret') }}</label>
                                        <input type="text" name="twitter[api_secret]" class="form-control" value="{{ old('twitter.api_secret', $twitter->api_secret ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('access_token') }}</label>
                                        <input type="text" name="twitter[access_token]" class="form-control" value="{{ old('twitter.access_token', $twitter->access_token ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label text-capitalize">{{ localize('access_token_secret') }}</label>
                                        <input type="text" name="twitter[access_token_secret]" class="form-control" value="{{ old('twitter.access_token_secret', $twitter->access_token_secret ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @if (auth()->user()->can('update_auto_post_settings'))
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save me-1"></i>
                            {{ localize('save_settings') }}
                        </button>
                    @endif
                    
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush
