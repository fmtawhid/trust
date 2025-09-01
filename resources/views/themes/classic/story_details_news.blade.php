<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-2">
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

                <li class="text-brand-primary line-clamp-1">{{ localize('Web_stories') }}</li>
            </ul>
        </div>

    </section>
    <!-- Details Page News (right side news sticky) Start -->


    <section class="container mt-2 pb-8 gap-4">
        <!-- Left section news -->
        <div class="block">
            <div class="grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @foreach ($homeStories as $story)
                    <div class="rounded-lg overflow-hidden">
                        <a href='{{ __url('web-stories/' . $story->slug) }}'
                            class="bg_gradient_top block cursor-pointer w-full xl:h-80 h-72">
                            <img class="w-full h-full object-cover"
                                src="{{ $story->latestDetail->image_path ? asset('storage/' . $story->latestDetail->image_path) : asset('assets/story-blank.png') }}"
                                alt="Story Images" />
                            <div class="p-3 absolute z-10 bottom-0 left-0 space-y-2">
                                <h1 class="text-white text-sm font-medium leading-5 line-clamp-3">
                                    {{ $story->title }}
                                </h1>
                                <div class="text-white capitalize flex items-center gap-1">
                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>
                                    <span
                                        class="text-xs font-thin">{{ news_publish_date_format($story->created_at) }}</span>
                                </div>
                                <!-- border line -->
                                <div class="flex justify-center items-center gap-2">
                                    @for ($i = 0; $i < $story->story_details_count; $i++)
                                        @if ($i == 0)
                                            <div class="w-1/4 h-0.5 rounded-md bg-white"></div>
                                        @else
                                            <div class="w-1/4 h-0.5 rounded-md bg-neutral-500"></div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-2 px-2">
                {{ $homeStories->links('vendor.pagination.web_stories') }}
            </div>

        </div>

    </section>
</x-web-layout>
