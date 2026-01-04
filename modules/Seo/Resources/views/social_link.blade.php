@extends('backend.layouts.app')
@section('title', localize('social_link'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('social_link') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table_customize">

                <form id="projectDetailsNonModalForm" action="{{ route('seo.social_link_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row ps-4 pe-4">

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="fb"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('facebook')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="fb" name="fb"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('fb', $existing_social_link->fb->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="fb_followers" id="fb_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('fb_followers', $existing_social_link->fb->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('fb'))
                                        <div class="error text-danger m-2">{{ $errors->first('fb') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="tw"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('twitter')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="tw" name="tw"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('tw', $existing_social_link->tw->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="tw_followers" id="tw_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('tw_followers', $existing_social_link->tw->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('tw'))
                                        <div class="error text-danger m-2">{{ $errors->first('tw') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="instagram" class="col-form-label col-12 col-md-3 col-xl-3 fw-semibold">
                                    {{ ucwords(localize('instagram')) }}
                                </label>

                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="instagram" name="instagram"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('instagram', $existing_social_link->instagram->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="instagram_followers" id="instagram_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('instagram_followers', $existing_social_link->instagram->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('instagram'))
                                        <div class="error text-danger m-2">{{ $errors->first('instagram') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="linkd"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('linkedin')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="linkd" name="linkd"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('linkd', $existing_social_link->linkd->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="linkd_followers" id="linkd_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('linkd_followers', $existing_social_link->linkd->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('linkd'))
                                        <div class="error text-danger m-2">{{ $errors->first('linkd') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="pin"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('pinterest')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="pin" name="pin"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('pin', $existing_social_link->pin->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="pin_followers" id="pin_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('pin_followers', $existing_social_link->pin->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('pin'))
                                        <div class="error text-danger m-2">{{ $errors->first('pin') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="youtube"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('youtube')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="youtube" name="youtube"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('youtube', $existing_social_link->youtube->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="youtube_followers" id="youtube_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('youtube_followers', $existing_social_link->youtube->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('youtube'))
                                        <div class="error text-danger m-2">{{ $errors->first('youtube') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="vimo"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('vimeo')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="vimo" name="vimo"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('vimo', $existing_social_link->vimo->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="vimo_followers" id="vimo_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('vimo_followers', $existing_social_link->vimo->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('vimo'))
                                        <div class="error text-danger m-2">{{ $errors->first('vimo') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="flickr"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('flickr')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="flickr" name="flickr"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('flickr', $existing_social_link->flickr->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="flickr_followers" id="flickr_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('flickr_followers', $existing_social_link->flickr->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('flickr'))
                                        <div class="error text-danger m-2">{{ $errors->first('flickr') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="vk"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('vk')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="vk" name="vk"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('vk', $existing_social_link->vk->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="vk_followers" id="vk_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('vk_followers', $existing_social_link->vk->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('vk'))
                                        <div class="error text-danger m-2">{{ $errors->first('vk') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="whats_app"
                                    class="col-form-label col-sm-3 col-md-12 col-xl-3 fw-semibold">{{ ucwords(localize('whats_app')) }}</label>
                                
                                <div class="col-12 col-md-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-8 col-md-9">
                                            <input type="text" class="form-control" id="whats_app" name="whats_app"
                                            placeholder="{{ ucwords(localize('facebook')) }}" value="{{ old('whats_app', $existing_social_link->whats_app->link ?? '') }}">
                                        </div>

                                        <div class="col-4 col-md-3">
                                            <input type="number" class="form-control" name="whats_app_followers" id="whats_app_followers" step="1" min="0" placeholder="{{ ucwords(localize('followers')) }}" value="{{ old('whats_app_followers', $existing_social_link->whats_app->followers ?? 0) }}">
                                        </div>
                                    </div>

                                    @if ($errors->has('whats_app'))
                                        <div class="error text-danger m-2">{{ $errors->first('whats_app') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="card-footer form-footer text-start">
                            <button type="submit" class="btn btn-success me-2"></i>{{ localize('update') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection
