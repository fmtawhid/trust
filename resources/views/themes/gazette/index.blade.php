<x-web-layout>
    <!-- Section 1  -->
    @if ($homePageTopNews->isNotEmpty())
        @include('themes.gazette.components.home.top-category-news')
    @endif

    <!-- Section 2 (Tab category One) -->
    @if ($sectionTwoNews['leftNews']->isNotEmpty())
        @include('themes.gazette.components.home.tab-1.category-tab-one')
    @endif

    <!-- Section 3 (banner section) -->
    <section class="container my-8">
        <!-- banner section -->
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 1))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>

    <!-- Section 4 (Video Section) -->
    @if ($videoNews->isNotEmpty())
        <section class="bg-theme-five-tertiary py-6">
            <section class="container">
                <div class="mb-4 pb-1 border-b border-blue-900">
                    <a href="{{ __url('videos') }}"
                        class="text-white hover:text-cyan-500 text-lg font-semibold uppercase transition_3">{{ localize('video_news') }}</a>
                </div>
                
                @include('themes.gazette.components.home.video-news')
            </section>
        </section>
    @endif

    <!-- Section 5 (Tab category Two)  -->
    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 my-12">
        {{-- Left section --}}
        <section class="md:col-span-2 xl:col-span-3 gap-6">

            @if ($sectionTwoNews['rightNews']->isNotEmpty())
                @include('themes.gazette.components.home.tab-2.category-tab-two')
            @endif

            <!-- banner section -->
            <figure class="my-8">
                @if ($ad = get_advertisements(1, 3))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                        alt="" />
                @endif
            </figure>

            @if ($sectionThreeAllNews->isNotEmpty())
                @include('themes.gazette.components.home.tab-3.category-tab-three')
            @endif


        </section>

        {{-- Right section --}}
        <section class="space-y-4">
            @if ($latestNews->isNotEmpty())
                @include('themes.gazette.components.home.latest-news')
            @endif

            <!-- Follow us -->
            @if ($followUsLinks)
                @include('themes.gazette.components.common.follow-us')
            @endif

            {{-- Ads section --}}
            <figure class="">
                @if ($ad = get_advertisements(1, 2))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large-2.png') }}"
                        alt="" />
                @endif
            </figure>

            @if ($popularNews->isNotEmpty())
                @include('themes.gazette.components.home.popular-post')
            @endif
        </section>
    </section>

    <!-- Section 6 (STORIES NEWS SECTION) -->
    @if ($homeStories->isNotEmpty())
        @include('themes.gazette.components.home.stories-news')
    @endif


    <!-- Section 7 (banner section) -->
    <section class="container my-8">
        <!-- banner section -->
        <figure class="2xl:w-5/6 mx-auto">
            @if ($ad = get_advertisements(1, 4))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
            @endif
        </figure>
    </section>

    <!-- Section 8 (Tab category Four)  -->
    <section class="container grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 2xl:gap-6 pt-16 pb-20">
        {{-- Left section --}}
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            @if ($sectionFourNews->isNotEmpty())
                @include('themes.gazette.components.home.tab-4.category-tab-four')
            @endif

        </section>

        {{-- Right section --}}
        <section class="space-y-4">
            {{-- Ads section --}}
            <figure class="">
                @if ($ad = get_advertisements(1, 5))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-medium.png') }}" alt="" />
                @endif
            </figure>

            {{-- Ads section --}}
            <figure class="">
                @if ($ad = get_advertisements(1, 6))
                    {!! $ad->embed_code !!}
                @else
                    <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large-2.png') }}" alt="" />
                @endif
            </figure>
        </section>
    </section>


    <section class="mb-6">
        <!-- Section 9 grid card-4  -->
        @if ($sectionFiveNews['firstNews']->isNotEmpty())
            @include ('themes.gazette.components.home.common-news', [
                'commonNews' => $sectionFiveNews['firstNews'],
            ])
        @endif

        @if ($sectionFiveNews['secondNews']->isNotEmpty())
            @include ('themes.gazette.components.home.common-news', [
                'commonNews' => $sectionFiveNews['secondNews'],
            ])
        @endif

        @if ($sectionFiveNews['thirdNews']->isNotEmpty())
            @include ('themes.gazette.components.home.common-news', [
                'commonNews' => $sectionFiveNews['thirdNews'],
            ])
        @endif

        @if ($sectionFiveNews['fourthNews']->isNotEmpty())
            @include ('themes.gazette.components.home.common-news', [
                'commonNews' => $sectionFiveNews['fourthNews'],
            ])
        @endif

        @if ($sectionSixNews->isNotEmpty())
            @include ('themes.gazette.components.home.common-news', ['commonNews' => $sectionSixNews])
        @endif

        @if (!empty($commonSectionNews))
            @foreach ($commonSectionNews as $commonSectionNewsList)
                @include ('themes.gazette.components.home.common-news', [
                    'commonNews' => $commonSectionNewsList,
                ])
            @endforeach
        @endif
    </section>

    <!-- RSS Feed News -->
    @if (!empty($rssFeedNews))
        @include('themes.gazette.components.common.rss-feed-news.rss-feeds')
    @endif

</x-web-layout>
