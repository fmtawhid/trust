<x-web-layout>

    @if ($homePageTopNews->slice(3)->isNotEmpty())
        @include('themes.news.components.home.top-category-news')
    @endif

    <section class="container my-6">
        @if ($homePageTopNews->count() > 3)
            @include('themes.news.components.common.card-category')
        @endif
    </section>

    <!-- banner section -->
    <section class="container">
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 3))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>

    <!-- STORIES NEWS SECTION START -->
    @if ($homeStories->isNotEmpty())
        @include('themes.news.components.home.stories-news')
    @endif

    <section class="container my-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section -->
        <div class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- SPORTS CATAGORY NEWS -->
            @if ($sectionThreeAllNews->isNotEmpty())
                @include('themes.news.components.home.category-tab-news')
            @endif
        </div>
        <!-- Right section -->
        <div>
            <!-- Recommended Posts -->
            @if ($recommendedPosts->isNotEmpty())
                @include('themes.news.components.common.recommended-post')
            @endif
        </div>
    </section>

    <!-- banner section -->
    <section class="container my-8">
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 4))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>

    <!-- Opinion Section Start -->
    <section class="container grid grid-cols-1 xl:grid-cols-6 2xl:grid-cols-4 gap-8 my-6">
        <!-- Left Section -->
        <section class="xl:col-span-4 2xl:col-span-3 space-y-8">
            <div>
                @if ($opinions->isNotEmpty())
                    <h1 class="text-brand-primary text-lg font-semibold uppercase">
                        {{ localize('opinion') }}
                    </h1>
                    @include ('themes.news.components.slider.opinion-slider', ['opinions' => $opinions])
                @endif
            </div>
            
            <div>
                @if ($sectionTwoNews['leftNews']->isNotEmpty())
                    <div class="flex justify-between gap-2 items-center mb-3 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700">
                        <h1 class="text-brand-primary text-lg font-semibold uppercase">
                            {{ $sectionTwoNews['leftNews'][0]->category->category_name }}
                        </h1>
                        <a href="{{ __url($sectionTwoNews['leftNews'][0]->category->slug) }}" class="capitalize text-neutral-400 hover:text-cyan-700 hover:underline transition_3">
                            {{ localize('view_more') }}
                        </a>
                    </div>
                    @include('themes.news.components.common.list-news',['sectionTwoNews' => $sectionTwoNews['leftNews']])
                @endif
            </div>
        </section>

        <!-- Follow us (Social Section) -->
        <section class="xl:col-span-2 2xl:col-auto lg:mt-12 space-y-6">
            @if ($followUsLinks)
                @include('themes.news.components.common.follow-us')
            @endif

            @if ($trendingNews->isNotEmpty())
                @include ('themes.news.components.common.trending-post')
            @endif
        </section>
    </section>

    {{-- Video Section --}}
    @if ($videoNews->isNotEmpty())
        <section class="bg-neutral-100 dark:bg-neutral-800 py-6">
            <section class="container">
                <div
                    class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700">
                    <a href="{{ __url('videos') }}" 
                        class="text-brand-primary text-lg font-semibold uppercase">
                        {{ localize('video_news') }}
                    </a>
                    
                    <!-- Slider Next/Preview Button -->
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            class="swiper_button_prev video-swiper-button-prev rtl:order-2">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z"
                                fill="#ffffff"/>
                            </svg>
                        </button>
                        <button
                            type="button"
                            class="swiper_button_next video-swiper-button-next">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                                fill="#ffffff"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Slider section -->
                
                @include('themes.news.components.home.video-news')
                
            </section>
        </section>
    @endif

    <!-- banner section -->
    <section class="container my-8">
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 5))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>

    <!-- TECH NEWS START -->
    <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-0 mt-8">
        <!-- Tech News Slider Section -->
        @if ($sectionTwoNews['rightNews']->isNotEmpty())
            @include('themes.news.components.common.tech-news-card',['newsCards' => $sectionTwoNews['rightNews']])
        @endif

        <!-- Food News Slider Section -->
        @if ($sectionFourNews->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionFourNews->take(5)])
        @endif

        <!-- Binodon News Slider Section -->
        @if ($sectionFiveNews['firstNews']->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionFiveNews['firstNews']])
        @endif

        <!-- Lifestyle News Slider Section -->
        @if ($sectionFiveNews['secondNews']->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionFiveNews['secondNews']])
        @endif
    </section>

    <div class="container md:px-10">
        <hr>
    </div>

    <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-0 mt-8">
        <!-- Tech News Slider Section -->
        @if ($sectionFiveNews['thirdNews']->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionFiveNews['thirdNews']])
        @endif

         <!-- Food News Slider Section -->
        @if ($sectionFiveNews['fourthNews']->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionFiveNews['fourthNews']])
        @endif

        <!-- Binodon News Slider Section -->
        @if ($sectionSixNews->isNotEmpty())
            @include ('themes.news.components.common.tech-news-card', ['newsCards' => $sectionSixNews])
        @endif

        <!-- Lifestyle News Slider Section -->
        @php
            $firstNewsGroup = reset($commonSectionNews); // First value
            $restNewsGroups = array_slice($commonSectionNews, 1); // All except first
            $chunkedNewsGroups = array_chunk($restNewsGroups, 4, true); // group every 4 items
        @endphp

        @if ($firstNewsGroup && $firstNewsGroup->isNotEmpty())
            @include('themes.news.components.common.tech-news-card', ['newsCards' => $firstNewsGroup])
        @endif
    </section>

    <!-- banner section -->
    <section class="container">
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 6))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>
    
    <!-- common section -->
    @foreach ($chunkedNewsGroups as $newsGroupChunk)
        <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-0 mt-8">
            @foreach ($newsGroupChunk as $newsCards)
                @if ($newsCards->isNotEmpty())
                    @include('themes.news.components.common.tech-news-card', ['newsCards' => $newsCards])
                @endif
            @endforeach
        </section>
    @endforeach

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.news.components.common.rss-feed-news.rss-feeds')
    @endif

</x-web-layout>
