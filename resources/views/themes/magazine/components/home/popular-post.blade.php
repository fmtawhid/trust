<section class="border dark:border-neutral-800 p-2 rounded-md">
    <div class="@if (!$themeSettings->background_color || mode()) bg-neutral-700 @endif @if (mode()) dark:bg-neutral-800 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase font-medium"
        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif">
        {{ localize('popular_post') }}
    </div>

    <div class="divide-y divide-neutral-300 dark:divide-neutral-600 capitalize lg:col-span-3 xl:col-span-1">
        <!-- News Heading -->
        @foreach ($popularNews as $popularNewsItem)
            <div class="py-3 flex-1">
                <a href="{{ __url($popularNewsItem->encode_title) }}"
                    class="col-span-2 font-semibold text-theme-three hover:text-cyan-600 dark:hover:text-cyan-600 dark:text-gray-200 leading-5 line-clamp-3 transition_3">
                    {{ $popularNewsItem->title }}
                </a>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2 text-sm line-clamp-2">
                    {{ clean_news_content($popularNewsItem->news) }}
                </p>
            </div>
        @endforeach
    </div>
</section>
