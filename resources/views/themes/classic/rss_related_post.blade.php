<section class="lg:col-span-3 mt-6">
    <div
        class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-20">
        <h1 class="text-brand-primary text-lg font-semibold uppercase">
            {{ $relatedNews['feed_name'] }}
        </h1>
        <a href="{{ __url( $relatedNews['slug']) }}"
            class="capitalize text-neutral-400 hover:text-brand-primary hover:underline transition_3">
            {{ localize('view_more') }}
        </a>
    </div>

    <!-- Card section -->
    <section class="md:col-span-2 xl:col-span-3 gap-6">

        <!-- Card View -->
        <div class="block">
            <div data-content="card_view" class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- cart -->
                @if (!empty($relatedNews['news']))
                    @foreach (collect($relatedNews['news'])->take(9) as $item)
                        <div class="">
                            <a href="{{ __url($item['encode_title']) }}"
                                class="block w-full h-42 md:h-[150px] 2xl:h-40 4xl:h-52 group overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                    src="{{ isset($item['image']) ? $item['image'] : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $item['title'] }}" />
                            </a>
                            <div class="py-3 space-y-2">
                                <a href="{{ __url($item['encode_title']) }}"
                                    class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $item['title'] }}
                                </a>
                                <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                                    {{ $item['description'] }}
                                </p>
                                <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                    <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- add section -->
        <figure class="mt-6 mb-6">
            @if ($ad = get_advertisements(3, 3))
                {!! $ad->embed_code !!}
            @else
                <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}"
                    alt="" />
            @endif
        </figure>

    </section>
    
</section>
