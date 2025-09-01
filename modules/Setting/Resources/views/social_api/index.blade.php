@extends('setting::settings')
@section('title', localize('social_api_key_setup'))
@push('css')
@endpush

@section('setting_content')


    <!--/.Content Header (Page header)-->
    <div class="body-content pt-0">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 fw-semi-bold mb-0">{{ localize('social_api_key_setup') }}</h6>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('social_api_keys.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="facebook_client_id"
                                            class="col-lg-3 col-form-label ps-0 label_facebook_client_id">
                                            {{ localize('facebook_client_id') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="facebook_client_id" id="field_facebook_client_id"
                                                value="{{ $socialApiKey->get('facebook')->client_id ?? null }}"
                                                placeholder="{{ localize('facebook_client_id') }}"
                                                class="form-control"autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="facebook_client_secret"
                                            class="col-lg-3 col-form-label ps-0 label_facebook_client_secret">
                                            {{ localize('facebook_client_secret') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="facebook_client_secret"
                                                id="field_facebook_client_secret"
                                                value="{{ $socialApiKey->get('facebook')->client_secret ?? null }}"
                                                placeholder="{{ localize('facebook_client_secret') }}"
                                                class="form-control"autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="google_client_id"
                                            class="col-lg-3 col-form-label ps-0 label_google_client_id">
                                            {{ localize('google_client_id') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="google_client_id" id="field_google_client_id"
                                                value="{{ $socialApiKey->get('google')->client_id ?? null }}"
                                                placeholder="{{ localize('google_client_id') }}"
                                                class="form-control"autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="google_client_secret"
                                            class="col-lg-3 col-form-label ps-0 label_google_client_secret">
                                            {{ localize('google_client_secret') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="google_client_secret"
                                                id="field_google_client_secret"
                                                value="{{ $socialApiKey->get('google')->client_secret ?? null }}"
                                                placeholder="{{ localize('google_client_secret') }}"
                                                class="form-control"autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="google_callback_url"
                                            class="col-lg-3 col-form-label ps-0 label_google_callback_url">
                                            {{ localize('google_callback_url') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="google_callback_url" id="field_google_callback_url"
                                                value="{{ route('google-callback') }}"
                                                placeholder="{{ localize('google_callback_url') }}"
                                                class="form-control"autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 mx-0 row">
                                        <label for="facebook_callback_url"
                                            class="col-lg-3 col-form-label ps-0 label_facebook_callback_url">
                                            {{ localize('facebook_callback_url') }}

                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="facebook_callback_url"
                                                id="field_facebook_callback_url" value="{{ route('facebook-callback') }}"
                                                placeholder="{{ localize('facebook_callback_url') }}"
                                                class="form-control"autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer form-footer text-start">
                            <button type="submit" class="btn btn-primary btn-sm ">{{ localize('update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
