
  <div class="grid md:grid-cols-2 gap-4">
    @if ($sectionTwoNews['leftNews'])
        <div class="relative">
            <a
                href="{{ __url($sectionTwoNews['leftNews'][0]->news->encode_title) }}"
                class="block w-full h-52 lg:h-80 xl:h-48 object-cover group overflow-hidden">
                <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src="{{ isset($sectionTwoNews['leftNews'][0]->news->photoLibrary->image_base_url) ? $sectionTwoNews['leftNews'][0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                alt="{{ $sectionTwoNews['leftNews'][0]->news->image_alt }}"
                />
            </a>
            <div class="py-3 space-y-2">
                <a
                href="{{ __url($sectionTwoNews['leftNews'][0]->news->encode_title) }}"
                class="text-lg font-semibold text-theme-three hover:text-cyan-600 dark:hover:text-cyan-600 dark:text-gray-200 leading-6 line-clamp-2 transition_3">
                    {{ $sectionTwoNews['leftNews'][0]->news->title }}
                </a>
                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                    {{ clean_news_content($sectionTwoNews['leftNews'][0]->news->news) }}
                </p>
            </div>

            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right absolute top-2 l"
                {!! bgColorStyle($sectionTwoNews['leftNews'][0]->category->color_code) !!}>
                {{ $sectionTwoNews['leftNews'][0]->category->category_name }}
            </div>
        </div>
    @endif

    @if ($sectionTwoNews['rightNews'])
        <div class="relative">
            <a
                href="{{ __url($sectionTwoNews['rightNews'][0]->news->encode_title) }}"
                class="block w-full h-52 lg:h-80 xl:h-48 object-cover group overflow-hidden">
                <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src="{{ isset($sectionTwoNews['rightNews'][0]->news->photoLibrary->image_base_url) ? $sectionTwoNews['rightNews'][0]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                alt="{{ $sectionTwoNews['rightNews'][0]->news->image_alt }}"
                />
            </a>
            <div class="py-3 space-y-2">
                <a
                href="{{ __url($sectionTwoNews['rightNews'][0]->news->encode_title) }}"
                class="text-lg font-semibold text-theme-three hover:text-cyan-600 dark:hover:text-cyan-600 dark:text-gray-200 leading-6 line-clamp-2 transition_3">
                    {{ $sectionTwoNews['rightNews'][0]->news->title }}
                </a>
                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                    {{ clean_news_content($sectionTwoNews['rightNews'][0]->news->news) }}
                </p>
            </div>

            <div class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right absolute top-2 l"
                {!! bgColorStyle($sectionTwoNews['rightNews'][0]->category->color_code) !!}>
                {{ $sectionTwoNews['rightNews'][0]->category->category_name }}
            </div>
        </div>
    @endif
</div>

