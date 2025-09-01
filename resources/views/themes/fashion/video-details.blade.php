<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap" href="{{ __url('/') }}">
                        {{ localize('home') }}
                    </a>
                </li>
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary capitalize line-clamp-1">{{ localize('video_details') }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="dark:text-white lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            <div class="">
                <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold line-clamp-2">
                    {{ $videoNews->title }}
                </h1>
                <div class="flex md:items-center justify-between flex-col md:flex-row gap-4 my-2">
                    <div class="dark:text-white capitalize flex items-center gap-1 text-sm">
                        <span>{{ views_format($videoNews->total_view) }}&nbsp;{{ localize('view') }}</span>
                        <span>{{ $videoNews->postByUser->full_name ?? localize('unknown') }}</span>
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($videoNews->publish_date) }}</span>
                    </div>

                    <!-- Social section -->
                    @include ('themes.fashion.components.common.social-section')

                </div>
            </div>

            @php
                $poster = $videoNews->thumbnail_image
                    ? asset('storage/' . $videoNews->thumbnail_image)
                    : asset('/assets/thumbnail-image.jpg');

                $videoSrc = $videoNews->video;
                $videoUrl = $videoNews->video_url;

                $useIframe = false;
                $embedSrc = '';
                $renderType = '';

                if ($videoSrc) {
                    $renderType = 'video';
                    $src = asset('storage/' . $videoSrc);
                } elseif ($videoUrl) {
                    if (Str::contains($videoUrl, ['youtube.com/watch?v=', 'youtu.be'])) {
                        // Convert to embed URL
                        $videoId = '';

                        if (Str::contains($videoUrl, 'watch?v=')) {
                            $videoId = explode('watch?v=', $videoUrl)[1];
                            $videoId = explode('&', $videoId)[0]; // remove any additional query params
                        } elseif (Str::contains($videoUrl, 'youtu.be/')) {
                            $videoId = explode('youtu.be/', $videoUrl)[1];
                        }

                        $src =
                            'https://www.youtube.com/embed/' .
                            $videoId .
                            '?enablejsapi=1&controls=1&modestbranding=1&rel=0';
                        $renderType = 'iframe';
                    } elseif (Str::contains($videoUrl, 'youtube.com/embed')) {
                        $src = $videoUrl;
                        $renderType = 'iframe';
                    } elseif (Str::contains($videoUrl, 'vimeo.com')) {
                        $src = $videoUrl;
                        $renderType = 'iframe';
                    } elseif (Str::endsWith($videoUrl, '.mp4')) {
                        $src = $videoUrl;
                        $renderType = 'video';
                    }
                }
            @endphp

            <!-- Video banner section start-->
            @if ($renderType === 'video')
                <div x-data="{ showVideo: false }" class="relative aspect-video mt-4 mb-4">

                    {{-- Poster + Play button --}}
                    <div x-show="!showVideo" class="absolute inset-0 cursor-pointer z-20"
                        @click="showVideo = true; $refs.videoEl.play()">
                        <img src="{{ $poster }}" alt="Custom Video Poster"
                            class="w-full h-full object-cover shadow-md">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>

                    {{-- HTML5 Video --}}
                    <video x-ref="videoEl" x-show="showVideo" controls class="absolute top-0 left-0 w-full h-full z-10"
                        poster="{{ $poster }}">
                        <source src="{{ $src }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @elseif ($renderType === 'iframe')
                <div x-data="{ showPlayer: false }" class="relative aspect-video mt-4 mb-4">

                    {{-- Custom thumbnail --}}
                    <template x-if="!showPlayer">
                        <div class="absolute inset-0 cursor-pointer" @click="showPlayer = true">
                            <img src="{{ $poster }}" alt="Custom Video Thumbnail"
                                class="w-full h-full object-cover shadow-md">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                    </template>

                    {{-- YouTube iframe --}}
                    <template x-if="showPlayer">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="{{ $src }}{{ Str::contains($src, '?') ? '&' : '?' }}autoplay=1"
                            title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </template>
                </div>
            @endif

            @if (!empty($videoNews->image_title))
                <p class="text-sm text-gray-500 dark:text-gray-400 italic text-center my-2">
                    {{ $videoNews->image_title }}
                </p>
            @endif

            <div class="prose-content dark:text-white">
                {!! $videoNews->details !!}
            </div>

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.fashion.components.common.popular-post')

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
        <section class="dark:text-white lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <section class="mt-6">
                <!-- Slider Next/Preview Button -->
                <div class="flex items-center justify-between gap-2 mb-4">
                    <button type="button"
                        class="text-teal-600 hover:text-brand-primary flex justify-center items-center transition-all duration-300 ease-in-out article-swiper-button-prev">
                        <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20" fill="none">
                            <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="currentColor" />
                        </svg>
                        <span class="text-sm">{{ localize('previous_article') }}</span>
                    </button>
                    <button type="button"
                        class="text-teal-600 hover:text-brand-primary flex justify-center items-center transition-all duration-300 ease-in-out article-swiper-button-next">
                        <span class="text-sm">{{ localize('next_article') }}</span>
                        <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20" fill="none">
                            <path
                                d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
                <!-- Article Slider Section -->
                <div class="swiper w-full h-full ArticleSwiper">
                    <div class="swiper-wrapper">

                        <!-- Article Slider 1 -->
                        @if ($previousNews->isNotEmpty())
                            <div class="swiper-slide">
                                <div
                                    class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">

                                    <!-- Article List -->
                                    @foreach ($previousNews as $index => $previous)
                                        @php
                                            $position = $index % 4;
                                            $borderClasses = match ($position) {
                                                0
                                                    => 'flex items-center gap-4 py-6 md:py-10 border-b md:border-b-0 md:border-r pr-6 px-4 md:px-0 dark:border-neutral-800',
                                                1
                                                    => 'flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 px-4 md:px-0 dark:border-neutral-800',
                                                default => '',
                                            };

                                            $previousSrc = $previous->thumbnail_image
                                                ? asset('storage/' . $previous->thumbnail_image)
                                                : asset('/assets/thumbnail-image.jpg');
                                        @endphp

                                        <div class="{{ $borderClasses }}">
                                            <!-- card image -->
                                            <a href="{{ __url($previous->encode_title) }}">
                                                <figure class="w-[100px] h-16 overflow-hidden">
                                                    <img class="w-full h-full object-cover" src="{{ $previousSrc }}"
                                                        alt="" />
                                                </figure>
                                            </a>

                                            <!-- Message -->
                                            <a href="{{ __url($previous->encode_title) }}"
                                                class="text-neutral-600 dark:text-neutral-100">
                                                {{ $previous->title }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Article Slider 2 -->
                        @if ($nextNews->isNotEmpty())
                            <div class="swiper-slide">
                                <div
                                    class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">

                                    <!-- Article List -->
                                    @foreach ($nextNews as $index => $next)
                                        @php
                                            $position = $index % 4;
                                            $borderClasses = match ($position) {
                                                0
                                                    => 'flex items-center gap-4 py-6 md:py-10 border-b md:border-b-0 md:border-r pr-6 px-4 md:px-0 dark:border-neutral-800',
                                                1
                                                    => 'flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 px-4 md:px-0 dark:border-neutral-800',
                                                default => '',
                                            };

                                            $nextSrc = $next->thumbnail_image
                                                ? asset('storage/' . $next->thumbnail_image)
                                                : asset('/assets/thumbnail-image.jpg');
                                        @endphp

                                        <div class="{{ $borderClasses }}">
                                            <!-- card image -->
                                            <a href="{{ __url($next->encode_title) }}">
                                                <figure class="w-[100px] h-16 overflow-hidden">
                                                    <img class="w-full h-full object-cover" src="{{ $nextSrc }}"
                                                        alt="" />
                                                </figure>
                                            </a>

                                            <!-- Message -->
                                            <a href="{{ __url($next->encode_title) }}"
                                                class="text-neutral-600 dark:text-neutral-100">
                                                {{ $next->title }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- add section -->
            <figure class="mt-6">
                @if ($ad = get_advertisements(3, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                        alt="" />
                @endif
            </figure>

            <!-- Related post Section -->
            <section class="lg:col-span-3 mt-6">
                <div
                    class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
                    <h1 class="text-brand-primary text-lg font-semibold uppercase">
                        {{ localize('recent_post') }}
                    </h1>
                </div>

                <!-- Card section -->
                <div
                    class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 xl:gap-0 xl:divide-x divide-neutral-200 dark:divide-neutral-700">

                    @php
                        $recentPostsChunkedNews = $recentPosts->chunk(4);
                    @endphp

                    @foreach ($recentPostsChunkedNews as $index => $recentPost)
                        @php
                            $paddingClass = match ($index) {
                                0 => 'xl:px-3 xl:pl-0',
                                1 => 'xl:px-3',
                                2 => 'xl:px-3 xl:pr-0',
                            };
                        @endphp

                        @if ($recentPost->isNotEmpty())
                            <!-- cart 1 -->
                            <div class="{{ $paddingClass }}">
                                <a href="{{ __url($recentPost->first()->encode_title) }}"
                                    class="block w-full h-64 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ $recentPost->first()->thumbnail_image ? asset('storage/' . $recentPost->first()->thumbnail_image) : asset('/assets/thumbnail-image.jpg') }}"
                                        alt="{{ $recentPost->first()->image_alt }}" />
                                </a>
                                <div class="space-y-2 divide-y divide-neutral-200 dark:divide-neutral-700">
                                    <div class="py-2 space-y-2">
                                        <a href="{{ __url($recentPost->first()->encode_title) }}"
                                            class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                            {{ $recentPost->first()->title }}
                                        </a>
                                        <p class="line-clamp-3 dark:text-neutral-400">
                                            {{ clean_news_content($recentPost->first()->details) }}
                                        </p>
                                        <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                            <span>{{ views_format($recentPost->first()->total_view) }}&nbsp;{{ localize('view') }}</span>
                                            <span>{{ $recentPost->first()->postByUser->full_name ?? localize('unknown') }}</span>
                                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512">
                                                <path fill="currentColor"
                                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                            </svg>
                                            <span>{{ news_publish_date_format($recentPost->first()->publish_date) }}</span>
                                        </div>
                                    </div>


                                    <!-- bottom news list -->
                                    @if ($recentPost->slice(1)->isNotEmpty())
                                        @foreach ($recentPost->slice(1) as $recentPostItem)
                                            <a class="block pt-2" href="{{ __url($recentPostItem->encode_title) }}">
                                                <div class="grid grid-cols-3 gap-2 items-center">
                                                    <figure class="w-full h-20">
                                                        <img class="w-full h-full object-cover"
                                                            src="{{ $recentPostItem->thumbnail_image ? asset('storage/' . $recentPostItem->thumbnail_image) : asset('/assets/thumbnail-image.jpg') }}"
                                                            alt="{{ $recentPostItem->image_alt }}" />
                                                    </figure>
                                                    <h2
                                                        class="col-span-2 line-clamp-3 text-neutral-600 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary">
                                                        {{ $recentPostItem->title }}
                                                    </h2>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </section>

            <!-- Comment Section -->
            <input type="hidden" form="comment-form" name="news_comment_type" value="video_news">

            @if (app_setting()->web_user_can_comment == 1)
                @include ('themes.fashion.components.common.comment-section')
            @endif

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Top Week -->
                @include('themes.fashion.components.common.recommended-top-week-post')

                <!-- Voting poll -->
                @include('themes.fashion.components.common.voting-poll')

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

</x-web-layout>
