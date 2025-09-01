@extends('backend.layouts.app')
@section('title', localize('breaking_post'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('breaking_post') }}</h6>
                </div>
                <div class="float-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('news.breaking-news.store') }}" class="needs-validation @cannot('create_breaking_news') d-none @endcan" data="showCallBackCreateData"
                id="breakingNewsForm" novalidate="" method="POST" enctype="multipart/form-data" data-create_breaking_news="@cannot('create_breaking_news') d-none @endcan">
                @csrf
                
                <div class="row fw-bold text-capitalize mt-3">
                    
                    <div class="col-12">
                        <label>{{ localize('language') }} <span class="text-danger">*</span></label>
                        
                        <select name="language_id" id="language_id" class="form-control select-basic-single @error('language_id') is-invalid @enderror" required>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">
                                    {{ $language->langname }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="invalid-feedback error text-danger m-2">
                            @error('language_id')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <label>{{ localize('your_post') }}: <span class="text-danger">*</span></label>
                        <textarea name="breaking_news" id="breaking_news" class="form-control @error('breaking_news') is-invalid @enderror"
                            placeholder="{{ localize_uc('enter_your_post') }}" rows ="3" required></textarea>
                        <div class="invalid-feedback error text-danger m-2">
                            @error('breaking_news')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="align-self-end mt-3">
                        <button type="reset" class="btn btn-danger" title="{{ localize('reset') }}">
                            <i class="fa fa-undo-alt"></i>
                        </button>
                        <button type="submit" class="btn btn-success" id="submitButton">
                            {{ localize('save') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="table_customize mt-3">
                {{ $dataTable->table() }}
            </div>
        </div>
    @endsection
    @push('js')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script src="{{ module_asset('News/js/news/breaking-news.js') }}"></script>
    @endpush
