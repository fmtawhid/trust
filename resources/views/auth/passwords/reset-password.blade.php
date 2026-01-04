@extends('login.app')
@section('title', localize('reset_password'))

@section('content')

    @include('backend.layouts.common.validation')
    @include('backend.layouts.common.message')

    <div class="d-flex align-items-center justify-content-center text-center h-100vh">
        <div class="form-wrapper m-auto">
            <div class="form-container my-4">

                <div class="register-logo text-center mb-4">
                    <a href="{{ route('home') }}">
                        <img src="{{ app_setting()->logo }}" alt="">
                    </a>
                </div>


                <div class="panel">
                    <div class="panel-header text-center mb-4">
                        <h3 class="fs-24">{{ localize('reset_password') }}</h3>
                        <p class="text-muted text-center mb-0">{{ localize('recover_password') }}</p>
                    </div>

                    <form method="POST" action="{{ route('webuser.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-2">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-2">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                placeholder="{{ localize('new_password') }}" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required placeholder="{{ localize('confirm_password') }}" autocomplete="new-password">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button type="submit"
                            class="btn btn-success btn-block mt-4 w-100">{{ localize('reset_password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.End of form wrapper -->
@endsection
