<x-web-layout>
    <!-- Top Category News section -->
    <section class="container grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-4 mt-4">
        <!-- Left Section -->
        <section class="space-y-4 order-2 xl:order-1 md:col-span-2 xl:col-auto">
            @if ($breakingNews->isNotEmpty())
                @include('themes.magazine.components.home.timeline-news')
            @endif

            {{-- Ads section --}}
            <figure class="w-full h-[400px] lg:h-[500px] xl:h-[300px] 2xl:h-[350px] object-cover">
                @if ($ad = get_advertisements(1, 1))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-2.png') }}" alt="" />
                @endif
            </figure>

            <!-- Opinion slider -->
            @if ($opinions->isNotEmpty())
                @include ('themes.magazine.components.slider.opinion-slider')
            @endif
        </section>


        <!-- Middle Section -->
        <section class="md:col-span-4 xl:col-span-2 order-1 xl:order-2">
            <div class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm">
                @if ($homePageTopNews->isNotEmpty())
                    @include('themes.magazine.components.home.home-category-top')
                    @include('themes.magazine.components.home.home-category-middle-list')
                @endif

                @if ($sectionTwoNews['leftNews']->isNotEmpty() || $sectionTwoNews['rightNews']->isNotEmpty())
                    @include('themes.magazine.components.home.home-category-bottom-card')
                @endif
            </div>
        </section>

        <!-- Right News section -->
        <section class="order-3 space-y-4 md:col-span-2 xl:col-auto">
            @if ($latestNews->isNotEmpty())
                @include('themes.magazine.components.home.latest-news')
            @endif

            @if ($popularNews->isNotEmpty())
                @include('themes.magazine.components.home.popular-post')
            @endif
        </section>

    </section>


   <!-- banner section -->
    <section class="container my-8">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 2))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    {{-- Video Section --}}
    @if ($videoNews->isNotEmpty())
        <section class="bg-theme-three py-6">
            <section class="container">
                <div class="mb-4 pb-1 border-b border-sky-800">
                    <a href="{{ __url('videos') }}" class="text-white hover:text-cyan-500 text-lg font-semibold uppercase transition_3">{{ localize('video_news') }}</a>
                </div>
                
                @include('themes.magazine.components.home.video-news')
            </section>
        </section>
    @endif

    <!-- CATEGORY NEWS -->
    <section class="container grid grid-cols-1 lg:grid-cols-2 gap-4 xl:gap-8 my-8">
        @if ($sectionThreeAllNews->isNotEmpty())
            @include ('themes.magazine.components.home.category-news', ['ctgNewsSections' => $sectionThreeAllNews])
        @endif

        @if ($sectionFourNews->isNotEmpty())
            @include ('themes.magazine.components.home.category-news', ['ctgNewsSections' => $sectionFourNews])
        @endif

        @if ($sectionFiveNews['firstNews']->isNotEmpty())
            @include ('themes.magazine.components.home.category-news', ['ctgNewsSections' => $sectionFiveNews['firstNews']])
        @endif

        @if ($sectionFiveNews['secondNews']->isNotEmpty())
            @include ('themes.magazine.components.home.category-news', ['ctgNewsSections' => $sectionFiveNews['secondNews']])
        @endif
    </section>

    <!-- banner section -->
    <section class="container my-8">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 3))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- TECH NEWS START -->
    <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-0 my-8">
        <!-- Tech News Slider Section -->

        @if ($sectionFiveNews['thirdNews']->isNotEmpty())
            @include ('themes.magazine.components.home.tech-news-card', ['cardNewsSections' => $sectionFiveNews['thirdNews']])
        @endif

        @if ($sectionFiveNews['fourthNews']->isNotEmpty())
            @include ('themes.magazine.components.home.tech-news-card', ['cardNewsSections' => $sectionFiveNews['fourthNews']])
        @endif

        @if ($sectionSixNews->isNotEmpty())
            @include ('themes.magazine.components.home.tech-news-card', ['cardNewsSections' => $sectionSixNews])
        @endif

        @php
            $firstNewsGroup = reset($commonSectionNews); // First value
            $restNewsGroups = array_slice($commonSectionNews, 1); // All except first
        @endphp

        @if ($firstNewsGroup && $firstNewsGroup->isNotEmpty())
            @include ('themes.magazine.components.home.tech-news-card', ['cardNewsSections' => $firstNewsGroup])
        @endif
    </section>


    <!-- banner section -->
    <section class="container my-8">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 4))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- STORIES NEWS SECTION START -->
    @if ($homeStories->isNotEmpty())
        @include('themes.magazine.components.home.stories-news')
    @endif

    <!-- Common Section -->
    <section class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-0 my-8">
        @foreach ($restNewsGroups as $restNewsGroupItem)
            @if ($restNewsGroupItem->isNotEmpty())
                @include('themes.magazine.components.home.tech-news-card', ['cardNewsSections' => $restNewsGroupItem])
            @endif
        @endforeach
    </section>

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.magazine.components.common.rss-feed-news.rss-feeds')
    @endif

</x-web-layout>
