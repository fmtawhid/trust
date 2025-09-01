@extends('backend.layouts.app')
@section('title', localize('home_page_view_setting'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('home_page_view_setting') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table_customize">

                <form id="homePageSettingsFormSave" action="{{ route('view_setup.save_home_page_settings') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row ps-4 pe-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="language_id" class="col-form-label fw-semibold">{{ ucwords(localize('language')) }}<span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select select-basic-single" 
                                    data-allow-clear="true" data-placeholder="{{ localize_uc('select_language') }}" required>
                                    <option value=""></option> 
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->langname }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('language_id'))
                                    <div class="text-danger small mt-1">{{ $errors->first('language_id') }}</div>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <label for="position_no" class="col-form-label fw-semibold">{{ ucwords(localize('position_number')) }}<span class="text-danger">*</span></label>
                                <select name="position_no" id="position_no" class="form-select select-basic-single" required>
                                    <option value="">{{ ucwords(localize('select_position')) }}</option>
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('position_no'))
                                    <div class="text-danger small mt-1">{{ $errors->first('position_no') }}</div>
                                @endif
                            </div>
                        
                            <div class="col-md-4">
                                <label for="category_name" class="col-form-label fw-semibold">{{ ucwords(localize('category_name')) }}<span class="text-danger">*</span></label>
                                <select name="category_name" id="category_name" class="form-select select-basic-single"
                                    data-placeholder="{{ localize_uc('select_category') }}" required>
                                    <option value=""></option>
                                </select>

                                @if ($errors->has('category_name'))
                                    <div class="text-danger small mt-1">{{ $errors->first('category_name') }}</div>
                                @endif
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">{{ ucwords(localize('add_position')) }}</button>
                            </div>
                        </div>
                    </div>
                </form>

                <br><br>

                <form id="homePageSettingsFormUpdate" action="{{ route('view_setup.home_page_setup_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="ps-4 pe-4">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>{{ localize('language') }}</th>
                                <th>{{ localize('position_number') }}</th>
                                <th>{{ localize('category_name') }}</th>
                                <th>{{ localize('status') }}</th>
                            </tr>

                            @foreach ($home_page_settings ?? [] as $value1)
                                @php
                                    $key1 = $loop->iteration;
                                @endphp
                                <tr>
                                    <td>
                                        {{ $value1->language->langname }}
                                        <input type="hidden" name="language_id[]" value="{{ $value1->language_id }}">
                                    </td>
                                    <td>
                                        <input type="hidden" value="{{ $key1}}" name="position_no[]">
                                        {{ $value1->position_no }}
                                    </td>
                                    <td>
                                        <select name="category_id[{{ $key1 }}]" class="form-control select-basic-single" required="1">
                                            <option value="">{{ localize('category_name') }}</option>
                                            @foreach ($categories->where('language_id', $value1->language_id) as $cat)
                                                <option value="{{ $cat->id }}" {{ $cat->id == $value1->category_id ? 'selected' : '' }}>
                                                    {{ $cat->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="status[{{ $key1 }}]" value="0">
                                        <input type="checkbox" name="status[{{ $key1 }}]" {{ $value1->status == 1 ? 'checked' : '' }} value="1">
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                       <div>
                            <button type="submit" class="btn btn-success me-2"></i>{{ localize('update') }}</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@push('js')

    <script src="{{ module_asset('Setting/js/home_page_settings.js') }}"></script>

@endpush
