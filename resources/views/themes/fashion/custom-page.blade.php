<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-12 lg:mt-1 pt-1">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>

                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary line-clamp-1">{{ $page->title }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">
        <!-- Left section news -->
        <section class="lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            <div class="">
                <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold">
                    {{ $page->title }}
                </h1>
            </div>
            <!-- banner section -->
            @if ($page->image_id)
                <figure class="mb-8 mt-4">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $page->image_id) }}"
                        alt="" alt="" />
                </figure>
            @endif

            <div class="prose-content text-neutral-900 dark:text-neutral-50">{!! $page->description ?? 'null' !!}</div>

            @if ($page->video_url)
                <div class="mt-6 mb-4">
                    <a href="{{ $page->video_url }}" target="_blank"
                        class="text-brand-primary hover:underline transition_3">
                        <i class="fa-solid fa-video"></i> {{ localize('watch_video') }}
                    </a>
                </div>
            @endif

        </section>
    </section>
</x-web-layout>
