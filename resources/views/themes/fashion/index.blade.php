<x-web-layout>
    <!-- Top Category News (section 2) -->
    @if ($homePageTopNews->isNotEmpty())
        @include('themes.fashion.components.home.top-category-news')
    @endif

    <!-- Category News (section 3) -->
    <div class="container my-12 grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">

        @if ($sectionTwoNews['leftNews']->isNotEmpty())
            @include('themes.fashion.components.home.category-news', ['categoryNews' => $sectionTwoNews['leftNews']])
        @endif

        @if ($sectionTwoNews['rightNews']->isNotEmpty())
            @include('themes.fashion.components.home.category-news', ['categoryNews' => $sectionTwoNews['rightNews']])
        @endif

        @if ($sectionThreeAllNews->isNotEmpty())
            @include('themes.fashion.components.home.category-news', ['categoryNews' => $sectionThreeAllNews])
        @endif

        @if ($sectionFourNews->isNotEmpty())
            @include('themes.fashion.components.home.category-news', ['categoryNews' => $sectionFourNews])
        @endif

    </div>

    <!-- banner section -->
    <section class="container my-6">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 1))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- CELEBRITY STYLE (section 4) -->
    @if ($sectionFiveNews['firstNews']->isNotEmpty())
        @include('themes.fashion.components.home.fashion-news', ['cards' => $sectionFiveNews['firstNews']])
    @endif


    <!-- Category Fashion (section--5) -->
    <section class="container grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-4 mt-14 lg:mt-4">
        <!-- Left Section -->
        <section class="space-y-4 order-2 xl:order-1 md:col-span-2 xl:col-auto">
            @if ($popularNews->isNotEmpty())
                @include('themes.fashion.components.home.popular-news', ['popularNews' => $popularNews])
            @endif

            {{-- Ads section --}}
            <figure class="w-full h-[400px] lg:h-[500px] xl:h-[300px] 2xl:h-[350px] object-cover">
                @if ($ad = get_advertisements(1, 2))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-2.png') }}" alt="" />
                @endif
            </figure>

            <!-- Opinion slider -->
            @if ($opinions->isNotEmpty())
                @include ('themes.fashion.components.slider.opinion-slider', ['opinions' => $opinions])
            @endif
        </section>


        <!-- Middle Section -->
        <section class="md:col-span-4 xl:col-span-2 order-1 xl:order-2">
            <div
                class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm">

                @if ($sectionFiveNews['secondNews']->isNotEmpty())
                    @include('themes.fashion.components.home.home-category-top', [
                        'secFiveSecondTopNews' => $sectionFiveNews['secondNews'][0],
                    ])
                @endif

                @php
                    $secFiveSecondMiddleNews = $sectionFiveNews['secondNews']->slice(1, 4);
                    $secFiveThirdBottomNews = $sectionFiveNews['thirdNews']->first();
                    $secFiveFourthBottomNews = $sectionFiveNews['fourthNews']->first();
                @endphp

                @if ($secFiveSecondMiddleNews->isNotEmpty())
                    @include('themes.fashion.components.home.home-category-middle-list', [
                        'secFiveSecondMiddleNews' => $secFiveSecondMiddleNews,
                    ])
                @endif

                @if ($sectionFiveNews['thirdNews']->isNotEmpty() || $sectionFiveNews['fourthNews']->isNotEmpty())
                    @include('themes.fashion.components.home.home-category-bottom-card', [
                        'secFiveThirdBottomNews' => $secFiveThirdBottomNews,
                        'secFiveFourthBottomNews' => $secFiveFourthBottomNews,
                    ])
                @endif
            </div>
        </section>

        <!-- Right News section -->
        <section class="order-3 space-y-4 md:col-span-2 xl:col-auto">

            @if ($latestNews->isNotEmpty())
                @include('themes.fashion.components.home.latest-news', ['latestNews' => $latestNews])
            @endif

            @if ($recommendedPosts->isNotEmpty())
                @include('themes.fashion.components.home.editors-pics', ['recommendedPosts' => $recommendedPosts])
            @endif
        </section>

    </section>

    <!-- banner section -->
    <section class="container my-6">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 3))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- Wedding section 6 -->
    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 my-12">
        {{-- Left section --}}
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            @if ($sectionSixNews->isNotEmpty())
                @include('themes.fashion.components.home.card-view-news', [
                    'sectionSixNews' => $sectionSixNews
                ])
            @endif
        </section>

        {{-- Right section --}}
        <section class="space-y-4">
            <!-- Ads section -->
            <figure class="">
                @if ($ad = get_advertisements(1, 4))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large-2.png') }}" alt="" />
                @endif
            </figure>
            <!-- Follow us -->
            @if ($followUsLinks)
                @include('themes.fashion.components.common.follow-us')
            @endif

            {{-- Ads section --}}
            <figure class="">
                @if ($ad = get_advertisements(1, 5))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-2.png') }}" alt="" />
                @endif
            </figure>
        </section>
    </section>

    <!-- banner section -->
    <section class="container my-6">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 6))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- Common NEWS -->
    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 mb-12">
        <section class="md:col-span-3 xl:col-span-4 gap-6">
            @if (!empty($commonSectionNews))
                @foreach ($commonSectionNews as $commonSectionNewsList)
                    @include('themes.fashion.components.home.common-news', [
                        'sectionSixNews' => $commonSectionNewsList
                    ])
                @endforeach
            @endif
        </section>
    </section>

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.fashion.components.common.rss-feed-news.rss-feeds')
    @endif

</x-web-layout>
