@php
    $leftItem = collect($categoryNews)->first();
    $rightItems = collect($categoryNews)->slice(1, 4);
@endphp

<div>
    <a href="{{ __url($leftItem->category->slug) }}" class="text-theme-six-primary uppercase text-lg md:text-xl font-bold mb-4 block">{{ $leftItem->category->category_name }}</a>

    <section class="grid grid-cols-2 gap-4 xl:gap-8 border-b dark:border-neutral-700 pb-2">
        <!-- Left Section (Only First Item) -->
        <div class="overflow-hidden">
            @if ($leftItem)
                <a href="{{ __url($leftItem->news->encode_title) }}" class="w-full h-48 block group">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition_slow" 
                    src="{{ isset($leftItem->news->photoLibrary->image_base_url) ? $leftItem->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                    alt="{{ $leftItem->news->image_alt }}" />
                </a>

                <div class="space-y-2 py-4">
                    <a href="{{ __url($leftItem->news->encode_title) }}"
                        class="line-clamp-2 text-neutral-800 dark:text-white dark:hover:text-theme-six-primary font-semibold text-lg leading-6 transition_3 hover:text-theme-six-primary">
                        {{ $leftItem->news->title }}
                    </a>

                    <a href="{{ __url($leftItem->news->encode_title) }}" class="text-sm line-clamp-2 text-neutral-700 dark:text-neutral-400">
                        {{ clean_news_content($leftItem->news->news) }}
                    </a>

                    <p class="text-neutral-500 text-sm">{{ news_publish_date_format($leftItem->news->publish_date) }}</p>
                </div>
            @endif
        </div>

        <!-- Right Section (Remaining Items) -->
        <div class="space-y-3">
            @foreach ($rightItems as $item)
                <div class="h-16">
                    <a href="{{ __url($item->news->encode_title) }}"
                        class="hover:text-theme-six-primary dark:hover:text-theme-six-primary dark:text-gray-200 leading-5 line-clamp-2 transition_3">
                        {{ $item->news->title }}
                    </a>
                </div>
                <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700" />
            @endforeach
        </div>
    </section>
</div>
