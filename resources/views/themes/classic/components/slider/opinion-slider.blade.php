<section class="xl:col-span-3">
    <div class="flex justify-between items-center gap-2 mb-4">
        <h1 class="text-brand-primary text-lg font-semibold uppercase">
            {{ localize('opinion') }}
        </h1>
        <!-- Slider Next/Preview Button -->
        <div class="flex items-center gap-2">
            <button type="button"
                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out opinion-swiper-button-prev rtl:order-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20" fill="none">
                    <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="#ffffff" />
                </svg>
            </button>
            <button type="button"
                class="bg-red-300 hover:bg-brand-primary w-6 h-6 rounded-sm flex justify-center items-center transition-all duration-300 ease-in-out opinion-swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"
                    fill="none">
                    <path
                        d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                        fill="#ffffff" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Opinion Slider Section -->
    <div class="swiper w-full h-full OpinionSwiper">
        <div class="swiper-wrapper">

            @forelse ($opinions->chunk(4) as $opinionChunk)
                <div class="swiper-slide">
                    <div class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">
                        @foreach ($opinionChunk as $index => $opinion)
                            @php
                                $position = $index % 4;
                                $borderClasses = match ($position) {
                                    0
                                        => 'flex items-center gap-4 py-6 md:py-10 border-r border-b pr-6 border-l md:border-l-0 px-4 md:px-0 dark:border-neutral-800',
                                    1
                                        => 'flex items-center gap-4 py-6 md:py-10 border-b md:pl-6 pr-6 md:pr-0 border-x md:border-x-0 px-4 md:px-0 dark:border-neutral-800',
                                    2
                                        => 'flex items-center gap-4 py-6 md:py-10 border-r border-b md:border-b-0 border-l md:border-l-0 pr-6 px-4 md:px-0 dark:border-neutral-800',
                                    3
                                        => 'flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 border-x md:border-x-0 px-4 md:px-0 dark:border-neutral-800',
                                    default => '',
                                };
                            @endphp

                            <div class="{{ $borderClasses }}">
                                <!-- Avatar -->
                                <div>
                                    <figure class="w-20 h-20 rounded-full overflow-hidden">
                                        <img class="w-full h-full object-cover"
                                            src="{{ get_image_url('/assets/opinion-avatar.png', $opinion->person_image) }}"
                                            alt="{{ $opinion->name }}">
                                    </figure>
                                </div>
                                <div>
                                    <!-- Message -->
                                    <a href="{{ __url($opinion->encode_title) }}"
                                        class="text-xl font-semibold line-clamp-3 dark:text-neutral-50 dark:hover:text-brand-primary">
                                        {{ $opinion->title }}
                                    </a>
                                    <!-- Name -->
                                    <p class="text-neutral-600 dark:text-red-400 text-sm">
                                        {{ $opinion->name }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p>{{ localize('opinions_are_not_available') }}</p>
            @endforelse

        </div>
    </div>

</section>
