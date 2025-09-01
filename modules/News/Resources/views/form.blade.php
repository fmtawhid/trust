<input type="hidden" value="0" name="confirm_dynamic_static" id="confirm_dynamic_static">
<input type="hidden" class="form-control datepicker1" name="ref_date" id="ref_date" value="<?php echo date('Y-m-d', time() + 6 * 60 * 60); ?>">

<div class="row ps-4 pe-4">
    <div class="col-12 mt-3">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <label for="language_id" class="col-form-label fw-semibold">
                        {{ localize_uc('language') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="language_id" id="language_id" class="form-control select-basic-single"
                        data-allow-clear="true" data-placeholder="{{ localize_uc('select_language') }}" required>
                        <option value=""></option>
                        @foreach ($languages as $language)
                        <option value="{{ $language->id }}" @selected(old('language_id', $newsMst->language_id ?? null) == $language->id)>
                            {{ $language->langname }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error text-danger m-2 d-block">
                        @error('language_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <label for="other_page" class="col-form-label fw-semibold">{{ localize_uc('category') }} <span
                            class="text-danger">*</span> </label>
                    <select name="other_page" id="other_page" class="form-control select-basic-single"
                        data-placeholder="{{ localize_uc('select_category') }}" required>
                        <option value=""></option>
                        @if (isset($categories))
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('other_page', $newsMst->category_id ?? null) == $category->id)>
                            {{ $category->category_name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <div class="invalid-feedback error text-danger m-2 d-block">
                        @error('other_page')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <label for="sub_category_id"
                        class="col-form-label fw-semibold">{{ localize_uc('sub_category') }}</label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control select-basic-single"
                        data-placeholder="{{ localize_uc('select_sub_category') }}">
                        <option value=""></option>
                        @if (isset($subCategories))
                        @foreach ($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}" @selected(old('sub_category_id', $newsMst->sub_category_id ?? null) == $subCategory->id)>
                            {{ $subCategory->category_name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <div class="invalid-feedback error text-danger m-2 d-block">
                        @error('sub_category_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <label for="other_position"
                        class="col-form-label fw-semibold">{{ localize_uc('category_position') }}</label>
                    <select name="other_position" id="other_position" class="form-control select-basic-single"
                        data-allow-clear="true" data-placeholder="{{ localize_uc('select_other_position') }}">
                        <option value=""></option>
                        @foreach ($categoryPositions as $categoryPosition)
                        <option value="{{ $categoryPosition }}" @selected(old('other_position', $newsMst->otherNewsPosition->position ?? null) == $categoryPosition)>
                            {{ $categoryPosition }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error text-danger m-2 d-block">
                        @error('other_position')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <label for="home_page"
                        class="col-form-label fw-semibold">{{ localize_uc('home_position') }}</label>
                    <select name="home_page" id="home_page" class="form-control select-basic-single"
                        data-allow-clear="true" data-placeholder="{{ localize_uc('select_home_page') }}">
                        <option value=""></option>
                        @foreach ($homeSliderPositions as $homeSliderPosition)
                        <option value="{{ $homeSliderPosition }}" @selected(old('home_page', $newsMst->homeNewsPosition->position ?? null) == $homeSliderPosition)>
                            {{ $homeSliderPosition }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error text-danger m-2 d-block">
                        @error('home_page')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="publish_date" class="col-form-label fw-semibold">{{ localize_uc('release_date') }}
                            <span class="text-danger">*</span></label>
                        <input type="text" name="publish_date" id="publish_date"
                            class="form-control date_picker_val @error('publish_date') is-invalid @enderror"
                            value="{{ old('publish_date', !empty($newsMst) && $newsMst->publish_date ? $newsMst->publish_date->format('Y-m-d') : null) }}"
                            autocomplete="off" required>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('publish_date')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="short_head" class="col-form-label fw-semibold">{{ localize_uc('short_head') }}
                        </label>
                        <input type="text" name="short_head" id="short_head"
                            class="form-control @error('short_head') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_short_head') }}"
                            value="{{ old('short_head', $newsMst->stitle ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('short_head')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="head_line" class="col-form-label fw-semibold">{{ localize_uc('head_line') }}
                            <span class="text-danger">*</span> </label>
                        <input type="text" name="head_line" id="head_line"
                            class="form-control @error('head_line') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_head_line') }}"
                            value="{{ old('head_line', $newsMst->title ?? null) }}" required>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('head_line')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="details_news" class="col-form-label fw-semibold m-0">
                                {{ localize_uc('details') }} <span class="text-danger">*</span>
                            </label>

                            <button type="button" class="ai_btn btn btn-sm btn-primary"
                                data-bs-toggle="modal" data-bs-target="#aiWriterModal">
                                ✨ {{ localize_uc('AI Writer') }} 
                            </button>
                        </div>

                        <textarea name="details_news" id="details_news" class="form-control"
                            placeholder="{{ localize_uc('enter_details_news') }}"
                            rows="10" cols="80" required>{{ old('details_news', $newsMst->news ?? null) }}</textarea>

                        <div class="invalid-feedback error text-danger m-2">
                            @error('details_news')
                            {{ $message }}
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 col-md-4">
                <div class="form-group">
                    <label class="font-weight-600">{{ localize('image') }}</label>
                    <div class="btn-select-image">
                        <div id="photo-library-preview">
                            @if (isset($newsMst) && $newsMst->photoLibrary)
                            <img class="img-responsive img-thumbnail"
                                src="{{ $newsMst->photoLibrary->image_base_url ?? null }}"
                                alt="{{ $newsMst->photoLibrary->title }}" height="100" width="100" />
                            @endif
                        </div>
                        <input type="hidden" name="lib_file_selected" id="photo_library_name"
                            value="{{ $newsMst->image ?? null }}">
                        <a href="{{ route('photo-library.view') }}" class="photo-library-page text-success">
                            <i class="fa fa-cloud-upload-alt"></i> [image]
                        </a>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('lib_file_selected')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="image_alt"
                            class="col-form-label fw-semibold">{{ localize_uc('image_alt') }}</label>
                        <input type="text" id="image_alt" name="image_alt"
                            class="form-control @error('image_alt') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_image_alt') }}"
                            value="{{ old('image_alt', $newsMst->image_alt ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('image_alt')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="image_title"
                            class="col-form-label fw-semibold">{{ localize_uc('image_title') }}</label>
                        <input type="text" id="image_title" name="image_title"
                            class="form-control @error('image_title') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_image_title') }}"
                            value="{{ old('image_title', $newsMst->image_title ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('image_title')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="custom_url"
                            class="col-form-label fw-semibold">{{ localize_uc('custom_url') }}</label>
                        <input type="text" id="custom_url" name="custom_url"
                            class="form-control @error('custom_url') is-invalid @enderror"
                            placeholder="{{ localize_lower('example') }}-{{ localize_lower('url') }}"
                            value="{{ old('custom_url', $newsMst->encode_title ?? null) }}">
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

            <div class="col-lg-4 col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="seo_title"
                            class="col-form-label fw-semibold">{{ localize_uc('seo_title') }}</label>
                        <input type="text" id="seo_title" name="seo_title"
                            class="form-control @error('seo_title') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_seo_title') }}"
                            value="{{ old('seo_title', $newsMst->seo_title ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('seo_title')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                @if ($auth_user->user_type_id == 1)
                <div class="form-group">
                    <label class="col-form-label fw-semibold" for="reporter_id">{{ localize_uc('reporter') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <select name="reporter_id" id="reporter_id" class="select-basic-single form-control"
                            data-placeholder="{{ localize_uc('select_reporter') }}" data-allow-clear="true"
                            required>
                            <option value=""></option>
                            @foreach ($reporters as $reporter)
                            <option value="{{ $reporter->id }}" @selected(old('reporter_id', $newsMst->reporter_id ?? null) == $reporter->id)>
                                {{ $reporter->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback error text-danger m-2 d-block">
                            @error('reporter_id')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="input-group-append position-absolute end-0">
                            <button type="button" class="btn btn-primary show-common-modal"
                                data-modal_id="report_modal">
                                <i class="fas fa-plus text-white fs-21"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="reporter_message"
                            class="col-form-label fw-semibold">{{ localize_uc('reporter_message') }}</label>
                        <textarea class="form-control" name="reporter_message" id="reporter_message" rows="2">{{ old('reporter_message', $newsMst->reporter_message ?? null) }}</textarea>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('videos')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="videos"
                            class="col-form-label fw-semibold">{{ localize_uc('video_url') }}</label>
                        <input type="text" id="videos" name="videos"
                            class="form-control @error('videos') is-invalid @enderror"
                            placeholder="https://www.youtube.com/watch?v=FZDImEiPgMk"
                            value="{{ old('videos', $newsMst->videos ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('videos')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="reference"
                            class="col-form-label fw-semibold">{{ localize_uc('reference') }}</label>
                        <input type="text" id="reference" name="reference"
                            class="form-control @error('reference') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_reference') }}"
                            value="{{ old('reference', $newsMst->reference ?? null) }}">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('reference')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="post_tag" class="col-form-label fw-semibold">{{ localize('post_tag') }}</label>
                        <input type="text" id="post_tag" name="post_tag"
                            class="form-control @error('post_tag') is-invalid @enderror"
                            value="{{ old('reference', isset($newsMst) && $newsMst->postTags ? implode(',', $newsMst->postTags->pluck('tag')->toArray()) : null) }}"
                            placeholder="{{ localize_uc('tag1') }},{{ localize_uc('tag2') }}" data-role="tagsinput">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('post_tag')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="meta_keyword"
                            class="col-form-label fw-semibold">{{ localize('meta_keyword') }}</label>
                        <input type="text" id="meta_keyword" name="meta_keyword"
                            class="form-control @error('reference') is-invalid @enderror"
                            value="{{ old('reference', $newsMst->postSeoOnpage->meta_keyword ?? null) }}"
                            placeholder="{{ localize_uc('keyword1') }},{{ localize_uc('keyword2') }}"
                            data-role="tagsinput">
                        <div class="invalid-feedback error text-danger m-2">
                            @error('reference')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <label for="meta_description"
                            class="col-form-label fw-semibold">{{ localize_uc('meta_description') }}</label>
                        <textarea name="meta_description" id="meta_description"
                            class="form-control @error('meta_description') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_meta_description') }}" rows="3">{{ old('reference', $newsMst->postSeoOnpage->meta_description ?? null) }}</textarea>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('meta_description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="latest_confirmed" id="latest_confirmed" value="1"
                            @checked(old('latest_confirmed', $newsMst->is_latest ?? 1) == 1)>
                        <label for="latest_confirmed">{{ localize('latest_post') }}</label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="breaking_confirmed" id="breaking_confirmed" value="1"
                            @checked(old('breaking_confirmed', isset($newsMst->breakingNews) ? $newsMst->breakingNews->status : null) == 1)>
                        <label for="breaking_confirmed">{{ localize('breaking_post') }}</label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="feature_news" id="feature_news" value="1"
                            @checked(old('feature_news', $newsMst->is_featured ?? 1) == 1)>
                        <label for="feature_news">{{ localize('feature_post') }}</label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="recommanded_news" id="recommanded_news" value="1"
                            @checked(old('recommanded_news', $newsMst->is_recommanded ?? 1) == 1)>
                        <label for="recommanded_news">{{ localize('recommanded_post') }}</label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="status_confirmed" id="status_confirmed" value="1"
                            @checked(old('status_confirmed', 1)==1) />
                        <label for="status_confirmed">{{ localize('status') }}</label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="schemasetup" id="schemasetup" value="1"
                            @checked(old('schemasetup', isset($newsMst) && $newsMst->schemaPost ? 1 : null) == 1) />
                        <label for="schemasetup">
                            {{ localize('schema_setup') }}
                            <span class="text-warning">({{ localize('after_post_publish') }},
                                {{ localize('schema_will_be_editable_from_post_update') }})</span>
                        </label>
                    </div>

                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" name="is_auto_post" id="is_auto_post" value="1"
                            @checked(old('is_auto_post', $newsMst->is_auto_post ?? 1) == 1)>
                        <label for="is_auto_post">{{ localize('auto_social_post') }}</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- AI Writer Modal -->
<div class="modal fade" id="aiWriterModal" tabindex="-1" aria-labelledby="aiWriterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aiWriterModalLabel"> {{ localize('AI Writer') }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="aiConfig"
                data-generate-url="{{ route('admin.ai.generate') }}"
                data-csrf-token="{{ csrf_token() }}">
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="aiCommand" class="form-label fw-bold"> {{ localize('Your Command / Prompt') }} </label>
                    <textarea class="form-control" id="aiCommand" rows="3" placeholder="Write your command for AI..."></textarea>
                </div>

                <button type="button" id="generateTextBtn" class="btn btn-primary mb-3">
                    <i class="fas fa-robot"></i> {{ localize('Generate Text') }}
                </button>

                <div id="aiResponseArea" class="border rounded p-3 bg-light" style="min-height: 150px;">
                    <em class="text-muted"> AI generated content will appear here...</em>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="useTextBtn" class="btn btn-success">
                    <i class="fas fa-check"></i> {{ localize('Use Text') }}
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ localize('close') }}</button>
            </div>
        </div>

    </div>
</div>