
<section class="grid md:grid-cols-2 gap-4 md:gap-6 my-6">
    @foreach ($secFiveSecondMiddleNews as $secFiveSecondMiddleNewsItem)
        <div class="space-y-2 md:border-b dark:border-neutral-700 md:pb-4">
            <a
                href="{{ __url($secFiveSecondMiddleNewsItem->news->encode_title) }}"
                class="text-lg font-semibold text-theme-six-secondary dark:text-neutral-50 dark:hover:text-theme-six-primary hover:text-theme-six-primary leading-6 line-clamp-2 transition_3">
                {{ $secFiveSecondMiddleNewsItem->news->title }}
            </a>
            <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                {{ clean_news_content($secFiveSecondMiddleNewsItem->news->news) }}
            </p>
        </div>
        <hr class="h-px bg-neutral-200 border-0 dark:bg-neutral-700 md:hidden"/>
    @endforeach
</section>
