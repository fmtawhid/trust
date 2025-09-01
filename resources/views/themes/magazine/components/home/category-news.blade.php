<section class="bg-white dark:bg-neutral-900 dark:border-neutral-700 border rounded-md p-3">
    <a 
        href="{{ __url($ctgNewsSections[0]->category->slug) }}" 
        class="text-lg font-bold text-theme-three dark:text-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-500 transition_3 mb-3 inline-block">
        {{ $ctgNewsSections[0]->category->category_name }}
    </a>
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="border-b dark:border-neutral-700 md:border-none pb-2 md:pb-0">
            <a 
                href="{{ __url($ctgNewsSections[0]->news->encode_title) }}" 
                class="block w-full h-52 md:h-40 group overflow-hidden">
                <img 
                    class="w-full h-full object-cover group-hover:scale-105 transition_slow" 
                    src="{{ isset($ctgNewsSections[0]->news->photoLibrary->image_base_url) ? $ctgNewsSections[0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                    alt="{{ $ctgNewsSections[0]->news->image_alt }}" />
            </a>
            <div class="p-2 space-y-3">
                <a 
                    href="{{ __url($ctgNewsSections[0]->news->encode_title) }}" 
                    class="text-lg font-bold line-clamp-2 text-theme-three dark:text-sky-600 hover:text-cyan-500 dark:hover:text-cyan-500 transition_3">
                    {{ $ctgNewsSections[0]->news->title }}
                </a>
                <p class="text-sm line-clamp-2 dark:text-white">
                    {{ clean_news_content($ctgNewsSections[0]->news->news) }}
                </p>
                <p class="text-xs text-theme-three dark:text-cyan-500">
                    {{ news_publish_date_format($ctgNewsSections[0]->news->publish_date) }}
                </p>
            </div>
        </div>

        <div class="divide-y dark:divide-neutral-700">
            @foreach ($ctgNewsSections->slice(1) as $ctgNewsSectionsItem)
                <div class="py-4 first:pt-0">
                    <a 
                        href="{{ __url($ctgNewsSectionsItem->news->encode_title) }}" 
                        class="text-base dark:text-white hover:text-cyan-600 dark:hover:text-cyan-500 transition_3 line-clamp-2">
                        {{ $ctgNewsSectionsItem->news->title }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
