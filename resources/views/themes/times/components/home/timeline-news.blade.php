@php
  $breakingNews = [
    [
        'title' => 'Breaking News',
        'post' => [
            [
            'date' => 'May 28,2025',
            'title' => 'AI Tops World Economic Forum’s ',
            ],
            [
            'date' => 'April 28,2025',
            'title' => 'Brexit damaging trade with EU, says public committee on Thursday',
            ],
            [
            'date' => 'January 28,2025',
            'title' => 'The Fed is about to raise interest rates and shaft American workers',
            ],
            [
            'date' => 'May 28,2025',
            'title' => 'AI Tops World Economic Forum’s List of Top 10 Emerging Technologies of 2024 List of Top 10 Emerging Technologies of 2024',
            ],
            [
            'date' => 'April 28,2025',
            'title' => 'Brexit damaging trade with EU, says public committee on Thursday',
            ],
            [
            'date' => 'January 28,2025',
            'title' => 'The Fed is about to raise interest rates and shaft American workers',
            ],
            [
            'date' => 'December 28,2024',
            'title' => 'Brexit damaging trade with EU, says public committee on Thursday',
            ]
        ]

    ]

  ];
@endphp

@foreach ($breakingNews as $section)
<div class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm">
  <div class="text-theme-three dark:text-cyan-500 pb-2 text-xl capitalize font-bold border-b dark:border-b-neutral-600 mb-3">
    {{ $section['title'] }}
  </div>

  <div class="relative border-l-2 dark:border-l-neutral-700 pl-4 space-y-4">
    @foreach (array_slice($section['post'], 0, 6) as $item)
      <div class="relative">
        <div class="text-white absolute -left-5 top-1 w-2 h-2 bg-red-500 rounded-full flex items-center justify-center"></div>
        <p class="text-sm text-theme-three dark:text-cyan-500 mb-2">{{ $item['date'] }}</p>
        <div class="h-12">
          <a href="#" class="font-semibold text-theme-three hover:text-cyan-600 dark:text-gray-200 leading-5 line-clamp-2 transition_3">
            {{ $item['title'] }}
          </a>
        </div>
      </div>
      <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700"/>
    @endforeach
  </div>
</div>
@endforeach
