<div class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm">
  <div class="text-theme-three dark:text-cyan-500 pb-2 text-xl capitalize font-bold border-b dark:border-b-neutral-600 mb-3">
    {{ localize('breaking_post') }}
  </div>

  <div class="relative border-l-2 dark:border-l-neutral-700 pl-4 space-y-4">
    @foreach ($breakingNews as $breaking)
      <div class="relative">
        <div class="text-white absolute -left-5 top-1 w-2 h-2 bg-red-500 rounded-full flex items-center justify-center"></div>
        <p class="text-sm text-theme-three dark:text-cyan-500 mb-2">{{ news_publish_date_format($breaking['date']) }}</p>
        <div class="h-12">
          @if ($breaking['url'])
            <a href="{{ __url($breaking['url']) }}" class="font-semibold text-theme-three hover:text-cyan-600 dark:text-gray-200 leading-5 line-clamp-2 transition_3">
              {{ $breaking['title'] }}
            </a>
          @else
            <p class="font-semibold text-theme-three dark:text-gray-200 leading-5 line-clamp-2 transition_3">
              {{ $breaking['title'] }}
            </p>
          @endif
        </div>
      </div>
      <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700"/>
    @endforeach
  </div>
</div>
