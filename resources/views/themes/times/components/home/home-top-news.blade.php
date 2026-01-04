<section
  class="container grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 my-6">
  {{-- Left section --}}
  <div class="order-2 md:order-1 xl:order-1">
    <h1
      class="text-blue-600 pb-2 text-xl uppercase font-bold border-b dark:border-b-neutral-600 mb-3">
      {{ $homePageTopNews[0]->category->category_name }}
    </h1>

    <div class="h-36">
      <a
        href="{{ __url($homePageTopNews[0]->news->encode_title) }}"
        class="text-theme-three dark:text-neutral-50 hover:text-blue-600 dark:hover:text-blue-600 text-2xl font-bold transition_3 line-clamp-4">
        {{ $homePageTopNews[0]->news->title }}
      </a>
    </div>
    <div
      class="capitalize dark:text-neutral-200 flex items-center gap-1 text-xs mt-3">
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
    <p
      class="text-base text-neutral-600 dark:text-neutral-400 capitalize line-clamp-4 mt-5">
      {{ clean_news_content($homePageTopNews[0]->news->news) }}
    </p>
  </div>

  {{-- Middle section --}}
  <div class="md:col-span-2 order-1 md:order-3 xl:order-2">
    <a
      href="{{ __url($homePageTopNews[0]->news->encode_title) }}"
      class="block group overflow-hidden w-full h-[380px] object-cover">
      <img
        class="w-full h-full object-cover group-hover:scale-105 transition_slow"
        src="{{ isset($homePageTopNews[0]->news->photoLibrary->large_image) ? asset('storage/'.$homePageTopNews[0]->news->photoLibrary->large_image) : asset('/assets/news-details-view.png') }}"
        alt="{{ $homePageTopNews[0]->news->image_alt }}"
      />
    </a>
  </div>

  {{-- Right section --}}
  <div class="divide-y space-y-4 order-3 md:order-2 xl:order-3">
    @if (!empty($homePageTopNews[1]))
      <div>
        <a
          href="{{ __url($homePageTopNews[1]->news->encode_title) }}"
          class="block group overflow-hidden w-full h-[200px] object-cover">
          <img
            class="w-full h-full object-cover group-hover:scale-105 transition_slow"
            src="{{ isset($homePageTopNews[1]->news->photoLibrary->image_base_url) ? $homePageTopNews[1]->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
            alt="{{ $homePageTopNews[1]->news->image_alt }}"/>
        </a>
        <p
          class="text-sm text-neutral-600 dark:text-neutral-400 capitalize line-clamp-2 mt-3">
          {{ clean_news_content($homePageTopNews[1]->news->news) }}
        </p>
      </div>
    @endif
    
    @if (!empty($homePageTopNews[2]))
      <div class="grid grid-cols-3 gap-4 items-center pt-4">
        <figure class="w-full h-24 objext-cover rounded-lg overflow-hidden">
          <img
            class="w-full h-full object-cover"
            src="{{ isset($homePageTopNews[2]->news->photoLibrary->image_base_url) ? $homePageTopNews[2]->news->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
            alt="{{ $homePageTopNews[2]->news->image_alt }}"
          />
        </figure>
        <div class="col-span-2">
          <h1 class="uppercase text-blue-600 font-bold mb-2">{{ $homePageTopNews[2]->category->category_name }}</h1>
          <a
            href="{{ __url($homePageTopNews[2]->news->encode_title) }}"
            class="font-medium text-theme-three hover:text-blue-600 dark:hover:text-blue-600 dark:text-gray-200 leading-5 line-clamp-3 transition_3">
            {{ clean_news_content($homePageTopNews[2]->news->news) }}
          </a>
        </div>
      </div>
    @endif

  </div>
</section>
