<section class="md:border dark:border-neutral-800 md:p-2 md:rounded-md">
    <div class="flex justify-between items-center gap-2 mb-4">
        <h1 class="text-neutral-700 dark:text-white text-lg font-semibold uppercase">
            {{ $sectionFiveNews['fourthNews'][0]->category->category_name }}
        </h1>
        <!-- Slider Next/Preview Button -->
        <div class="flex items-center gap-2">
            <button type="button"
                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out lifestyle-news-prev rtl:order-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 20 20" fill="none">
                    <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="#ffffff" />
                </svg>
            </button>
            <button type="button"
                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out lifestyle-news-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 20 20" fill="none">
                    <path
                        d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                        fill="#ffffff" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Slider Section -->
    <div class="swiper w-full h-full LifestyleNewsSwiper">

        <!-- Loader Slide - already in DOM -->
        <div id="sec-five-fourth-loader" class="flex justify-center items-center hidden">
            <div class="w-10 h-10 border-4 border-t-transparent border-blue-500 rounded-full animate-spin"></div>
        </div>

        <div class="swiper-wrapper" id="append-next-swiper-slide-sec-five-fourth">
            <!-- Slider 1 -->
            <div class="swiper-slide" id="swiper-slide-sec-five-fourth-1">
                <a href="{{ __url($sectionFiveNews['fourthNews'][0]->news->encode_title) }}" class="bg_gradient_top block">
                    <img class="w-full h-full object-cover"
                        src="{{ isset($sectionFiveNews['fourthNews'][0]->news->photoLibrary->image_base_url) ? $sectionFiveNews['fourthNews'][0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                        alt="{{ $sectionFiveNews['fourthNews'][0]->news->image_alt }}" />

                    <div class="p-2 2xl:p-3 absolute z-10 bottom-0 left-0">
                        <h1 class="text-white font-bold text-xl my-2 line-clamp-2">
                            {{ $sectionFiveNews['fourthNews'][0]->news->title }}
                        </h1>
                        <div class="text-white capitalize flex items-center gap-1 text-xs">
                            <span>{{ $sectionFiveNews['fourthNews'][0]->news->postByUser->full_name ?? localize('unknown') }}</span>
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            <span>{{ news_publish_date_format($sectionFiveNews['fourthNews'][0]->news->publish_date) }}</span>
                            <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg>
                            <span>{{ $sectionFiveNews['fourthNews'][0]->news->comments_count }}</span>
                        </div>
                    </div>
                </a>

                <div class="space-y-2 divide-y divide-neutral-200 dark:divide-neutral-700 mt-2">
                    <!-- bottom news list -->
                    @if ($sectionFiveNews['fourthNews']->slice(1)->isNotEmpty())

                        @foreach ($sectionFiveNews['fourthNews']->slice(1) as $secFiveFourthNewsList)
                            <a class="block pt-2" href="{{ __url($secFiveFourthNewsList->news->encode_title) }}">
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <figure class="w-full h-20">
                                        <img class="w-full h-full object-cover"
                                            src="{{ isset($secFiveFourthNewsList->news->photoLibrary->image_base_url) ? $secFiveFourthNewsList->news->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                                            alt="{{ $secFiveFourthNewsList->news->image_alt }}" />
                                    </figure>
                                    <h2
                                        class="col-span-2 line-clamp-3 text-neutral-600 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary">
                                        {{ $secFiveFourthNewsList->news->title }}
                                    </h2>
                                </div>
                            </a>
                        @endforeach
                    @endif

                </div>
            </div>

            <div class="swiper-slide" id="no-need-to-slide-sec-five-fourth">
            </div>

        </div>
    </div>
</section>
