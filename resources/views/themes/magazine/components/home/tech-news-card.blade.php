<section class="border dark:border-neutral-700 pb-4">
    <a href="{{ __url($cardNewsSections[0]->category->slug) }}"
        class="px-4 inline-block text-neutral-700 dark:text-white text-lg font-semibold uppercase my-3">
        {{ $cardNewsSections[0]->category->category_name }}
    </a>

    <!-- Card Section -->
    <div class="px-4">
        <a 
            href="{{ __url($cardNewsSections[0]->news->encode_title) }}" 
            class="block">
            <img
                class="w-full h-72 object-cover"
                src="{{ isset($cardNewsSections[0]->news->photoLibrary->image_base_url) ? $cardNewsSections[0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                alt="{{ $cardNewsSections[0]->news->image_alt }}"
            />
        </a>
        <div class="py-3 border-b space-y-3">
            <a href="{{ __url($cardNewsSections[0]->news->encode_title) }}" 
                class="font-bold text-xl text-theme-three hover:text-cyan-600 transition_3 dark:text-neutral-50 dark:hover:text-cyan-500 line-clamp-2 leading-7">
                {{ $cardNewsSections[0]->news->title }}
            </a>
            <p class="text-sm line-clamp-2 dark:text-neutral-300">
                {{ clean_news_content($cardNewsSections[0]->news->news) }}
            </p>
        </div>

        <!-- bottom news list -->
        @foreach ($cardNewsSections->slice(1) as $cardNewsSectionsItem)
            <div class="h-[86px] my-4">
                <a href="{{ __url($cardNewsSectionsItem->news->encode_title) }}" 
                    class="text-lg font-bold line-clamp-3 text-neutral-800 hover:text-cyan-600 transition_3 dark:text-neutral-50 dark:hover:text-cyan-500">
                    {{ $cardNewsSectionsItem->news->title }}
                </a>
            </div>
            <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700"/>
        @endforeach
    </div>
</section>
