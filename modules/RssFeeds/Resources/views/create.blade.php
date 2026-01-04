@extends('backend.layouts.app')
@section('title', localize('create_new_rss_feed'))
@push('css')
@endpush
@section('content')
    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('create_new_rss_feed') }}</h6>
                </div>
                <div class="text-end">
                    <div class="actions">
                        @can('read_external_rss_feeds')
                            <a href="{{ route('rss_feeds.show') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-bars"></i>&nbsp;
                                {{ localize('rss_list') }}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table_customize">
                <div class="row ps-4 pe-4">
                    <form action="{{ route('rss_feeds.store') }}" method="POST">
                        @csrf
                        
                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="feed_name"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('feed_name') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="text" class="form-control" id="feed_name" name="feed_name" required
                                        placeholder="{{ localize('feed_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="feed_url"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('feed_url') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="text" class="form-control" id="feed_url" name="feed_url" required
                                        placeholder="{{ localize('feed_url') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="number_of_posts"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('number_of_posts_to_show') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="number" min="1" class="form-control" id="number_of_posts" name="number_of_posts" required
                                        placeholder="12" value="12">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="paper_language"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('show_in_language') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <select name="paper_language" id="paper_language" class="form-control select-basic-single" required>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">
                                                {{ $language->langname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="show_read_more_button"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('show_read_more_button') }}</label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="checkbox" name="show_read_more_button"
                                        id="show_read_more_button" value="0" checked
                                        data-bs-toggle="toggle" data-on="Yes" data-off="No"
                                        data-onstyle="success" data-offstyle="danger">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <label for="read_more_button_text"
                                    class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold">{{ localize('read_more_button_text') }}</label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <input type="text" class="form-control" id="read_more_button_text" name="read_more_button_text"
                                        value="{{ ucwords(localize('read_more')) }}"
                                        placeholder="{{ ucwords(localize('read_more')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="row">
                                <label class="col-form-label col-sm-2 col-md-12 col-xl-2 fw-semibold"></label>
                                <div class="col-sm-10 col-md-12 col-xl-10">
                                    <button type="submit" class="btn btn-success">{{ localize('save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

@endsection
