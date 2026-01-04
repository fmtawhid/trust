<div class="grid items-center grid-cols-4 gap-4">
                            
  <div class="relative group">
    <a href="{{ __url($news->encode_title) }}"
      class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
      <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
        src="{{ get_image_url('/assets/thumbnail-image.jpg', $news->thumbnail_image) }}"
        alt="{{ $news->image_alt }}" />

      <!-- Play button -->
      <a href="{{ __url($news->encode_title) }}"
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

  <div class="col-span-3 space-y-2">
    <a href="{{ __url($news->encode_title) }}"
      class="line-clamp-2 text-gray-600 dark:text-white hover:text-brand-primary dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3">
      {{ $news->title }}
    </a>

    <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
      <span>{{ views_format($news->total_view) }}&nbsp;{{ localize('view') }}</span>
      <span>{{ $news->postByUser->full_name ?? localize('unknown') }}</span>
      <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512">
        <path fill="currentColor"
          d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
      </svg>
      <span>{{ news_publish_date_format($news->publish_date) }}</span>
    </div>
    <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-400">
      {{ clean_news_content($news->details) }}
    </p>
  </div>
</div>