<div class="row">
    <div class="col-md-6">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <label for="language_id" class="col-form-label fw-semibold">
                    {{ localize_uc('language') }} 
                    <span class="text-danger">*</span>
                </label>
                <select name="language_id" id="language_id_" form="editForm" class="form-control select-basic-single" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $storyData->language_id == $language->id ? 'selected' : '' }}>
                            {{ $language->langname }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <label for="story_title_" class="col-form-label fw-semibold">{{ localize_uc('story_title') }} <span
                        class="text-danger">*</span> </label>
                <input type="text" name="story_title_" id="story_title_"
                    class="form-control"
                    placeholder="{{ localize_uc('story_title') }}" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <label for="story_image_" class="col-form-label fw-semibold">{{ localize_uc('story_image') }} (Max 2MB)
                    <span class="text-danger">*</span> </label>
                <input type="file" name="story_image_" id="story_image_" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <label for="button_text_" class="col-form-label fw-semibold">{{ localize_uc('button_text') }}</label>
                <input type="text" name="button_text_" id="button_text_"
                    class="form-control"
                    placeholder="{{ localize_uc('button_text') }}" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <label for="button_link_" class="col-form-label fw-semibold">{{ localize_uc('button_link') }}</label>
                <input type="text" name="button_link_" id="button_link_"
                    class="form-control"
                    placeholder="{{ localize_uc('button_link') }}" required>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row form-group">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <button type="button" class="btn btn-primary float-end mt-3" id="add_story_view_">{{ localize('add_story') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="story_views_table">
                <thead>
                    <tr>
                        <th>{{ localize('image') }}</th>
                        <th>{{ localize('title') }}</th>
                        <th>{{ localize('text') }}</th>
                        <th>{{ localize('link') }}</th>
                        <th>{{ localize('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storyData->details as $story)
                        @php
                            $base64Image = 'data:image/' . pathinfo($story->image_path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents(storage_asset_image($story->image_path)));
                            $rowId = $story->id;
                            $buttonText = $story->button_text;
                            $buttonLink = $story->button_link;
                            $storyTitle = $story->title;
                        @endphp
                        <tr id="row-{{ $rowId }}">
                            <td><img src="{{ $base64Image }}" alt="Story Image" width="50" height="30" /></td>
                            <td>{{ $storyTitle }}</td>
                            <td>{{ $buttonText }}</td>
                            <td>{{ $buttonLink }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm delete-row" data-row-id="{{ $rowId }}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<form action="{{ route('admin.story.update', ['story' => $storyData->id]) }}" id="editForm" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12 mt-5">
            <button type="submit" class="btn btn-success wp-20 float-end">{{ localize('save_change') }}</button>
        </div>
    </div>
</form>