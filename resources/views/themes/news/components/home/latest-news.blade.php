<section
  class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm">
  <div
    class="bg-neutral-700 dark:bg-neutral-800 text-white p-2 text-lg capitalize font-semibold flex items-center gap-2">
    <span class="w-3 h-3 rounded-full bg-brand-primary"></span>
    <span>{{ localize('live_update_news') }}</span>
  </div>

  <div
    class="divide-y divide-neutral-300 dark:divide-neutral-600 capitalize lg:col-span-3 xl:col-span-1">
    <!-- News Heading -->

    @foreach ($latestNews as $latestNewsItem)

      <div class="py-2 4xl:py-3">
        <a
          href="{{ __url($latestNewsItem->encode_title) }}"
          class="text-neutral-800 text-lg font-bold line-clamp-2 dark:text-neutral-50 dark:hover:text-red-300 hover:text-brand-primary transition_3">
          {{ $latestNewsItem->title }}
        </a>
        <p
          class="text-neutral-600 dark:text-neutral-400 my-1.5 text-sm line-clamp-2 xl:line-clamp-1 4xl:line-clamp-2">
          {{ clean_news_content($latestNewsItem->news) }}
        </p>
        <div class="flex items-center gap-1 text-neutral-600 dark:text-neutral-400">
          <svg class="mb-0.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_146_24422)">
              <path
                d="M7.99967 14.6663C4.31767 14.6663 1.33301 11.6817 1.33301 7.99967C1.33301 4.31767 4.31767 1.33301 7.99967 1.33301C11.6817 1.33301 14.6663 4.31767 14.6663 7.99967C14.6663 11.6817 11.6817 14.6663 7.99967 14.6663ZM7.99967 13.333C9.41416 13.333 10.7707 12.7711 11.7709 11.7709C12.7711 10.7707 13.333 9.41416 13.333 7.99967C13.333 6.58519 12.7711 5.22863 11.7709 4.22844C10.7707 3.22824 9.41416 2.66634 7.99967 2.66634C6.58519 2.66634 5.22863 3.22824 4.22844 4.22844C3.22824 5.22863 2.66634 6.58519 2.66634 7.99967C2.66634 9.41416 3.22824 10.7707 4.22844 11.7709C5.22863 12.7711 6.58519 13.333 7.99967 13.333ZM8.66634 7.99967H11.333V9.33301H7.33301V4.66634H8.66634V7.99967Z"
                fill="currentColor" />
            </g>
            <defs>
              <clipPath id="clip0_146_24422">
                <rect width="16" height="16" fill="white" />
              </clipPath>
            </defs>
          </svg>
          <span class="text-xs">{{ news_time_ago($latestNewsItem->created_at) }}</span>
        </div>
      </div>
    @endforeach

  </div>
</section>
