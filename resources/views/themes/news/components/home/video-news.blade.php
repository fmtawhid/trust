<!-- Video News Swiper -->
<div
  class="swiper w-full h-full VideoNesSwiper border-b dark:border-b-neutral-600 pb-4">
  <div
    class="swiper-wrapper md:divide-x md:dark:divide-neutral-600 rtl:divide-x-reverse">
    
    @foreach($videoNews as $videoNewsItem)
      <div class="swiper-slide md:px-3">
        <!-- Card-1 -->
        <div class="overflow-hidden">
          <figure class="relative w-full h-56 group overflow-hidden block">
            <a href="{{ __url($videoNewsItem->encode_title) }}" class="">
              <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src="{{ get_image_url('/assets/thumbnail-image.jpg', $videoNewsItem->thumbnail_image) }}"
                alt="{{ $videoNewsItem->image_alt }}"
                loading="lazy"
              />
            </a>
            <!-- Play button -->
            <a
              href="{{ __url($videoNewsItem->encode_title) }}"
              aria-label="Play video"
              class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group"
            >
              <span class="sr-only">Play Video</span>
              <span
                class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"
              ></span>

              <svg
                width="20"
                height="22"
                viewBox="0 0 20 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                  fill="currentColor"
                />
              </svg>
            </a>
          </figure>

          <div class="p-2 space-y-2">
            <div class="line-clamp-2">
              <a
                href="{{ __url($videoNewsItem->encode_title) }}"
                class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary"
              >
                {{ $videoNewsItem->title }}
              </a>
            </div>

            <div
              class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
              <span>{{ views_format($videoNewsItem->total_view) }}&nbsp;{{ localize('view') }}</span>
              <span>{{ $videoNewsItem->postByUser->full_name ?? localize('unknown') }}</span>
              <svg
                width="12"
                height="12"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
              >
                <path
                  fill="currentColor"
                  d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"
                />
              </svg>
              <span>{{ news_publish_date_format($videoNewsItem->publish_date) }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
