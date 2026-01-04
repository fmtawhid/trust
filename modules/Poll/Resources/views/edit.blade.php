@method('PUT')
<div class="row ps-4 pe-4">
    <div class="col-md-12">
        <!-- Language -->
        <div class="row">
            <label for="question" class="col-form-label col-12 fw-semibold">
                {{ localize('language') }}
                <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select name="language_id" id="language_id" class="form-control select-basic-single" required>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ $poll->language_id == $language->id ? 'selected' : '' }}>
                            {{ $language->langname }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('language_id'))
                <div class="error text-danger m-2">{{ $errors->first('language_id') }}</div>
            @endif
        </div>

        <!-- Question -->
        <div class="row mt-3">
            <label for="question" class="col-form-label col-12 fw-semibold">
                {{ localize('Question') }}
                <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <textarea class="form-control" id="question" name="question"
                    placeholder="{{ localize('Question') }}" rows="2" required>{{ old('question') ?? $poll->question }}</textarea>
            </div>
            @if ($errors->has('question'))
                <div class="error text-danger m-2">{{ $errors->first('question') }}</div>
            @endif
        </div>

        <!-- Options -->
        <div class="row mt-3">
            <div id="options-wrapper">
                @foreach ($poll->options as $index => $option)
                    <div class="option-item mb-3">
                        <label class="col-form-label fw-semibold">{{ localize('option') }} {{ $numberWords[$index] ?? $index + 1 }} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="options[]" class="form-control" placeholder="{{ localize('option') }} {{ $numberWords[$index] ?? $index + 1 }}" value="{{ old('options.' . $index, $option->name) }}" required>
                            
                            @if ($index > 1)
                                <button class="btn btn-danger remove-option" type="button">&times;</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" id="add-option" class="btn btn-primary btn-sm">
                    {{ localize('add_more_option') }}
                </button>
            </div>
        </div>

        {{-- Vote Permission --}}
        <div class="row mt-3">
            <label for="vote_permission" class="col-form-label col-12 fw-semibold">{{ localize('vote_permission') }} <span class="text-danger">*</span></label>
            <div class="col-12">
                <select name="vote_permission[]" id="vote_permission" class="form-control select-basic-single">
                    <option value="0" {{ $poll->vote_permission == 0 ? 'selected' : '' }}>{{ localize('all_users_can_vote') }}</option>
                    <option value="1" {{ $poll->vote_permission == 1 ? 'selected' : '' }}>{{ localize('only_registered_users_can_vote') }}</option>
                </select>
            </div>

            @if ($errors->has('vote_permission'))
                <div class="error text-danger m-2">{{ $errors->first('vote_permission') }}</div>
            @endif
        </div>

        <!-- Meta Keyword -->
        <div class="row mt-3">
            <label for="meta_keyword" class="col-form-label col-12 fw-semibold">
                {{ localize('meta_keyword') }}
            </label>
            <div class="col-12">
                <input type="text" id="tags" name="meta_keyword" class="form-control" data-role="tagsinput" placeholder="{{ localize_uc('keyword1') }},{{ localize_uc('keyword2') }}" value="{{ $poll->meta_keyword }}">
            </div>
            @if ($errors->has('meta_keyword'))
                <div class="error text-danger m-2">{{ $errors->first('meta_keyword') }}</div>
            @endif
        </div>

        <!-- Meta Description -->
        <div class="row mt-3">
            <label for="meta_description" class="col-form-label col-12 fw-semibold">
                {{ localize('meta_description') }}
            </label>
            <div class="col-12">
                <textarea name="meta_description" id="meta_description" class="form-control"
                    placeholder="{{ localize_uc('meta_description') }}" rows ="2">{{ $poll->meta_description }}</textarea>
            </div>
            @if ($errors->has('meta_description'))
                <div class="error text-danger m-2">{{ $errors->first('meta_description') }}</div>
            @endif
        </div>

    </div>
</div>

<script src="{{ module_asset('Poll/js/poll_option_create.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/Bootstrap-5-Tag-Input/tagsinput.js') }}"></script>