@extends('backend.layouts.app')
@section('title', localize('sitemap_links'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('sitemap_links') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table_customize">

                @foreach ($languages as $language)
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <label for="sitemap_links"
                                class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ ucwords(localize('sitemap_link')) }} ({{ $language->langname }})</label>
                            
                            <div class="col-sm-10 col-md-12 col-xl-10">
                                <input type="text" class="form-control" id="sitemap_links" name="sitemap_links"
                                    placeholder="{{ ucwords(localize('sitemap_link')) }}" 
                                    value='{{ url("sitemap/{$language->value}.xml") }}'>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush

