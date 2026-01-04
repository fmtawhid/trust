<section class="container my-6">
    <div
        class="mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-theme-five-primary dark:before:bg-white before:z-10 before:-bottom-[3px] before:w-20">
        <a href="{{ __url($commonNews[0]->category->slug) }}" 
            class="text-theme-five-primary dark:text-white text-lg font-semibold uppercase hover:text-brand-primary">
            {{ $commonNews[0]->category->category_name }}
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 py-4 gap-4 xl:gap-6">
        @foreach ($commonNews as $commonNewsItem)
            <div class="overflow-hidden">
                <a href="{{ __url($commonNewsItem->news->encode_title) }}" class="w-full h-48 md:h-32 lg:h-48 group overflow-hidden block">
                    <img 
                        class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                        src="{{ isset($commonNewsItem->news->photoLibrary->image_base_url) ? $commonNewsItem->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                        alt="{{ $commonNewsItem->news->image_alt }}" />
                </a>
                <div class="p-2 space-y-2">
                    <div class="line-clamp-2">
                        <a href="{{ __url($commonNewsItem->news->encode_title) }}"
                            class="text-theme-six-secondary dark:text-white dark:hover:text-theme-six-primary font-bold text-lg leading-6 transition_3 hover:text-theme-six-primary">
                            {{ $commonNewsItem->news->title }}
                        </a>
                    </div>

                    <div class="text-neutral-500 capitalize flex items-center gap-2 text-sm">
                        <span>{{ $commonNewsItem->news->postByUser->full_name ?? localize('unknown') }}</span>
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($commonNewsItem->news->publish_date) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
