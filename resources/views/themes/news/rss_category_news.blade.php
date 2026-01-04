<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <li class="text-brand-primary line-clamp-1">{{ localize('rss_feeds') }}</li>
            </ul>
        </div>
    </section>


    <section class="container mt-2 pb-8 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="md:col-span-2 xl:col-span-3 gap-6">

            @if (!empty($rssFeedNews))

                <!-- Section Title -->
                <div
                    class="flex items-center justify-between mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
                    {{-- Title --}}
                    <a href="{{ $rssFeedNews['slug'] }}"
                        class="text-brand-primary text-lg font-semibold uppercase block">
                        {{ $rssFeedNews['feed_name'] }}
                    </a>
                    {{-- Tab Button --}}
                    <div class="flex items-center gap-2">
                        <button type="button" data-tab="card_view" class="p-1.5 btn_card_view active">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M0 72C0 49.9 17.9 32 40 32l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40L0 72zM0 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM128 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 72c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM288 232l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 392c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 72l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM320 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40z"
                                    class=""></path>
                            </svg>
                        </button>
                        <button type="button" data-tab="list_view" class="p-1.5 btn_list_view">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                                    class=""></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Card View -->
                <div class="block">
                    <div data-content="card_view" class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                        <!-- cart -->
                        @if (!empty($rssFeedNews['news']))
                            @foreach ($rssFeedNews['news'] as $item)
                                <div class="">
                                    <a href="{{ __url($item['encode_title']) }}"
                                        class="block w-full h-42 md:h-[150px] 2xl:h-40 4xl:h-52 group overflow-hidden">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                            src="{{ isset($item['image']) ? $item['image'] : asset('/assets/news-card-view.png') }}"
                                            alt="{{ $item['title'] }}" />
                                    </a>
                                    <div class="py-3 space-y-2">
                                        <a href="{{ __url($item['encode_title']) }}"
                                            class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                            {{ $item['title'] }}
                                        </a>
                                        <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                            {{ $item['description'] }}
                                        </p>
                                        <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                            <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512">
                                                <path fill="currentColor"
                                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                            </svg>
                                            <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- List View --}}
                <div data-content="list_view" class="space-y-9 hidden">
                    <!-- cart -->
                    @if (!empty($rssFeedNews['news']))
                        @foreach ($rssFeedNews['news'] as $item)
                            <div class="grid items-center grid-cols-4 gap-4">
                                <a href="{{ __url($item['encode_title']) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ isset($item['image']) ? $item['image'] : asset('/assets/news-card-view.png') }}"
                                        alt="{{ $item['title'] }}" />
                                </a>
                                <div class="col-span-3 space-y-2">
                                    <a href="{{ __url($item['encode_title']) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $item['title'] }}
                                    </a>

                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                    </div>
                                    <p
                                        class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- add section -->
                <figure class="mt-6 mb-6">
                    @if ($ad = get_advertisements(2, 2))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                            alt="" />
                    @endif
                </figure>
            @endif
        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.news.components.common.popular-post')

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(2, 1))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}"
                            alt="" />
                    @endif
                </figure>

                <!-- Top Week -->
                @include('themes.news.components.common.recommended-top-week-post')

                <!-- Voting poll -->
                @if ($votingPoll)
                    @include('themes.news.components.common.voting-poll')
                @endif

            </div>
        </section>

    </section>

    @push('custom-js')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const tabButtons = document.querySelectorAll("[data-tab]");
                const tabContents = document.querySelectorAll("[data-content]");

                tabButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        const targetTab = button.getAttribute("data-tab");

                        // Update active styles
                        tabButtons.forEach(btn => {
                            btn.classList.remove("active");
                        });
                        button.classList.add("active");

                        // toggle content
                        tabContents.forEach(content => {
                            if (content.getAttribute("data-content") === targetTab) {
                                content.classList.remove("hidden");
                                content.classList.add("block");
                            } else {
                                content.classList.remove("block");
                                content.classList.add("hidden");
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

</x-web-layout>
