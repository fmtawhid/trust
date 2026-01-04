<section class="md:border dark:border-neutral-800 md:p-2 md:rounded-md">
    <h2 class="font-semibold text-lg @if (!$themeSettings->background_color || mode()) bg-neutral-700 @endif @if (mode()) dark:bg-neutral-800 @endif @if (!$themeSettings->text_color || mode()) text-white @endif px-1 uppercase mb-2"
        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif">
        {{ localize('trending') }}
    </h2>
    <a href="{{ __url($trendingNews[0]->encode_title) }}" class="h-60 md:h-96 lg:h-60 object-cover block">
        <img class="w-full h-full object-cover"
            src="{{ isset($trendingNews[0]->photoLibrary->image_base_url) ? $trendingNews[0]->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
            alt="{{ $trendingNews[0]->image_alt }}" />
    </a>
    <div class="space-y-2 mt-2">
        <a href="{{ __url($trendingNews[0]->encode_title) }}"
            class="col-span-2 text-xl text-neutral-800 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary line-clamp-2">
            {{ $trendingNews[0]->title }}
        </a>
        <p class="text-sm text-neutral-500 line-clamp-2">
            {{ clean_news_content($trendingNews[0]->news) }}
        </p>
        <div class="text-neutral-500 capitalize flex items-center gap-1 text-xs">
            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
            </svg>
            <span>{{ news_publish_date_format($trendingNews[0]->publish_date) }}</span>
        </div>
    </div>

    <section class="space-y-3 mt-3">
        <!-- Posts -->
        @foreach ($trendingNews->slice(1) as $trendingNewsItem)
            <div class="grid grid-cols-3 gap-2 items-center">
                <figure class="w-full h-20 md:h-32 lg:h-20 objext-cover">
                    <img class="w-full h-full object-cover"
                        src="{{ isset($trendingNewsItem->photoLibrary->image_base_url) ? $trendingNewsItem->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                        alt="{{ $trendingNewsItem->image_alt }}" />
                </figure>
                <a href="{{ __url($trendingNewsItem->encode_title) }}"
                    class="col-span-2 line-clamp-3 text-neutral-600 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary">
                    {{ $trendingNewsItem->title }}
                </a>
            </div>
        @endforeach
    </section>
</section>
