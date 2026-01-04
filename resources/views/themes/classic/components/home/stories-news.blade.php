<section class="container my-6">
    <div
        class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-20">
        <a href="{{ __url('web-stories') }}" class="text-brand-primary dark:text-white text-lg font-semibold uppercase">
            {{ localize('news_stories') }}
        </a>
        <!-- Slider Next/Preview Button -->
        <div class="flex items-center gap-2">
            <button type="button" class="swiper_button_prev stories-swiper-button-prev rtl:order-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20" fill="none">
                    <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="#ffffff" />
                </svg>
            </button>
            <button type="button" class="swiper_button_next stories-swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"
                    fill="none">
                    <path
                        d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                        fill="#ffffff" />
                </svg>
            </button>
        </div>
    </div>
    <!--  News Stories (Slider section)  -->

    <!--  News Stories (Swiper) -->
    <div class="swiper w-full h-full StoriesNewsSwiper">
        <div class="swiper-wrapper">
            @foreach ($homeStories as $story)
                <div class="swiper-slide rounded-lg overflow-hidden">
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
    </div>
</section>
