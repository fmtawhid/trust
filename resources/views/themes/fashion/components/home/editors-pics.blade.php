<section
  class="border dark:border-neutral-800 p-3 rounded-md">
  <div
    class="text-theme-six-primary pb-2 mb-6 text-lg uppercase font-bold border-b dark:border-b-neutral-600">
    {{ localize('recommended_posts') }}
  </div>

  <div class="space-y-4 2xl:space-y-6 pb-4 md:pb-5 2xl:pb-3">
    @foreach ($recommendedPosts as $recommendedPostsItem )
      <div class="h-[60px]">
        <a href="{{ __url($recommendedPostsItem->encode_title) }}" class="col-span-2 font-semibold text-theme-six-secondary hover:text-theme-six-primary dark:text-neutral-50 dark:hover:text-theme-six-primary leading-5 line-clamp-3 transition_3"
        >
          {{ $recommendedPostsItem->title }}
        </a>
      </div>
      <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700"/>
    @endforeach
  </div>

</section>
