<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>

                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap"
                        href="{{ __url('rss-news') }}">{{ localize('rss_feeds') }}</a>
                </li>
                @if ($newsDetail['feed_name'])
                    <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <li>
                        <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap"
                            href="{{ __url($newsDetail['feed_slug']) }}">{{ $newsDetail['feed_name'] }}</a>
                    </li>
                @endif

                <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary line-clamp-1">{{ $newsDetail['title'] }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            <div class="">
                @if ($newsDetail['categories'])
                    <div
                        class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center bg-brand-primary clip-hex-right">
                        {{ $newsDetail['categories'][0] }}
                    </div>
                @endif

                <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold">
                    {{ $newsDetail['title'] }}
                </h1>
                <div class="flex md:items-center justify-between flex-col md:flex-row gap-4 mt-2">
                    <div class="dark:text-white capitalize flex items-center gap-1 text-sm">
                        <span>{{ $newsDetail['author'] ?? localize('unknown') }}</span>
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($newsDetail['pubDate']) }}</span>
                    </div>

                    <!-- Social section -->
                    @include ('themes.classic.components.common.social-section')
                </div>
            </div>
            <!-- banner section -->
            <div class="dark:text-white mt-6">
                <figure class="mb-8">
                    <img class="w-full max-h-[550px]"
                        src="{{ isset($newsDetail['image']) ? $newsDetail['image'] : asset('/assets/news-details-view.png') }}"
                        alt="{{ $newsDetail['title'] }}" />
                    @if (isset($newsDetail['image']))
                        <figcaption class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic text-center">
                            {{ $newsDetail['title'] }}
                        </figcaption>
                    @endif
                </figure>

                {{ $newsDetail['description'] }}

            </div>

            <!-- add section -->
            <figure class="mt-6">
                @if ($ad = get_advertisements(3, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                        alt="" />
                @endif
            </figure>

            @if ($newsDetail['show_button'] === 1)
                <div class="flex justify-end items-center mt-4">
                    <a href="{{ $newsDetail['link'] }}" target="_blank"
                        class="px-6 py-3 text-center rounded-md bg-neutral-200 dark:bg-neutral-700 dark:border-neutral-800 dark:text-white dark:hover:text-brand-primary dark:hover:bg-transparent dark:hover:border-brand-primary hover:bg-neutral-100 border hover:border-brand-primary hover:text-brand-primary transition_3">
                        {{ $newsDetail['button_text'] }}
                    </a>
                </div>
            @endif

            <!-- Related post Section -->
            @if (!empty($relatedNews))
                @include ('themes.classic.rss_related_post')
            @endif

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.classic.components.common.popular-post')

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(3, 1))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}"
                            alt="" />
                    @endif
                </figure>

                {{-- <figure class="">
                    @if ($ad = get_advertisements(3, 2))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large.png') }}"
                            alt="" />
                    @endif
                </figure> --}}

                <!-- Voting poll -->
                @if ($votingPoll)
                    @include('themes.classic.components.common.voting-poll')
                @endif

            </div>
        </section>
    </section>

</x-web-layout>
