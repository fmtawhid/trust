<section class="container my-6">
    <!-- section head -->
    <div
        class="flex flex-col md:flex-row justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative md:before:absolute md:before:left-0 rtl:md:before:left-auto rtl:md:before:right-0 md:before:h-1 md:before:bg-brand-primary md:before:z-10 md:before:-bottom-[3px] md:before:w-20">
        <h1 class="text-neutral-700 dark:text-white text-lg font-semibold uppercase">
            {{ localize('rss_feed_news') }}
        </h1>

        <!-- Tab button section -->
        <ul id="tabs" class="flex gap-4 md:gap-6 text-base text-neutral-500 cursor-pointer">
            @foreach ($rssFeedNews as $data)
                <li class="global_tab @if ($loop->first) {{ 'global_tab global_nav_link' }} @endif" data-tab="{{ $data['slug'] }}">{{ $data['feed_name'] }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Tab Content section -->
    <div id="tab-content" class="relative mt-6">
        @foreach ($rssFeedNews as $rssFeedNewsData)
            @if ($loop->first)
                @include('themes.magazine.components.common.rss-feed-news.tab-one', [
                    'rssTabData' => $rssFeedNewsData,
                ])
            @else
                @include('themes.magazine.components.common.rss-feed-news.tab-news', [
                    'rssTabData' => $rssFeedNewsData,
                ])
            @endif
        @endforeach
    </div>

</section>
