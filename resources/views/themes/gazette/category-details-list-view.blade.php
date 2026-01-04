<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-12 lg:mt-1 pt-1">
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

                <li class="text-brand-primary line-clamp-1">{{ $category->category_name }}</li>
            </ul>
        </div>
    </section>

    <!-- Category details Start -->
    @php
        $firstSixNews = $categoryNews->slice(0, 6);
        $secondSixNews = $categoryNews->slice(6, 6);
        $remainingNews = $categoryNews->slice(12);
    @endphp

    <section class="container mt-2 pb-8 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            <!-- Section Title -->
            <div
                class="flex items-center justify-between mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
                <h1 class="text-brand-primary text-lg font-semibold uppercase">
                    {{ $category->category_name }}
                </h1>
                <div class="flex items-center gap-2">
                    <a href="{{ __url($category->slug) }}" class="p-1.5 border shadow-sm dark:text-white">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M0 72C0 49.9 17.9 32 40 32l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40L0 72zM0 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM128 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 72c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM288 232l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 392c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 72l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM320 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40z"
                                class=""></path>
                        </svg>
                    </a>
                    <a href="{{ route('website.category-details-list-view', $category->slug) }}"
                        class="p-1.5 border border-brand-primary shadow-sm text-brand-primary hover:text-brand-primary">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                                class=""></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card section -->
            <div class="space-y-9">
                <!-- cart 1 -->
                @if ($firstSixNews->isNotEmpty())
                    @foreach ($firstSixNews as $news)
                        <div class="grid items-center grid-cols-4 gap-4">
                            <a href="{{ __url($news->encode_title) }}"
                                class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                    src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/category-grid-view.png') }}"
                                    alt="{{ $news->image_alt }}" />
                            </a>
                            <div class="col-span-3 space-y-2">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $news->title }}
                                </a>

                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                    <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                    </svg>
                                    <span>{{ $news->comments_count }}</span>
                                </div>
                                <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                    {{ clean_news_content($news->news) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- add section -->
                <figure class="mt-6">
                    @if ($ad = get_advertisements(2, 2))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                            alt="" />
                    @endif
                </figure>
            </div>

            <section class="my-8">
                <!-- Card section -->
                <div class="space-y-9">

                    <!-- cart -->
                    @if ($secondSixNews->isNotEmpty())
                        @foreach ($secondSixNews as $news)
                            <div class="grid items-center grid-cols-4 gap-4">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/category-grid-view.png') }}"
                                        alt="{{ $news->image_alt }}" />
                                </a>
                                <div class="col-span-3 space-y-2">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $news->title }}
                                    </a>

                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                        </svg>
                                        <span>{{ $news->comments_count }}</span>
                                    </div>
                                    <p
                                        class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ clean_news_content($news->news) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <!-- add section -->
                        <figure class="mt-6">
                            @if ($ad = get_advertisements(2, 3))
                                {!! $ad->embed_code !!}
                            @else
                                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                                    alt="" />
                            @endif
                        </figure>
                    @endif
                </div>
            </section>

            <section class="my-8">
                <div id="news-grid"
                    class="space-y-9 relative isolate before:w-full before:h-1/2 before:bg-gradient-to-t from-white dark:from-black before:absolute before:bottom-0 before:left-0 before:z-10">

                    @if ($remainingNews->isNotEmpty())

                        @foreach ($remainingNews as $news)
                            <div class="grid items-center grid-cols-4 gap-4">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/category-grid-view.png') }}"
                                        alt="{{ $news->image_alt }}" />
                                </a>
                                <div class="col-span-3 space-y-2">
                                    <a href="{{ __url($news->encode_title) }}"
                                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                        {{ $news->title }}
                                    </a>

                                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                        <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($news->publish_date) }}</span>
                                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                        </svg>
                                        <span>{{ $news->comments_count }}</span>
                                    </div>
                                    <p
                                        class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                        {{ clean_news_content($news->news) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                </div>

                <div class="flex justify-center items-center mt-8">
                    <button type="button" id="load-more-btn" data-offset="21"
                        data-category-id="{{ $category->id }}" data-view-style="list"
                        class="px-6 py-3 text-center rounded-md bg-neutral-200 dark:bg-neutral-700 dark:border-neutral-800 dark:text-white dark:hover:text-brand-primary dark:hover:bg-transparent dark:hover:border-brand-primary hover:bg-neutral-100 border hover:border-brand-primary hover:text-brand-primary transition_3">
                        {{ localize('load_more') }}
                    </button>
                </div>
                @endif

            </section>

            <div id="no-more-news-message" class="hidden text-center text-sm text-gray-500">
                {{ localize('no_more_news_available') }}
            </div>

        </section>

        <!-- Right section news -->
        <section class="space-y-6">
            <!-- Popular post -->
            @include('themes.gazette.components.common.popular-post')

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
            @include('themes.gazette.components.common.recommended-top-week-post')

            <!-- Voting poll -->
            @if ($votingPoll)
                @include('themes.gazette.components.common.voting-poll')
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

        </section>
    </section>
    <!-- Category details End -->
</x-web-layout>
