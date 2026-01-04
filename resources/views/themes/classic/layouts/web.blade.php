<!DOCTYPE html>
@php
$direction = app()->getLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp
<html lang="en" dir="{{ $direction }}" class="@if (mode()) dark @endif">

<head>
	<meta charset="UTF-8" />
	<link rel="icon" type="image/svg+xml" href="{{ app_setting()->favicon }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="base-url" content="{{ url('/') }}">
	<meta name="google-site-verification" content="F_Q9nuMHlFCzzIgz2Ow-5bJM2ZVqoAYYIIVDwbsjOTI" />

	{!! SEOTools::generate() !!}

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="{{ \App\Helpers\ThemeHelper::asset('plugins/swiper/css/swiper-bundle.min.css') }}" />

	{{-- Load Google Fonts --}}
	@foreach ($loadedFonts as $font)
	<link href="{{ $font->source_url }}" rel="stylesheet">
	@endforeach

	{{-- Set CSS Variables --}}
	<style>
	:root {
		@if ($principalFont)
			--font-principal: {!! $principalFont->font_family !!};
		@endif

		@if ($alternateFont)
			--font-alternate: {!! $alternateFont->font_family !!};
		@endif

		@if ($supplementaryFont)
			--font-supplementary: {!! $supplementaryFont->font_family !!};
		@endif
	}

	body {
		font-family: var(--font-principal) !important;
	}

	h1,
	h2,
	h3,
	h4,
	a {
		font-family: var(--font-alternate) !important;
	}

	p {
		font-family: var(--font-supplementary) !important;
	}

	.line-height-25 {
		line-height: 2.5rem !important;
	}
	</style>

	<!-- Tailwind css -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@stack('plugins-css')
	@stack('custom-css')

</head>
<input type="hidden" name="language" id="language" value="{{ app()->getLocale() }}">
<input type="hidden" name="direction" id="direction" value="{{ $direction }}">

<body class="min-h-screen relative" @if (!$themeSettings->is_default && $themeSettings->font_family) style="font-family:
	{{ $themeSettings->font_family }};" @endif>

	@include('themes.classic.components.common.login')
	<!-- Top Section -->
	@include('themes.classic.layouts.header.top-section')

	<!-- top banner section -->
	<section class="container hidden xl:flex justify-between items-center my-2">
		<!-- Brand Logo -->
		<a class="hidden dark:block w-52 h-10 flex_center overflow-hidden" href="{{ __url('/') }}">
			<img src="{{ app_setting()->footer_logo }}" alt="" />
		</a>
		<a class="dark:hidden w-52 h-10 flex_center overflow-hidden" href="{{ __url('/') }}">
			<img src="{{ app_setting()->logo }}" alt="" />
		</a>
		<!-- Ad Banner Section -->

		<figure class="w-[660px] h-20 object-cover overflow-hidden">
			@if ($ad = get_advertisements(1, 1))
			{!! $ad->embed_code !!}
			@else
			<img class="w-full h-full object-cover" src="{{ asset('assets/top-header-banner.png') }}" alt="" />
			@endif
		</figure>
	</section>

	{{-- Menu section --}}
	@include('themes.classic.layouts.header.top-menu')
	@include('themes.classic.layouts.header.side-menu')
	@include ('themes.classic.layouts.header.mobile-menu')

	{{ $slot }}

	<!-- Footer section -->
	@include('themes.classic.layouts.footer')

	<!-- Cookies section -->
	@include('themes.classic.components.common.cookies')

	{{-- Btn scroll To Top --}}
	<button id="scrollToTopBtn" type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
		class="hidden bg-red-600 hover:bg-brand-primary rounded-full w-10 h-10 flex justify-center items-center fixed bottom-4 right-2 hover:-translate-y-1 z-50 transition-all duration-300 ease-in">
		<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<path fill="#fff"
				d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
		</svg>
	</button>
	{{-- scrollToTopBtn --}}
	<script>
	const scrollToTopBtn = document.getElementById('scrollToTopBtn');

	window.addEventListener('scroll', () => {
		if (window.scrollY > 400) {
			scrollToTopBtn.classList.remove('hidden');
		} else {
			scrollToTopBtn.classList.add('hidden');
		}
	});

	const subscribeUrl = "{{ route('subscribe.ajax') }}";
	const categoryLoadMoreUrl = "{{ route('load.more.category.news') }}";
	const videoLoadMoreUrl = "{{ route('load.more.video.news') }}";
	const ajaxPollVoteUrl = "{{ route('ajax.poll.vote') }}";
	const ajaxPollResultUrl = "{{ route('ajax.poll.result', ['poll' => '__POLL_ID__']) }}";
	</script>
	<script src="{{ asset('website/js/jquery-3.7.1.min.js') }}"></script>

	<script src="{{ \App\Helpers\ThemeHelper::asset('plugins/swiper/js/swiper-bundle.min.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('plugins/youtube-api/youtube-iframe-api.js') }}"></script>

	<script src="{{ \App\Helpers\ThemeHelper::asset('js/website.js?v=5') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/swiper/breaking-news.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/category-tab.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/global-tab.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/dark-light.js?v=2') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/user-profile.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/global-modal.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/mega-menu-inner-tab.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/mobile-side-menu.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/top-menu.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/video-play.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/login-modal.js?v=5') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/subscribe-form.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/category-view.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/poll-vote-result.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/youtube-play-alpinejs.js') }}"></script>
	<script src="{{ \App\Helpers\ThemeHelper::asset('js/language-switcher-sm.js') }}"></script>

	<script src="{{ asset('website/js/copy-url.js') }}"></script>
	<script src="{{ asset('website/js/customized-font-size.js?v=5') }}"></script>

	@stack('custom-js')
	@stack('plugins-js')

</body>

</html>
