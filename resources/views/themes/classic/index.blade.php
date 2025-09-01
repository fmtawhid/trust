<x-web-layout>
    @if ($breakingNews->isNotEmpty())
        @include('themes.classic.components.slider.topbreaking-news-slider')
    @endif

    @if ($homePageTopNews->isNotEmpty())
        @include('themes.classic.components.home.top-category-news')
    @endif

    @if ($sectionTwoNews['leftNews']->isNotEmpty() || $sectionTwoNews['rightNews']->isNotEmpty())
        @include('themes.classic.components.home.world-news')
    @endif

    <!-- Rendom News (right side news sticky) Start -->

    <section class="container my-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- banner section -->
            <figure class="mb-8">
                @if ($ad = get_advertisements(1, 2))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
                @endif
            </figure>


            <!-- SPORTS CATAGORY NEWS -->
            @if ($sectionThreeAllNews->isNotEmpty())
                @include('themes.classic.components.home.category-tab-news')
            @endif

            <!-- banner section -->
            <figure class="mb-8">
                @if ($ad = get_advertisements(1, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
                @endif
            </figure>

            <!-- POLITICS CATAGORY NEWS -->

            @if ($sectionFourNews->isNotEmpty())
                <section class="my-6">
                    <div
                        class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-20">
                        <h1 class="text-brand-primary text-lg font-semibold uppercase">
                            {{ $sectionFourNews[0]->category->category_name }}
                        </h1>
                        <!-- Slider Next/Preview Button -->
                        <div class="flex items-center gap-2">
                            <button type="button" id="section-prev-btn"
                                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out politics-swiper-button-prev rtl:order-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    viewBox="0 0 20 20" fill="none">
                                    <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="#ffffff" />
                                </svg>
                            </button>
                            <button type="button" id="section-next-btn"
                                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out politics-swiper-button-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                                        fill="#ffffff" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Slider section -->
                    @include ('themes.classic.components.slider.politics-news-slider')

                </section>
            @endif

            <!-- banner section -->
            <figure class="2xl:w-5/6 mx-auto 2xl:pt-8 hidden 4xl:block">
                @if ($ad = get_advertisements(1, 5))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                        alt="" />
                @endif
            </figure>
        </section>

        <!-- Right section news -->
        <section>
            <!-- Follow us (Social Section) -->
            @if ($followUsLinks)
                @include('themes.classic.components.common.follow-us')
            @endif


            <!-- Recommended Posts -->
            @if ($recommendedPosts->isNotEmpty())
                @include('themes.classic.components.common.recommended-post')
            @endif

            <!-- Ads section -->
            <figure class="">
                @if ($ad = get_advertisements(1, 4))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}"
                        alt="" />
                @endif
            </figure>

            <!-- Top Week -->
            @if ($topWeekNews->isNotEmpty())
                <section class="my-4 space-y-3 md:border dark:border-neutral-800 md:p-2 md:rounded-md">
                    <h2 class="@if (!$themeSettings->background_color || mode()) bg-neutral-900 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase mb-2"
                        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif">
                        {{ localize('top_week') }}</h2>
                    <a href="{{ __url($topWeekNews[0]->encode_title) }}" class="bg_gradient_top block h-[289px]">
                        <img class="w-full h-full object-cover"
                            src="{{ isset($topWeekNews[0]->photoLibrary->image_base_url) ? $topWeekNews[0]->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                            alt="{{ $topWeekNews[0]->image_alt }}" />

                        <div class="p-2 2xl:p-3 absolute z-10 bottom-0 left-0">
                            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right"
                                {!! bgColorStyle($topWeekNews[0]->category->color_code) !!}>
                                {{ $topWeekNews[0]->category->category_name }}
                            </div>
                            <h1 class="text-white font-bold text-xl my-2">
                                {{ $topWeekNews[0]->title }}
                            </h1>
                            <div class="text-white capitalize flex items-center gap-1 text-xs">
                                <span>{{ $topWeekNews[0]->postByUser->full_name ?? localize('unknown') }}</span>
                                <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                </svg>
                                <span>{{ news_publish_date_format($topWeekNews[0]->publish_date) }}</span>
                                <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                </svg>
                                <span>{{ $topWeekNews[0]->comments_count }}</span>
                            </div>
                        </div>
                    </a>

                    <!-- Posts -->
                    @if ($topWeekNews->slice(1)->isNotEmpty())
                        @foreach ($topWeekNews->slice(1) as $topWeekNewsItem)
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <figure class="w-full h-20">
                                    <img class="w-full h-full object-cover"
                                        src="{{ isset($topWeekNewsItem->photoLibrary->image_base_url) ? $topWeekNewsItem->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                                        alt="{{ $topWeekNewsItem->image_alt }}" />
                                </figure>
                                <a href="{{ __url($topWeekNewsItem->encode_title) }}"
                                    class="col-span-2 line-clamp-3 text-neutral-600 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary">
                                    {{ $topWeekNewsItem->title }}
                                </a>
                            </div>
                        @endforeach
                    @endif

                </section>
            @endif
        </section>
    </section>

    <div class="container">
        <figure class="w-5/6 mx-auto 4xl:hidden">
            @if ($ad = get_advertisements(1, 5))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </div>
    <!-- Rendom News (right side news sticky) End -->

    <!-- STORIES NEWS SECTION START -->
    @if ($homeStories->isNotEmpty())
        @include('themes.classic.components.home.stories-news')
    @endif

    <!-- Video News section -->
    @if ($videoNews->isNotEmpty())
        @include('themes.classic.components.home.video-news')
    @endif

    <!-- Opinion Section Start -->
    <section class="container grid grid-cols-1 xl:grid-cols-4 gap-4 md:gap-8 py-6">
        <!-- Left Section -->
        @if ($opinions->isNotEmpty())
            @include ('themes.classic.components.slider.opinion-slider')
        @endif

        <!-- FEATURES NEWS (Right Section) -->
        @if (!empty($featuresNews))
            @include ('themes.classic.components.home.features-news')
        @endif

    </section>

    <!-- TECH NEWS START -->
    <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-4 py-6">
        <!-- Tech News Slider Section -->
        @if ($sectionFiveNews['firstNews']->isNotEmpty())
            @include ('themes.classic.components.slider.tech-news-slider')
        @endif

        <!-- Food News Slider Section -->
        @if ($sectionFiveNews['secondNews']->isNotEmpty())
            @include ('themes.classic.components.slider.food-news-slider')
        @endif

        <!-- Binodon News Slider Section -->
        @if ($sectionFiveNews['thirdNews']->isNotEmpty())
            @include ('themes.classic.components.slider.binodon-news-slider')
        @endif

        <!-- Lifestyle News Slider Section -->
        @if ($sectionFiveNews['fourthNews']->isNotEmpty())
            @include ('themes.classic.components.slider.lifestyle-news-slider')
        @endif

    </section>
    <!-- TECH NEWS END -->

    <!-- BUSINESS NEWS -->
    @if ($sectionSixNews->isNotEmpty())
        @include ('themes.classic.components.home.business-news')
    @endif

    <!-- Common NEWS -->
    @if (!empty($commonSectionNews))
        @foreach ($commonSectionNews as $commonSectionNewsList)
            @include ('themes.classic.components.home.common-news', $commonSectionNewsList)
        @endforeach
    @endif

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.classic.components.common.rss-feed-news.rss-feeds')
    @endif

    <input type="hidden" name="section-four-ajax-url" id="section-four-ajax-url"
        value="{{ route('ajax.section-four-news') }}">
    <input type="hidden" name="section-five-first-ajax-url" id="section-five-first-ajax-url"
        value="{{ route('ajax.section-five-first-news') }}">
    <input type="hidden" name="section-five-second-ajax-url" id="section-five-second-ajax-url"
        value="{{ route('ajax.section-five-second-news') }}">
    <input type="hidden" name="section-five-third-ajax-url" id="section-five-third-ajax-url"
        value="{{ route('ajax.section-five-third-news') }}">
    <input type="hidden" name="section-five-fourth-ajax-url" id="section-five-fourth-ajax-url"
        value="{{ route('ajax.section-five-fourth-news') }}">

</x-web-layout>
