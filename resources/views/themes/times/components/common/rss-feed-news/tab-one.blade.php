<section data-content="{{ $rssTabData['slug'] }}" class="global_tab_pane opacity-100 translate-y-0 transition-all duration-500 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    @foreach (collect($rssTabData['news'])->take(8) as $item)

        <div class="">
            <a href="{{ __url($item['encode_title']) }}"
                class="block w-full h-64 group overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                    src="{{ isset($item['image']) ? $item['image'] : asset('/assets/news-card-view.png') }}"
                    alt="{{ $item['title'] }}" />
            </a>
            <div class="space-y-2 divide-y divide-neutral-200 dark:divide-neutral-700">
                <div class="py-2 space-y-2">
                    <a href="{{ __url($item['encode_title']) }}"
                        class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                        {{ $item['title']}}
                    </a>
                    <p class="text-sm line-clamp-3 dark:text-neutral-400">
                        {{ $item['description'] }}
                    </p>
                    <div class="text-neutral-500 capitalize flex items-center gap-1 text-xs">
                        <span>{{ $item['author'] ?? localize('unknown') }}</span>
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</section>
