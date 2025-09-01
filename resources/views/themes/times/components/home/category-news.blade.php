<section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8 border-b dark:border-neutral-700 pb-6">
    @if ($sectionFourNews->isNotEmpty())
        <section class="col-span-2">
            <a 
                href="{{ __url($sectionFourNews[0]->category->slug) }}" 
                class="text-blue-600 dark:text-white uppercase text-lg md:text-xl font-bold mb-4 block">
                {{ $sectionFourNews[0]->category->category_name }}
            </a>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Section -->
                <section class="space-y-4">
                    @foreach ($sectionFourNews->slice(0, 2) as $sectionFourFirstItem)
                        <div class="overflow-hidden">
                            <a href="{{ __url($sectionFourFirstItem->news->encode_title) }}" class="w-full h-48 block">
                                <img class="w-full h-full object-cover" 
                                    src="{{ isset($sectionFourFirstItem->news->photoLibrary->image_base_url) ? $sectionFourFirstItem->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $sectionFourFirstItem->news->image_alt }}" />
                            </a>
                            <div class="space-y-2 py-4">
                                <a href="{{ __url($sectionFourFirstItem->news->encode_title) }}"
                                    class="line-clamp-2 text-neutral-800 dark:text-white dark:hover:text-blue-600 font-semibold text-lg leading-6 transition_3 hover:text-blue-600">
                                    {{ $sectionFourFirstItem->news->title }}
                                </a>

                                <p class="text-sm line-clamp-2 text-neutral-700 dark:text-neutral-400">
                                    {{ clean_news_content($sectionFourFirstItem->news->news) }}
                                </p>
                                <p class="text-neutral-500 text-sm">{{ news_publish_date_format($sectionFourFirstItem->news->publish_date) }}</p>
                            </div>
                        </div>
                    @endforeach
                </section>

                {{-- Middle section --}}
                <section class="space-y-4 md:space-y-8">
                    <div class="space-y-3 ">
                        @foreach ($sectionFourNews->slice(2, 4) as $sectionFourSecondItem)
                            <div class="h-16">
                                <a href="{{ __url($sectionFourSecondItem->news->encode_title) }}"
                                    class="hover:text-blue-600 dark:hover:text-blue-600 dark:text-gray-200 leading-5 line-clamp-2 transition_3">
                                    {{ $sectionFourSecondItem->news->title }}
                                </a>
                            </div>
                            <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700" />
                        @endforeach
                    </div>

                    @if (!empty($sectionFourNews[6]))
                        <div class="overflow-hidden">
                            <a 
                                href="{{ __url($sectionFourNews[6]->news->encode_title) }}" 
                                class="w-full h-48 group overflow-hidden block">
                                <img class="w-full h-full object-cover" 
                                    src="{{ isset($sectionFourNews[6]->news->photoLibrary->image_base_url) ? $sectionFourNews[6]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $sectionFourNews[6]->news->image_alt }}" />
                            </a>
                            <div class="py-2 space-y-2">
                                <a href="{{ __url($sectionFourNews[6]->news->encode_title) }}"
                                    class="line-clamp-2 text-neutral-800 dark:text-white dark:hover:text-blue-600 font-semibold text-lg leading-6 transition_3 hover:text-blue-600">
                                    {{ $sectionFourNews[6]->news->title }}
                                </a>

                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ $sectionFourNews[6]->news->postByUser->full_name ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($sectionFourNews[6]->news->publish_date) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </section>

            </div>
        </section>
    @endif

    <!-- Right News section -->
    @if ($sectionFiveNews['firstNews']->isNotEmpty())
        <section class="md:col-span-2 xl:col-auto">
            <a 
                href="{{ __url($sectionFiveNews['firstNews'][0]->category->slug) }}" 
                class="text-blue-600 dark:text-white uppercase text-lg md:text-xl font-bold mb-4 block">
                {{ $sectionFiveNews['firstNews'][0]->category->category_name }}
            </a>

            <div
                class="md:flex gap-4  xl:flex-col xl:gap-0  space-y-4 md:space-y-0 xl:space-y-4">
                <div class="space-y-4">
                    <div class="overflow-hidden">
                        <a 
                            href="{{ __url($sectionFiveNews['firstNews'][0]->news->encode_title) }}" class="w-full h-48 group overflow-hidden block">
                            <img class="w-full h-full object-cover" 
                                src="{{ isset($sectionFiveNews['firstNews'][0]->news->photoLibrary->image_base_url) ? $sectionFiveNews['firstNews'][0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                alt="{{ $sectionFiveNews['firstNews'][0]->news->image_alt }}" />
                        </a>
                        <div class="p-2 space-y-2">
                            <a href="{{ __url($sectionFiveNews['firstNews'][0]->news->encode_title) }}"
                                class="line-clamp-2 text-neutral-800 dark:text-white dark:hover:text-blue-600 font-semibold text-lg leading-6 transition_3 hover:text-blue-600">
                                {{ $sectionFiveNews['firstNews'][0]->news->title }}
                            </a>

                            <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                <span>{{ $sectionFiveNews['firstNews'][0]->news->postByUser->full_name ?? localize('unknown') }}</span>
                                <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                </svg>
                                <span>{{ news_publish_date_format($sectionFiveNews['firstNews'][0]->news->publish_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!empty($sectionFiveNews['firstNews']->slice(1)))
                    <div class="space-y-3">
                        @foreach ($sectionFiveNews['firstNews']->slice(1) as $secFiveFirstNewsItem)
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <figure class="w-full h-20 md:h-24 lg:h-28 xl:h-[70px] objext-cover">
                                    <img class="w-full h-full object-cover" 
                                        src="{{ isset($secFiveFirstNewsItem->news->photoLibrary->image_base_url) ? $secFiveFirstNewsItem->news->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                                        alt="{{ $secFiveFirstNewsItem->news->image_alt }}" />
                                </figure>
                                <a href="{{ __url($secFiveFirstNewsItem->news->encode_title) }}"
                                    class="col-span-2 text-sm font-medium text-neutral-800 hover:text-blue-600 dark:hover:text-blue-600 dark:text-gray-200 leading-5 line-clamp-3 transition_3">
                                    {{ $secFiveFirstNewsItem->news->title }}
                                </a>
                            </div>
                            <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700" />
                        @endforeach
                    </div>
                @endif
                
            </div>
        </section>
    @endif
</section>
