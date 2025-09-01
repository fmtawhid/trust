<section class="border dark:border-neutral-800 p-2 rounded-md">
    <div class="@if (!$themeSettings->background_color || mode()) bg-neutral-900 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase mb-2"
        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif"">
        {{ localize('popular_post') }}
    </div>

    <div class="divide-y divide-neutral-300 dark:divide-neutral-600 capitalize lg:col-span-3 xl:col-span-1">
        <!-- News Heading -->
        @foreach ($popularNews as $popularNewsItem)
            <div class="py-3 flex-1">
                <a href="{{ __url($popularNewsItem->encode_title) }}"
                    class="text-neutral-800 text-lg font-bold line-clamp-2 dark:text-neutral-50 dark:hover:text-red-300 hover:text-brand-primary transition_3">
                    {{ $popularNewsItem->title }}
                </a>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2 text-sm line-clamp-2">
                    {{ clean_news_content($popularNewsItem->news) }}
                </p>
            </div>
        @endforeach
    </div>
</section>
