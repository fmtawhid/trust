@extends('backend.layouts.app')
@section('title', localize_uc('add_new_video_post'))
@push('css')
    <link href="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.css') }}" rel="stylesheet">
@endpush

@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize_uc('add_new_video_post') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                <form action="{{ route('videonews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row ps-4 pe-4">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="language_id" class="col-form-label fw-semibold">
                                                {{ localize_uc('language') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            
                                            <select name="language_id" id="language_id" class="form-control select-basic-single"
                                                data-allow-clear="true" data-placeholder="{{ localize_uc('select_language') }}" required>
                                                <option value=""></option>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}">
                                                        {{ $language->langname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            @if ($errors->has('language_id'))
                                                <div class="error text-danger m-2">{{ $errors->first('language_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="reporter_id" class="col-form-label fw-semibold">
                                                {{ localize_uc('reporter') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            
                                            <select name="reporter_id" id="reporter_id" class="form-control select-basic-single" 
                                                data-allow-clear="true" data-placeholder="{{ localize_uc('select_reporter') }}">
                                                <option value=""></option>
                                                @foreach ($reporters as $reporter)
                                                    <option value="{{ $reporter->id }}" @selected(old('reporter_id', $auth_user->user_type_id ?? null) == $reporter->id)>
                                                        {{ $reporter->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('reporter_id'))
                                                <div class="error text-danger m-2">{{ $errors->first('reporter_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="publish_date" class="col-form-label fw-semibold">{{ localize_uc('release_date') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="publish_date" id="publish_date" value="{{ date('Y-m-d') }}"
                                                class="form-control date_picker @error('publish_date') is-invalid @enderror" autocomplete="off" required>
                                            
                                            @if ($errors->has('publish_date'))
                                                <div class="error text-danger m-2">{{ $errors->first('publish_date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="title" class="col-form-label fw-semibold">
                                                {{ localize_uc('head_line') }} 
                                                <span class="text-danger">*</span> 
                                            </label>
                                        
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ localize_uc('enter_head_line') }}"
                                                value="{{ old('title') }}" required>
                                            
                                            @if ($errors->has('title'))
                                                <div class="error text-danger m-2">{{ $errors->first('title') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12 mt-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="details" class="col-form-label fw-semibold">{{ localize_uc('details') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="details" id="details" class="form-control"
                                                placeholder="{{ localize_uc('enter_details') }}" rows ="10" cols="80" required>{{ old('details') }}</textarea>
                                            
                                            @if ($errors->has('details'))
                                                <div class="error text-danger m-2">{{ $errors->first('details') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12 mt-2">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="row form-group">  
                                        <div class="col-md-12">
                                            <label for="image" class="col-form-label fw-semibold">
                                                {{ localize('image') }}
                                            </label>

                                            <input type="file" class="form-control" id="image" name="image"
                                                aria-describedby="imageNote" accept="image/*" autocomplete="off">
                                
                                            <small id="fileHelp" class="text-muted mt-2">
                                                <img src="{{ asset('backend/assets/dist/img/signature_signature.jpg') }}" 
                                                    id="output" class="img-thumbnail mt-2" style="width: 100% !important; height: 280px !important;">
                                            </small>
                                        </div>
                                        
                                        <div class="row mt-2 pe-0">
                                            <div class="col-md-6">
                                                <label for="image_alt" class="col-form-label fw-semibold">
                                                    {{ localize_uc('image_alt') }} 
                                                </label>
                                            
                                                <input type="text" name="image_alt" id="image_alt"
                                                    class="form-control"
                                                    placeholder="{{ localize_uc('image_alt') }}"
                                                    value="{{ old('image_alt') }}">
                                                
                                                @if ($errors->has('image_alt'))
                                                    <div class="error text-danger m-2">{{ $errors->first('image_alt') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 pe-0">
                                                <label for="image_title" class="col-form-label fw-semibold">
                                                    {{ localize_uc('image_title') }} 
                                                </label>
                                            
                                                <input type="text" name="image_title" id="image_title"
                                                    class="form-control"
                                                    placeholder="{{ localize_uc('image_title') }}"
                                                    value="{{ old('image_title') }}">
                                                
                                                @if ($errors->has('image_title'))
                                                    <div class="error text-danger m-2">{{ $errors->first('image_title') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="video" class="col-form-label fw-semibold">
                                                {{ localize('video') }}
                                            </label>
                                    
                                            <input type="file" class="form-control" id="video" name="video"
                                                accept="video/*" autocomplete="off">

                                            <small id="videoHelp" class="text-muted mt-2">
                                                <!-- Local video preview -->
                                                <video id="videoPreview" class="mt-2 border rounded" style="width: 100%; height: 280px;" controls poster="{{ asset('backend/assets/dist/img/video_thumb.png') }}">
                                                    <source src="" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            
                                                <!-- External video URL preview (like YouTube) -->
                                                <iframe id="videoIframe" class="mt-2 border rounded d-none" style="width: 100%; height: 280px;" frameborder="0" allowfullscreen></iframe>
                                            </small>
                                        </div>

                                        <div class="row pe-0">
                                            <div class="col-md-12 pe-0">
                                                <label for="video_url" class="col-form-label fw-semibold">
                                                    {{ localize_uc('or_video_url') }} 
                                                </label>
                                            
                                                <input type="text" name="video_url" id="video_url"
                                                    class="form-control"
                                                    placeholder="https://www.youtube.com/watch?v=FZDImEiPgMk"
                                                    value="{{ old('video_url') }}">

                                                @if ($errors->has('video_url'))
                                                    <div class="error text-danger m-2">{{ $errors->first('video_url') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                        
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12 mt-2">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="custom_url"
                                                class="col-form-label fw-semibold">{{ localize_uc('custom_url') }}</label>
                                            <input type="text" id="custom_url" name="custom_url"
                                                class="form-control @error('custom_url') is-invalid @enderror"
                                                placeholder="{{ localize_lower('example') }}-{{ localize_lower('url') }}"
                                                value="{{ old('custom_url') }}">
                                            <span class="text-danger">{{ localize('special_character') }} (e.g .,@$)
                                                {{ localize_lower('not_allowed_in_this_field') }}</span>
                                            <div class="invalid-feedback error text-danger m-2">
                                                @error('custom_url')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="reference" class="col-form-label fw-semibold">{{ localize_uc('reference') }}</label>
                                            
                                            <input type="text" name="reference" id="reference"
                                                class="form-control @error('reference') is-invalid @enderror"
                                                placeholder="{{ localize_uc('enter_reference') }}"
                                                value="{{ old('reference') }}">

                                            @if ($errors->has('reference'))
                                                <div class="error text-danger m-2">{{ $errors->first('reference') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="meta_keyword" class="col-form-label fw-semibold">
                                                {{ localize_uc('meta_keyword') }} 
                                            </label>

                                            <input type="text" id="tags" name="meta_keyword" class="form-control" data-role="tagsinput" placeholder="{{ localize_uc('keyword1') }},{{ localize_uc('keyword2') }}">
                                            
                                            @if ($errors->has('meta_keyword'))
                                                <div class="error text-danger m-2">{{ $errors->first('meta_keyword') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="meta_description" class="col-form-label fw-semibold">
                                                {{ localize_uc('meta_description') }} 
                                            </label>

                                            <textarea name="meta_description" id="meta_description"
                                                class="form-control"
                                                placeholder="{{ localize_uc('meta_description') }}" rows ="2">{{ old('meta_description') }}</textarea>

                                            @if ($errors->has('meta_description'))
                                                <div class="error text-danger m-2">{{ $errors->first('meta_description') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row row ps-4 pe-4">
                        <div class="col-md-12 mt-3 text-start">
                            <button type="submit" class="btn btn-success">
                                {{ localize('save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <input type="hidden" id="image_up" value="{{ route('page.ckeditor_upload', ['_token' => csrf_token()]) }}">

@endsection

@push('js')
    <script src="{{ module_asset('VideoNews/js/videonews.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.js') }}"></script>
@endpush
