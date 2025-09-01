<section class="bg-neutral-950 py-10 md:py-16">
    <div class="container">
        <div
            class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
            <h1 class="text-brand-primary text-lg font-semibold uppercase">
                {{ localize('video_news') }}
            </h1>

            <a href="{{ __url('videos') }}"
                class="capitalize text-neutral-400 hover:text-brand-primary hover:underline transition_3">
                {{ localize('view_more') }}
            </a>
        </div>

        <div class="grid lg:grid-cols-2 gap-4">
            <!-- Left Section -->
            @php
                $latestVideoNews = $videoNews->first();
            @endphp
            <div>
                <div class="relative group bg-cyan-300 h-[75%]">
                    <!-- Play button -->
                    <a href="{{ __url($latestVideoNews->encode_title) }}"
                        class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                        <span
                            class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <a href="{{ __url($latestVideoNews->encode_title) }}" class="bg_gradient_top">
                        <img class="w-full h-full object-cover"
                            src="{{ get_image_url('/assets/news-details-view.png', $latestVideoNews->thumbnail_image) }}"
                            alt="{{ $latestVideoNews->image_alt }}" />
                    </a>
                    <div class="mt-6">
                        <a href="{{ __url($latestVideoNews->encode_title) }}"
                            class="text-white hover:text-brand-primary text-2xl lg:text-3.5xl my-2 transition_3 line-clamp-3">
                            {{ $latestVideoNews->title }}
                        </a>
                        <div class="text-sm text-white capitalize flex items-center gap-2 mt-4">
                            <span>{{ views_format($latestVideoNews->total_view) }}&nbsp;{{ localize('view') }}</span>
                            <span>{{ $latestVideoNews->postByUser->full_name ?? localize('unknown') }}</span>
                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            <span>{{ news_publish_date_format($latestVideoNews->publish_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Card Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Card -->

                @foreach ($videoNews->skip(1) as $latestToVideoNews)
                    <div>
                        <div class="relative group">
                            <a href="{{ __url($latestToVideoNews->encode_title) }}"
                                class="w-full h-64 overflow-hidden flex justify-center items-center">
                                <img class="w-full h-full object-cover transition_5"
                                    src="{{ get_image_url('/assets/thumbnail-image.jpg', $latestToVideoNews->thumbnail_image) }}"
                                    alt="{{ $latestToVideoNews->image_alt }}" />
                                <!-- Play button -->
                                <a href="{{ __url($latestToVideoNews->encode_title) }}"
                                    class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                    <span
                                        class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </a>
                        </div>
                        <div class="p-2 space-y-2">
                            <div class="line-clamp-2">
                                <a href="{{ __url($latestToVideoNews->encode_title) }}"
                                    class="block text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
                                    {{ $latestToVideoNews->title }}
                                </a>
                            </div>
                            <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                <span>{{ views_format($latestToVideoNews->total_view) }}&nbsp;{{ localize('view') }}</span>
                                <span>{{ $latestToVideoNews->postByUser->full_name ?? localize('unknown') }}</span>
                                <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                </svg>
                                <span>{{ news_publish_date_format($latestToVideoNews->publish_date) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
