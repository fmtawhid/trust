<div
  class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-0 lg:divide-x dark:divide-neutral-600 rtl:divide-x-reverse border-y dark:border-y-neutral-600 py-4">
  <!-- Card -->
  @foreach ($homePageTopNews->slice(3, 3) as $topBottomNews)
      
    <div class="overflow-hidden lg:px-3">
      <a href="{{ __url($topBottomNews->news->encode_title) }}" class="w-full h-52 group overflow-hidden block">
        <img
          class="w-full h-full object-cover group-hover:scale-105 transition_7"
          src="{{ isset($topBottomNews->news->photoLibrary->image_base_url) ? $topBottomNews->news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
          alt="{{ $topBottomNews->news->image_alt }}"
        />
      </a>

      <div class="p-2 space-y-2">
        <a
          href="{{ __url($topBottomNews->news->encode_title) }}"
          class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary line-clamp-2">
          {{ $topBottomNews->news->title }}
        </a>
        <p
          class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-3">
          {{ clean_news_content($topBottomNews->news->news) }}
        </p>
      </div>
    </div>
 @endforeach

  <!-- Card-4 Ad -->
  <div class="overflow-hidden lg:px-3">
    @if ($ad = get_advertisements(1, 2))
      {!! $ad->embed_code !!}
    @else
      <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-2.png') }}" alt="" />
    @endif
  </div>
</div>
