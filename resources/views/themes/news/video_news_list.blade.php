<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-12 lg:mt-1 pt-1">
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

                <li class="text-brand-primary line-clamp-1">{{ localize('videos') }}</li>
            </ul>
        </div>
    </section>

    <!-- Category details Start -->
    @php
        $firstSixNews = $videoNews->slice(0, 6);
        $secondSixNews = $videoNews->slice(6, 6);
        $remainingNews = $videoNews->slice(12);
    @endphp

    <section class="container mt-2 pb-8 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            <!-- Section Title -->
            <div
                class="flex items-center justify-between mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
                {{-- Title --}}
                <h1 class="text-brand-primary text-lg font-semibold uppercase">
                    {{ localize('video_news') }}
                </h1>
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
                    @if ($firstSixNews->isNotEmpty())
                        @foreach ($firstSixNews as $news)
                            <div class="">
                                <div class="relative group">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="block w-full h-42 md:h-[150px] 2xl:h-40 4xl:h-52 group overflow-hidden">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                            src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                            alt="{{ $news->image_alt }}" />

                                        <!-- Play button -->
                                        <a href="{{ __url($news->encode_title) }}"
                                            class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                            <span
                                                class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </a>
                                </div>

                                <div class="py-3 space-y-2">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $news->title }}
                                    </a>
                                    <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ clean_news_content($news->details) }}
                                    </p>
                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                        <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($news->publish_date) }}</span>
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
                @if ($firstSixNews->isNotEmpty())
                    @foreach ($firstSixNews as $news)
                        <div class="grid items-center grid-cols-4 gap-4">

                            <div class="relative group">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                        alt="{{ $news->image_alt }}" />

                                    <!-- Play button -->
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                        <span
                                            class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </a>
                            </div>

                            <div class="col-span-3 space-y-2">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $news->title }}
                                </a>

                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                    <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                </div>
                                <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                    {{ clean_news_content($news->details) }}
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

            <!-- secondSixNews Card View -->
            @if ($secondSixNews->isNotEmpty())
                <div data-content="card_view" class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <!-- cart -->
                    @foreach ($secondSixNews as $news)
                        <div class="">
                            <div class="relative group">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-42 md:h-[150px] 2xl:h-40 4xl:h-52 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                        alt="{{ $news->image_alt }}" />

                                    <!-- Play button -->
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                        <span
                                            class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </a>
                            </div>

                            <div class="py-3 space-y-2">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $news->title }}
                                </a>
                                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                    {{ clean_news_content($news->details) }}
                                </p>
                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                    <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- List View --}}
                <div data-content="list_view" class="space-y-9 hidden">
                    <!-- cart -->
                    @foreach ($secondSixNews as $news)
                        <div class="grid items-center grid-cols-4 gap-4 mt-6">

                            <div class="relative group">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                        alt="{{ $news->image_alt }}" />

                                    <!-- Play button -->
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                        <span
                                            class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </a>
                            </div>

                            <div class="col-span-3 space-y-2">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $news->title }}
                                </a>

                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                    <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                </div>
                                <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                    {{ clean_news_content($news->details) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- add section -->
                <figure class="mt-6 mb-6">
                    @if ($ad = get_advertisements(2, 3))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                            alt="" />
                    @endif
                </figure>
            @endif

            @if ($remainingNews->isNotEmpty())
                <section class="my-8">
                    <!-- Card section -->
                    <div id="news-grid" data-content="card_view"
                        class="relative isolate grid md:grid-cols-2 xl:grid-cols-3 gap-8 before:w-full /*before:h-1/2*/ before:bg-gradient-to-t from-white dark:from-black before:absolute before:bottom-0 before:left-0 before:z-10 mt-0">
                        <!-- cart -->
                        @foreach ($remainingNews as $news)
                            <div class="">
                                <div class="relative group">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="block w-full h-42 md:h-[150px] 2xl:h-40 4xl:h-52 group overflow-hidden">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                            src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                            alt="{{ $news->image_alt }}" />

                                        <!-- Play button -->
                                        <a href="{{ __url($news->encode_title) }}"
                                            class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                            <span
                                                class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </a>
                                </div>

                                <div class="py-3 space-y-2">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $news->title }}
                                    </a>
                                    <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ clean_news_content($news->details) }}
                                    </p>
                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                        <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- List View --}}
                    <div data-content="list_view" id="news-list" class="space-y-9 hidden mt-0">
                        <!-- cart -->
                        @foreach ($remainingNews as $news)
                            <div class="grid items-center grid-cols-4 gap-4">

                                <div class="relative group">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                            src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
                                            alt="{{ $news->image_alt }}" />

                                        <!-- Play button -->
                                        <a href="{{ __url($news->encode_title) }}"
                                            class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                            <span
                                                class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </a>
                                </div>

                                <div class="col-span-3 space-y-2">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $news->title }}
                                    </a>

                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
                                        <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                    </div>
                                    <p
                                        class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ clean_news_content($news->details) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center items-center mt-8">
                        <button type="button" id="load-more-video-news-btn" data-offset="21"
                            class="px-6 py-3 text-center rounded-md bg-neutral-200 dark:bg-neutral-700 dark:border-neutral-800 dark:text-white dark:hover:text-brand-primary dark:hover:bg-transparent dark:hover:border-brand-primary hover:bg-neutral-100 border hover:border-brand-primary hover:text-brand-primary transition_3">
                            {{ localize('load_more') }}
                        </button>
                    </div>

                </section>
            @endif

            <div id="no-more-news-message" class="hidden text-center text-sm text-gray-500">
                {{ localize('no_more_news_available') }}
            </div>

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

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(2, 4))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large.png') }}"
                            alt="" />
                    @endif
                </figure>
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
