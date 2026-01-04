@extends('backend.layouts.app')
@section('title', localize_uc('edit_opinion'))
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
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize_uc('edit_opinion') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_customize">
                <form action="{{ route('opinion.update', $opinion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                            
                                            <select name="language_id" id="language_id" class="form-control select-basic-single" required>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ $opinion->language_id == $language->id ? 'selected' : '' }}>
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
                                            <label for="name" class="col-form-label fw-semibold">
                                                {{ localize_uc('name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="{{ localize('name') }}" value="{{ old('name') ?? $opinion->name }}" required>

                                            @if ($errors->has('name'))
                                                <div class="error text-danger m-2">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="designation" class="col-form-label fw-semibold">
                                                {{ localize_uc('designation') }}
                                            </label>
                                            
                                            <input type="text" class="form-control" id="designation" name="designation"
                                                placeholder="{{ localize('designation') }}" value="{{ old('designation') ?? $opinion->designation }}">

                                            @if ($errors->has('designation'))
                                                <div class="error text-danger m-2">{{ $errors->first('designation') }}</div>
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
                                
                                <div class="col-md-8">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="title" class="col-form-label fw-semibold">
                                                {{ localize_uc('head_line') }} 
                                                <span class="text-danger">*</span> 
                                            </label>
                                        
                                            <input type="text" name="title" id="title"
                                                class="form-control"
                                                placeholder="{{ localize_uc('enter_head_line') }}"
                                                value="{{ old('title') ?? $opinion->title }}" required>
                                            
                                            @if ($errors->has('title'))
                                                <div class="error text-danger m-2">{{ $errors->first('title') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <label for="custom_url" class="col-form-label fw-semibold">
                                                {{ localize_uc('custom_url') }} 
                                            </label>
                                        
                                            <input type="text" name="custom_url" id="custom_url"
                                                class="form-control"
                                                placeholder="{{ localize_uc('custom_url') }}"
                                                value="{{ old('custom_url') ?? $opinion->encode_title }}">
                                            
                                            @if ($errors->has('custom_url'))
                                                <div class="error text-danger m-2">{{ $errors->first('custom_url') }}</div>
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
                                                placeholder="{{ localize_uc('enter_details') }}" rows ="10" cols="80" required>{{ old('details') ?? $opinion->content }}</textarea>
                                            
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
                                            <label for="person_image" class="col-form-label fw-semibold">
                                                {{ localize('person_image') }}
                                            </label>

                                            <input type="file" class="form-control" id="person_image" name="person_image"
                                                aria-describedby="imageNote" accept="image/*" autocomplete="off">
                                
                                            <small id="fileHelp" class="text-muted mt-2">
                                                <img src="{{ $opinion->person_image ? asset('storage/' . $opinion->person_image) : asset('backend/assets/dist/img/nopreview.jpeg') }}" 
                                                    id="output" class="img-thumbnail mt-2" style="width: 100% !important; height: 250px !important;">
                                            </small>
                                            <small id="imageNote" class="form-text text-black">N.B: {{ localize('150*150 and max size 500 KB') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="row form-group">  
                                        <div class="col-md-12">
                                            <label for="news_image" class="col-form-label fw-semibold">
                                                {{ localize('news_image') }}
                                            </label>

                                            <input type="file" class="form-control" id="news_image" name="news_image"
                                                aria-describedby="imageNote" accept="image/*" autocomplete="off">
                                
                                            <small id="fileHelp" class="text-muted mt-2">
                                                <img src="{{ $opinion->news_image ? asset('storage/' . $opinion->news_image) : asset('backend/assets/dist/img/nopreview.jpeg') }}" 
                                                    id="news-output" class="img-thumbnail mt-2" style="width: 100% !important; height: 250px !important;">
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ps-4 pe-4">
                        <div class="col-12 mt-2">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label for="image_alt" class="col-form-label fw-semibold">
                                        {{ localize_uc('image_alt') }} 
                                    </label>
                                
                                    <input type="text" name="image_alt" id="image_alt"
                                        class="form-control"
                                        placeholder="{{ localize_uc('image_alt') }}"
                                        value="{{ old('image_alt') ?? $opinion->image_alt }}">
                                    
                                    @if ($errors->has('image_alt'))
                                        <div class="error text-danger m-2">{{ $errors->first('image_alt') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <label for="image_title" class="col-form-label fw-semibold">
                                        {{ localize_uc('image_title') }} 
                                    </label>
                                
                                    <input type="text" name="image_title" id="image_title"
                                        class="form-control"
                                        placeholder="{{ localize_uc('image_title') }}"
                                        value="{{ old('image_title') ?? $opinion->image_title }}">
                                    
                                    @if ($errors->has('image_title'))
                                        <div class="error text-danger m-2">{{ $errors->first('image_title') }}</div>
                                    @endif
                                </div>

                  
                                <div class="col-md-6">
                                    <label for="meta_keyword" class="col-form-label fw-semibold">
                                        {{ localize_uc('meta_keyword') }} 
                                    </label>

                                    <input type="text" id="tags" name="meta_keyword" class="form-control" data-role="tagsinput" placeholder="{{ localize_uc('keyword1') }},{{ localize_uc('keyword2') }}" value="{{ old('meta_keyword') ?? $opinion->meta_keyword }}">
                                    
                                    @if ($errors->has('meta_keyword'))
                                        <div class="error text-danger m-2">{{ $errors->first('meta_keyword') }}</div>
                                    @endif
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
                                                placeholder="{{ localize_uc('meta_description') }}" rows ="2">{{ old('meta_description') ?? $opinion->meta_description }}</textarea>

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
                                {{ localize('update') }}
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
    <script src="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.js') }}"></script>
    <script src="{{ module_asset('Opinion/js/opinion.js') }}"></script>
@endpush
