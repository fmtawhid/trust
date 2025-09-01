@extends('story::layouts.master')

@section('header_content')
<div class="text-end">
    <div class="actions">
        @can('create_story')
            <a data-bs-toggle="modal" data-bs-target="#story_create" class="btn btn-success btn-sm" >
                <i class="fa fa-plus-circle"></i>&nbsp;{{ localize('new_story') }}
            </a>
        @endcan
    </div>
</div>
@endsection

@section('content')
<div class="table_customize">
    {{ $dataTable->table() }}
</div>
@endsection
@section('outbox_content')

    <!-- Modal -->
    <x-common-modal modalId="story_views" :modalTitle="localize('stories_details')" modalDialog="modal-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="story_views_table">
                        <thead>
                            <tr>
                                <th>{{ localize('image') }}</th>
                                <th>{{ localize('title') }}</th>
                                <th>{{ localize('views') }}</th>
                            </tr>
                        </thead>
                        <tbody id="story-details">
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-common-modal>

    {{-- Create Modal --}}
    <x-common-modal modalId="story_create" :modalTitle="localize('story_create')" modalDialog="modal-xl">
        
            <div class="row">
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <label for="language_id" class="col-form-label fw-semibold">
                                {{ localize_uc('language') }} 
                                <span class="text-danger">*</span>
                            </label>
                            <select name="language_id" id="language_id" form="createForm" class="form-control select-basic-single" required>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">
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
                            <label for="story_title" class="col-form-label fw-semibold">{{ localize_uc('story_title') }} <span
                                    class="text-danger">*</span> </label>
                            <input type="text" name="story_title" id="story_title"
                                class="form-control"
                                placeholder="{{ localize_uc('story_title') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <label for="story_image" class="col-form-label fw-semibold">{{ localize_uc('story_image') }} (Max 2MB)
                                <span class="text-danger">*</span> </label>
                            <input type="file" name="story_image" id="story_image" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <label for="button_text" class="col-form-label fw-semibold">{{ localize_uc('button_text') }}</label>
                            <input type="text" name="button_text" id="button_text"
                                class="form-control"
                                placeholder="{{ localize_uc('button_text') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <label for="button_link" class="col-form-label fw-semibold">{{ localize_uc('button_link') }}</label>
                            <input type="text" name="button_link" id="button_link"
                                class="form-control"
                                placeholder="{{ localize_uc('button_link') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <button type="button" class="btn btn-primary float-end mt-3" id="add_story_view">{{ localize('add_story') }}</button>
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
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.story.store') }}" id="createForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <button type="submit" class="btn btn-success wp-20 float-end">{{ localize('Save') }}</button>
                    </div>
                </div>
            </form>
    </x-common-modal>

    {{-- Update Modal --}}
    <x-common-modal modalId="story_update" :modalTitle="localize('story_update')" modalDialog="modal-xl">
        <div class="story_update_data">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </x-common-modal>

    @push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection