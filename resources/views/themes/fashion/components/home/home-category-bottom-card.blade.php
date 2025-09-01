
  <div class="grid md:grid-cols-2 gap-4">
    @if (isset($secFiveThirdBottomNews))

        <div class="relative">
            <a
                href="{{ __url($secFiveThirdBottomNews->news->encode_title) }}"
                class="block w-full h-52 lg:h-80 xl:h-48 object-cover group overflow-hidden">
                <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src= "{{ isset($secFiveThirdBottomNews->news->photoLibrary->image_base_url) ? $secFiveThirdBottomNews->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                alt="{{ $secFiveThirdBottomNews->news->image_alt }}"
                />
            </a>
            <div class="py-3 space-y-2">
                <a
                href="{{ __url($secFiveThirdBottomNews->news->encode_title) }}"
                class="text-lg font-semibold text-theme-six-secondary dark:text-neutral-50 dark:hover:text-theme-six-primary hover:text-theme-six-primary leading-6 line-clamp-2 transition_3">
                    {{ $secFiveThirdBottomNews->news->title }}
                </a>
                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                    {{ clean_news_content($secFiveThirdBottomNews->news->news) }}
                </p>
            </div>

            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right absolute top-2 l"
                {!! bgColorStyle($secFiveThirdBottomNews->category->color_code) !!}>
                {{ $secFiveThirdBottomNews->category->category_name }}
            </div>
        </div>
            
    @endif

    @if (isset($secFiveFourthBottomNews))

        <div class="relative">
            <a
                href="{{ __url($secFiveFourthBottomNews->news->encode_title) }}"
                class="block w-full h-52 lg:h-80 xl:h-48 object-cover group overflow-hidden">
                <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src= "{{ isset($secFiveFourthBottomNews->news->photoLibrary->image_base_url) ? $secFiveFourthBottomNews->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                alt="{{ $secFiveFourthBottomNews->news->image_alt }}"
                />
            </a>
            <div class="py-3 space-y-2">
                <a
                href="{{ __url($secFiveFourthBottomNews->news->encode_title) }}"
                class="text-lg font-semibold text-theme-six-secondary dark:text-neutral-50 dark:hover:text-theme-six-primary hover:text-theme-six-primary leading-6 line-clamp-2 transition_3">
                    {{ $secFiveFourthBottomNews->news->title }}
                </a>
                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                    {{ clean_news_content($secFiveFourthBottomNews->news->news) }}
                </p>
            </div>

            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right absolute top-2 l"
                {!! bgColorStyle($secFiveFourthBottomNews->category->color_code) !!}>
                {{ $secFiveFourthBottomNews->category->category_name }}
            </div>
        </div>
            
    @endif
 
  </div>
