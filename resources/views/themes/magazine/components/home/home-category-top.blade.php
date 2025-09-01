<div
  class="border-b dark:border-neutral-700">
  <a
    href="{{ __url($homePageTopNews[0]->news->encode_title) }}"
    class="block group overflow-hidden w-full h-52 md:h-96 lg:h-96 xl:h-[350px] 2xl:h-[400px] object-cover">
    <img
      class="w-full h-full object-cover group-hover:scale-105 transition_slow"
      src="{{ isset($homePageTopNews[0]->news->photoLibrary->large_image) ? asset('storage/'.$homePageTopNews[0]->news->photoLibrary->large_image) : asset('/assets/news-details-view.png') }}"
      alt="{{ $homePageTopNews[0]->news->image_alt }}"
    />
  </a>
  <div class="py-4 space-y-2">
    <div
      class="h-7 pl-3 pr-6 text-white uppercase flex justify-center items-center clip-hex-right"
      {!! bgColorStyle($homePageTopNews[0]->category->color_code) !!}>
      {{ $homePageTopNews[0]->category->category_name }}
    </div>
    <a
      href="{{ __url($homePageTopNews[0]->news->encode_title) }}"
      class="text-theme-three dark:text-cyan-500 hover:text-cyan-600 text-2xl lg:text-3xl font-bold my-2 transition_3 line-clamp-2">
      {{ $homePageTopNews[0]->news->title }}
    </a>
    <p
      class="text-sm text-neutral-600 dark:text-neutral-400 capitalize line-clamp-2">
      {{ clean_news_content($homePageTopNews[0]->news->news) }}
    </p>
    <div
      class="capitalize dark:text-neutral-200 flex items-center gap-1 text-xs">
      <svg
        width="12"
        height="12"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512">
        <path
          fill="currentColor"
          d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"
        />
      </svg>
      <span>{{ news_publish_date_format($homePageTopNews[0]->news->publish_date) }}</span>
    </div>
  </div>
</div>

