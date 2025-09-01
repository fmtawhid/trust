<x-web-layout>
    <!-- section 1 -->
    @if ($homePageTopNews->slice(3)->isNotEmpty())
        <section class="container mt-4 lg:my-4">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 p-4 bg-neutral-100 dark:bg-neutral-900 border border-red-300 dark:border-red-800">
                @include('themes.times.components.home.home-top-category', ['topCategoryData' => $homePageTopNews->slice(3)])
            </div>
        </section>
    @endif
    <!-- section 2 -->
    @if ($homePageTopNews->isNotEmpty())
        @include('themes.times.components.home.home-top-news')
    @endif


    <!-- section 3 -->
    @if ($sectionTwoNews['leftNews']->isNotEmpty())
        @include('themes.times.components.home.related-news', ['sectionCardNews'=> $sectionTwoNews['leftNews']])
    @endif

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

    <!-- section 4 -->
    @if ($sectionTwoNews['rightNews']->isNotEmpty())
        <section class="container my-6">
            <div class="p-4 bg-neutral-100 dark:bg-neutral-900">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-blue-600 dark:text-white uppercase text-lg md:text-xl font-bold">
                        {{ $sectionTwoNews['rightNews'][0]->category->category_name }}
                    </h2>
                    <a
                        href="{{ __url($sectionTwoNews['rightNews'][0]->category->slug) }}"
                        class="capitalize text-blue-400 hover:text-blue-600 transition_3 border rounded-full px-3 py-1.5 hover:border-blue-500">
                        {{ localize('view_more') }}
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @include('themes.times.components.home.home-top-category', ['topCategoryData' => $sectionTwoNews['rightNews']])
                </div>
            </div>
        </section>
    @endif

    <!-- section 5 -->
    @if ($sectionThreeAllNews->isNotEmpty())
        @include('themes.times.components.home.related-news', ['sectionCardNews'=> $sectionThreeAllNews])
    @endif

    <!-- banner section -->
    <section class="container my-6">
        <picture class="2xl:w-5/6 mx-auto block">
            @if ($ad = get_advertisements(1, 2))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </picture>
    </section>

    <!-- section 6/7/8 -->
    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 my-2">
        {{-- Left section --}}
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            @include('themes.times.components.home.category-news')

            <!-- banner section -->
            <section class="my-6">
                <picture class="block">
                    @if ($ad = get_advertisements(1, 4))
                        {!! $ad->embed_code !!}
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
                    @endif
                </picture>
            </section>

            {{-- List view news --}}
            @if ($sectionFiveNews['secondNews']->isNotEmpty())
                @include ('themes.times.components.home.list-view-news')
            @endif

            {{-- card view news --}}
            @if ($sectionFiveNews['thirdNews']->isNotEmpty())
                @include('themes.times.components.home.card-view-news',['cardViewNews' => $sectionFiveNews['thirdNews']])
            @endif

        </section>


        {{-- Right section --}}
        <section class="space-y-4">
            <!-- Ads section -->
            <figure class="">
                @if ($ad = get_advertisements(1, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large-2.png') }}" alt="" />
                @endif
            </figure>

            <!-- Follow us -->
            @if ($followUsLinks)
                @include('themes.times.components.common.follow-us')
            @endif

            @include ('themes.times.components.common.recommended-top-week-post')

            {{-- Ads section --}}
             <figure class="">
                @if ($ad = get_advertisements(1, 5))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-2.png') }}" alt="" />
                @endif
            </figure>

            <!-- Ads section -->
            <figure class="">
                @if ($ad = get_advertisements(1, 6))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large.png') }}" alt="" />
                @endif
            </figure>

            <!-- Ads section -->
            <figure class="">
                @if ($ad = get_advertisements(1, 7))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}" alt="" />
                @endif
            </figure>
        </section>
    </section>

    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 mb-4">
        <section class="md:col-span-3 xl:col-span-4 gap-6">
            @if ($sectionFiveNews['fourthNews']->isNotEmpty())
                @include('themes.times.components.home.common-card-view-news',['cardViewNews' => $sectionFiveNews['fourthNews']])
            @endif

            @if ($sectionSixNews->isNotEmpty())
                @include('themes.times.components.home.common-card-view-news',['cardViewNews' => $sectionSixNews])
            @endif

            <!-- Common NEWS -->
            @if (!empty($commonSectionNews))
                @foreach ($commonSectionNews as $commonSectionNewsList)
                    @include('themes.times.components.home.common-card-view-news',['cardViewNews' => $commonSectionNewsList])
                @endforeach
            @endif
        </section>
    </section>

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.times.components.common.rss-feed-news.rss-feeds')
    @endif

</x-web-layout>
