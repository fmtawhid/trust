<div class="grid md:grid-cols-2 xl:grid-cols-2 gap-6 2xl:gap-8">
    
    @foreach ($allTabData as $tabData)
        <!-- cart 1 -->
        <div class="">
            <a href="{{ __url($tabData->news->encode_title) }}" class="block w-full h-48 xl:h-64 3xl:h-72 group overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                    src="{{ isset($tabData->news->photoLibrary->image_base_url) ? $tabData->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                    alt="{{ $tabData->news->image_alt }}" />
            </a>
            <div class="py-3 space-y-2">
                <a href="{{ __url($tabData->news->encode_title) }}"
                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-theme-six-primary dark:hover:text-theme-six-primary font-bold text-lg leading-6 transition_3">
                    {{ $tabData->news->title }}
                </a>
                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                    {{ clean_news_content($tabData->news->news) }}
                </p>
                <div class="text-neutral-500 capitalize flex items-center gap-2 text-sm">
                    <span>{{ $tabData->news->postByUser->full_name ?? localize('unknown') }}</span>
                    <!-- calendar SVG -->
                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                    </svg>
                    <span>{{ news_publish_date_format($tabData->news->publish_date) }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
