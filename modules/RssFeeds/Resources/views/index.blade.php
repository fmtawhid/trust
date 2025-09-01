@extends('backend.layouts.app')
@section('title', localize('rss_and_sitemap_link'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('rss_and_sitemap_link') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table_customize">

                <div class="row ps-4 pe-4">

                    @foreach ($languages as $language)

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="fb"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ ucwords(localize('rss_link')) }} ({{ $language->langname }})</label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="text" class="form-control" id="fb" name="fb"
                                        placeholder="{{ ucwords(localize('rss_link')) }}" 
                                        value='{{ url("rss/{$language->value}.xml") }}'>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach

                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <label class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold"></label>
                            <div class="col-sm-10 col-md-12 col-xl-10">
                                <div class="alert alert-danger alert-large">
                                    <strong>{{ localize('note') }}:</strong>&nbsp;
                                    {{ localize('rss_link_share_note') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <hr>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <label for="tw"
                                class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold text-capitalize">{{ localize('google_news_publisher') }}({{ localize('rss_feed') }})</label>
                            <div class="col-sm-10 col-md-12 col-xl-10">
                                <input type="text" class="form-control" id="tw" name="tw"
                                    placeholder="{{ localize('google_news_publisher') }}({{ localize('rss_feed') }})" value="{{ url('rss.xml')}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <label class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold"></label>
                            <div class="col-sm-10 col-md-12 col-xl-10">
                                <div class="alert alert-danger alert-large">
                                    <strong>{{ localize('note') }}:</strong>&nbsp;
                                    {{ localize('google_news_publisher_rss_note') }} ({{ $defaultLang->langname }}).
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
