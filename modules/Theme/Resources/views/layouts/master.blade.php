<x-app-layout title="{{ View::hasSection('title') ? trim(View::yieldContent('title')) : localize('theme') }}">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ View::hasSection('title') ? View::yieldContent('title') : localize('theme') }}</h6>
                </div>
                @hasSection('header_content')
                    @yield('header_content')
                @endif
            </div>
        </div>
        <div class="card-body">
            @include('backend.layouts.common.validation')
            @include('backend.layouts.common.message')
            @yield('content')
        </div>
    </div>
    @hasSection('outbox_content')
        @yield('outbox_content')
    @endif
    @push('css')
        <link rel="stylesheet" href="{{ asset('backend/assets/theme/css/app.css') }}">
    @endpush
    @push('js')
        <script src="{{ asset('backend/assets/theme/js/app.js') }}"></script>
    @endpush
</x-app-layout>