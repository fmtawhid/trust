<div class="divide-y dark:divide-neutral-700 md:border-r dark:border-neutral-700 md:pr-3 xl:last:border-r-0 xl:last:pr-0 mb-6 xl:mb-0">
    <!-- Center Column (Item 0 as big image + headline) -->
    <div>
        @if ($allTabData->first())
            <a href="{{ __url($allTabData->first()->news->encode_title) }}"
                class="block w-full h-60 group overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                    src="{{ isset($allTabData->first()->news->photoLibrary->image_base_url) ? $allTabData->first()->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                    alt="{{ $allTabData->first()->news->image_alt }}" />
            </a>
            <div class="space-y-3 py-3">
                <a href="{{ __url($allTabData->first()->news->encode_title) }}"
                    class="line-clamp-2 leading-6 text-gray-900 dark:text-white hover:text-theme-five-primary dark:hover:text-cyan-500 font-bold text-lg transition_3">
                    {{ $allTabData->first()->news->title }}
                </a>
                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                    <span>{{ $allTabData->first()->news->postByUser->full_name ?? localize('unknown') }}</span>
                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                    </svg>
                    <span>{{ news_publish_date_format($allTabData->first()->news->publish_date) }}</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Center Column (Items 1–4) -->
    <div class="grid gap-3 pt-3">
        @if ($allTabData->slice(1)->isNotEmpty())
            @foreach ($allTabData->slice(1) as $tabData)
                <div class="grid grid-cols-3 gap-2 items-center">
                    <a href="{{ __url($tabData->news->encode_title) }}">
                        <figure class="w-full h-20">
                            <img class="w-full h-full object-cover"
                                src="{{ isset($tabData->news->photoLibrary->image_base_url) ? $tabData->news->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                                alt="{{ $tabData->news->image_alt }}" />
                        </figure>
                    </a>

                    <div class="col-span-2 space-y-2">
                        <a href="{{ __url($tabData->news->encode_title) }}"
                            class="line-clamp-2 text-neutral-800 hover:text-theme-five-primary transition_3 dark:text-neutral-50 dark:hover:text-cyan-500">
                            {{ $tabData->news->title }}
                        </a>

                        <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                            <span>{{ $tabData->news->postByUser->full_name ?? localize('unknown') }}</span>
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            <span>{{ news_publish_date_format($tabData->news->publish_date) }}</span>
                        </div>
                    </div>

                </div>

                <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700" />
            @endforeach
        @endif

    </div>
</div>
