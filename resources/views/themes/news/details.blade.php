<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>
                @if ($newsDetail->category)
                    <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <li>
                        <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                            href="{{ __url($newsDetail->category->slug) }}">{{ $newsDetail->category->category_name ?? '' }}</a>
                    </li>
                @endif

                @if ($newsDetail->subCategory)
                    <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <li>
                        <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap"
                            href="{{ __url($newsDetail->subCategory->slug) }}">{{ $newsDetail->subCategory->category_name ?? '' }}</a>
                    </li>
                @endif

                <svg width="12" height="14" viewBox="0 0 12 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary line-clamp-1">{{ $newsDetail->title }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            <div class="">
                <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center bg-brand-primary clip-hex-right"
                    {!! bgColorStyle($newsDetail->category->color_code) !!}>
                    {{ Str::upper($newsDetail->category->category_name) }}
                </div>
                @if ($newsDetail->stitle)
                    <h2 class="dark:text-white mt-2">{{ $newsDetail->stitle }}</h2>
                @endif
                <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold">
                    {{ $newsDetail->title }}
                </h1>
                <div class="flex md:items-center justify-between flex-col md:flex-row gap-4 mt-2">
                    <div class="dark:text-white capitalize flex items-center gap-1 text-sm">
                        <span>{{ $newsDetail->postByUser->full_name ?? localize('unknown') }}</span>
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($newsDetail->created_at) }}</span>
                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                        </svg>
                        <span>{{ $newsDetail->comments_count }}</span>
                    </div>

                    <!-- Social section -->
                    @include ('themes.news.components.common.social-section')
                </div>
            </div>
            <!-- News Details -->
            <div class="dark:text-white mt-6">
                @if (isset($newsDetail->photoLibrary->large_image))
                    <figure class="mb-8">
                        <img class="w-full max-h-[550px]"
                            src="{{ isset($newsDetail->photoLibrary->large_image) ? asset('storage/' . $newsDetail->photoLibrary->large_image) : asset('/assets/news-details-view.png') }}"
                            alt="{{ $newsDetail->image_alt }}" />
                        <figcaption class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic text-center">
                            {{ $newsDetail->image_title }}
                        </figcaption>
                    </figure>
                @endif

                <div id="news-content" class="text-base prose-content">
                    {!! $newsDetail->news ?? 'null' !!}
                </div>

                {{-- News Post Video Url --}}
                @if ($newsDetail->videos)
                    @php
                        $videoData = manageVideoUrl($newsDetail->videos);
                    @endphp

                    @if ($videoData['type'] === 'video')
                        <video controls class="w-full h-auto aspect-video"
                            @if($videoData['thumb']) poster="{{ $videoData['thumb'] }}" @endif>
                            <source src="{{ $videoData['src'] }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    @elseif ($videoData['type'] === 'iframe')
                        <div x-data="{ showPlayer: false }" class="relative aspect-video mt-4">
                            {{-- Thumbnail --}}
                            <template x-if="!showPlayer">
                                <div class="absolute inset-0 cursor-pointer" @click="showPlayer = true">
                                    <img src="{{ $videoData['thumb'] ?? asset('images/default-thumbnail.jpg') }}"
                                        class="w-full h-full object-cover shadow-md">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </template>

                            {{-- iFrame --}}
                            <template x-if="showPlayer">
                                <iframe class="absolute top-0 left-0 w-full h-full"
                                    src="{{ $videoData['src'] }}{{ Str::contains($videoData['src'], '?') ? '&' : '?' }}autoplay=1"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>
                            </template>
                        </div>
                    @endif
                @endif

                {{-- Post Tag --}}
                @if ($newsDetail->postTags->count() > 0)
                    <div class="bg-white rounded-md shadow-sm p-3 mt-4 border border-gray-200">
                        <h2 class="font-bold text-gray-800 mb-2">{{ localize('tags') }}</h2>

                        <div class="flex flex-wrap gap-2">
                            @foreach ($newsDetail->postTags as $postTag)
                                <span class="inline-block text-neutral-700 bg-gray-100 px-3 py-1 rounded capitalize">
                                    {{ $postTag->tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.news.components.common.popular-post')

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(3, 1))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}"
                            alt="" />
                    @endif
                </figure>
            </div>
        </section>
    </section>

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">

            <!-- add section -->
            <figure class="mt-6">
                @if ($ad = get_advertisements(3, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                        alt="" />
                @endif
            </figure>

            <!-- Article-slider -->
            @include ('themes.news.components.slider.article-slider')


            <!-- Single Comment 1 -->
            @if (app_setting()->show_reporter_message == 1)
                <section class="flex gap-4 my-8">
                    <div>
                        <figure class="md:w-24 md:h-24 w-16 h-16 rounded-full overflow-hidden">
                            <img class="w-full h-full object-cover"
                                src="{{ $newsDetail->reporterBy->photo ? asset('storage/' . $newsDetail->reporterBy->photo) : asset('assets/opinion-avatar.png') }}"
                                alt="" />
                        </figure>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-3 dark:text-white">
                            <div class='flex gap-2 items-center justify-between'>
                                <h2 class="capitalize">
                                    <strong>{{ $newsDetail->reporterBy->name . ' ' . $newsDetail->reporterBy->nick_name }}</strong>
                                </h2>
                            </div>
                            <p class="text-neutral-500 dark:text-white line-clamp-3 capitalize">
                                {{ $newsDetail->reporter_message ?? null }}
                            </p>
                        </div>
                    </div>
                </section>
            @endif

            <!-- Related post Section -->
            @if ($sectionSixNews->isNotEmpty())
                @include ('themes.news.components.common.related-post')
            @endif

            <!-- Comment Section -->
            <input type="hidden" form="comment-form" name="news_comment_type" value="news">

            @if (app_setting()->web_user_can_comment == 1)
                @include ('themes.news.components.details.comment-section')
            @endif

        </section>

        <!-- Right section news -->
        <section class="md:w-1/2 lg:w-auto">
            <div class="space-y-6 sticky top-16">
                <!-- Top Week -->
                @include('themes.news.components.common.recommended-top-week-post')


                <!-- Voting poll -->
                @if ($votingPoll)
                    @include('themes.news.components.common.voting-poll')
                @endif

                <!-- Ads section -->
                <figure class="">
                    @if ($ad = get_advertisements(3, 4))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-medium.png') }}"
                            alt="" />
                    @endif
                </figure>
            </div>
        </section>
    </section>

    <!-- Details Page News (right side news sticky) End -->

</x-web-layout>
