<section
  class="border dark:border-neutral-800 p-3 rounded-md bg-theme-six-quaternary dark:bg-neutral-800">
  <div
    class="text-theme-six-primary pb-2 text-lg uppercase font-bold border-b dark:border-b-neutral-600">
    {{ localize('latest_post') }}
  </div>

  <div class="space-y-3">
    @foreach ($latestNews as $latestNewsItem)
        <div class="grid grid-cols-3 gap-2 items-center first:pt-3">
            <a href="{{ __url($latestNewsItem->encode_title) }}" class="col-span-2 font-semibold text-theme-six-secondary   hover:text-theme-six-primary dark:text-neutral-50 dark:hover:text-theme-six-primary leading-5 line-clamp-3 transition_3"
            >
              {{ $latestNewsItem->title }}
            </a>

            <figure class="w-full h-20 md:h-24 lg:h-28 xl:h-20 objext-cover">
              <img
                class="w-full h-full object-cover"
                src="{{ isset($latestNewsItem->photoLibrary->image_base_url) ? $latestNewsItem->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                alt="{{ $latestNewsItem->image_alt }}"
              />
            </figure>
        </div>
        <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700"/>
    @endforeach
  </div>

</section>
