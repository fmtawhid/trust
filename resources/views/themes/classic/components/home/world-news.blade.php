<!-- World News Section -->
<section class="container grid md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

    <!-- Left Section -->
    <section class="order-2 xl:order-1 col-span-2 md:col-span-1 lg:col-span-2 xl:col-auto">
        @if ($sectionTwoNews['leftNews']->isNotEmpty())
            <div class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:border-neutral-800">
                <a href="{{ __url($sectionTwoNews['leftNews'][0]->news->encode_title) }}" class="bg_gradient_top block">
                    <img class="w-full h-[220px] object-cover"
                        src="{{ isset($sectionTwoNews['leftNews'][0]->news->photoLibrary->image_base_url) ? $sectionTwoNews['leftNews'][0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                        alt="{{ $sectionTwoNews['leftNews'][0]->news->image_alt }}" />
                    <div class="p-2 2xl:p-3 absolute z-10 bottom-0 left-0">
                        <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right"
                            {!! bgColorStyle($sectionTwoNews['leftNews'][0]->category->color_code) !!}>
                            {{ $sectionTwoNews['leftNews'][0]->category->category_name }}
                        </div>
                        <h1 class="text-white font-bold text-base line-clamp-2 leading-5 my-2">
                            {{ $sectionTwoNews['leftNews'][0]->news->title }}
                        </h1>
                        <div class="text-white capitalize flex items-center gap-1 text-xs">
                            <span>{{ $sectionTwoNews['leftNews'][0]->news->postByUser->full_name ?? localize('unknown') }}</span>
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            <span>{{ news_publish_date_format($sectionTwoNews['leftNews'][0]->news->publish_date) }}</span>
                            <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg>
                            <span>{{ $sectionTwoNews['leftNews'][0]->news->comments_count }}</span>
                        </div>
                    </div>
                </a>

                @if ($sectionTwoNews['leftNews']->slice(1)->isNotEmpty())
                    <div class="divide-y divide-neutral-300 dark:divide-neutral-700 capitalize none">
                        <!-- News Heading 1 -->
                        @foreach ($sectionTwoNews['leftNews']->slice(1) as $sectionTwoLeftNews)
                            <div class="py-3 flex-1">
                                <a href="{{ __url($sectionTwoLeftNews->news->encode_title) }}"
                                    class="text-neutral-800 text-lg font-bold line-clamp-2 dark:text-neutral-50 dark:hover:text-red-300 hover:text-brand-primary transition_3">
                                    {{ $sectionTwoLeftNews->news->title }}
                                </a>
                                <p class="text-neutral-600 dark:text-neutral-400 mt-2 text-sm line-clamp-2">
                                    {{ clean_news_content($sectionTwoLeftNews->news->news) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </section>

    <!-- Middle Section -->
    <section class="order-1 col-span-2 xl:order-2 lg:col-span-4 xl:col-span-2">
        @if ($sectionTwoNews['rightNews']->isNotEmpty())
            <div
                class="flex justify-between gap-2 items-center mb-3 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700">
                <h1 class="text-brand-primary text-lg font-semibold uppercase">
                    {{ $sectionTwoNews['rightNews'][0]->category->category_name }}
                </h1>
                <a href="{{ __url($sectionTwoNews['rightNews'][0]->category->slug) }}"
                    class="capitalize text-neutral-400 hover:text-brand-primary hover:underline transition_3">
                    {{ localize('view_more') }}
                </a>
            </div>

            <div class="flex flex-col lg:flex-row xl:flex-col gap-2">
                <a href="{{ __url($sectionTwoNews['rightNews'][0]->news->encode_title) }}"
                    class="bg_gradient_top block w-full h-[300px] md:h-[460px] lg:h-[470px] xl:h-[430px] object-cover">
                    <img class="w-full h-full object-cover"
                        src="{{ isset($sectionTwoNews['rightNews'][0]->news->photoLibrary->large_image) ? asset('storage/'.$sectionTwoNews['rightNews'][0]->news->photoLibrary->large_image) : asset('/assets/news-details-view.png') }}"
                        alt="{{ $sectionTwoNews['rightNews'][0]->news->image_alt }}" />

                    <div class="p-4 md:p-5 absolute z-10 bottom-0 left-0">
                        @if ($sectionTwoNews['rightNews'][0]->subCategory)
                            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right"
                                {!! bgColorStyle($sectionTwoNews['rightNews'][0]->subCategory->color_code) !!}>
                                {{ $sectionTwoNews['rightNews'][0]->subCategory->category_name }}
                            </div>
                        @endif

                        <h1 class="text-white text-2xl md:text-3.5xl my-2 line-clamp-2">
                            {{ $sectionTwoNews['rightNews'][0]->news->title }}
                        </h1>
                        <div class="text-white capitalize flex items-center gap-1 text-xs">
                            <span>{{ $sectionTwoNews['rightNews'][0]->news->postByUser->full_name ?? localize('unknown') }}</span>
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            <span>{{ news_publish_date_format($sectionTwoNews['rightNews'][0]->news->publish_date) }}</span>
                            <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg>
                            <span>{{ $sectionTwoNews['rightNews'][0]->news->comments_count }}</span>
                        </div>
                    </div>
                </a>

                @if ($sectionTwoNews['rightNews']->slice(1)->isNotEmpty())
                    <div class="flex lg:flex-col xl:flex-row gap-2">

                        @foreach ($sectionTwoNews['rightNews']->slice(1) as $sectionTwoRightNews)
                            <a href="{{ __url($sectionTwoRightNews->news->encode_title) }}"
                                class="bg_gradient_top w-full h-[200px] md:h-[300px] lg:h-full 2xl:h-[275px] object-cover block">
                                <img class="w-full h-full object-cover"
                                    src="{{ isset($sectionTwoRightNews->news->photoLibrary->image_base_url) ? $sectionTwoRightNews->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $sectionTwoRightNews->news->image_alt }}" />

                                <div class="p-2 md:p-3 absolute z-10 bottom-0 left-0">
                                    @if ($sectionTwoRightNews->subCategory)
                                        <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right"
                                            {!! bgColorStyle($sectionTwoRightNews->subCategory->color_code) !!}>
                                            {{ $sectionTwoRightNews->subCategory->category_name }}
                                        </div>
                                    @endif

                                    <h1 class="text-white font-bold text-sm md:text-xl line-clamp-2 my-2">
                                        {{ $sectionTwoRightNews->news->title }}
                                    </h1>
                                    <div class="text-white capitalize flex items-center gap-1 text-xs">
                                        <span>{{ $sectionTwoRightNews->news->postByUser->full_name ?? localize('unknown') }}</span>
                                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                        </svg>
                                        <span>{{ news_publish_date_format($sectionTwoRightNews->news->publish_date) }}</span>
                                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                        </svg>
                                        <span>{{ $sectionTwoRightNews->news->comments_count }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </section>

    <!-- Right News section -->
    <section class="order-3 col-span-2 md:col-span-1 lg:col-span-2 xl:col-auto">
        @if ($popularNews->isNotEmpty())
            @include('themes.classic.components.common.popular-post')
        @endif
    </section>
</section>
