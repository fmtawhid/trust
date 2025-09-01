<section class="border p-2 2xl:p-3 rounded-md dark:bg-neutral-900 dark:divide-neutral-700 dark:border-neutral-800 shadow-sm ">
  <div class="flex justify-between items-center gap-2 mb-4">
    <p
      class="text-theme-six-primary transition_3 text-lg font-semibold uppercase inline-block">
      {{ localize('opinion') }}
    </p>
    <!-- Slider Next/Preview Button -->
    <div class="flex items-center gap-2">
      <button
        type="button"
        class="swiper_button_prev opinion-swiper-button-prev rtl:order-2"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="40"
          height="40"
          viewBox="0 0 20 20"
          fill="none"
        >
          <path
            d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z"
            fill="#ffffff"
          />
        </svg>
      </button>
      <button
        type="button"
        class="swiper_button_next opinion-swiper-button-next"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="40"
          height="40"
          viewBox="0 0 20 20"
          fill="none"
        >
          <path
            d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
            fill="#ffffff"
          />
        </svg>
      </button>
    </div>
  </div>

  <!-- Opinion Slider Section -->
  <div class="swiper w-full h-full OpinionFadeSwiper">
    <div class="swiper-wrapper">
      {{-- Slider --}}

      @foreach ($opinions->chunk(2) as $opinionChunk)
        <div class="swiper-slide">
          <div
            class="bg-theme-six-tertiary dark:bg-neutral-900 border-t border-t-neutral-300 dark:border-neutral-700 divide-y dark:divide-neutral-700">
            
            <!-- Opinion List -->
            @foreach ($opinionChunk as $opinion)
              <div class="flex items-center gap-4 py-4">
                <!-- Avatar -->
                <div>
                  <figure class="w-20 h-20 rounded-full overflow-hidden">
                    <img
                      class="w-full h-full object-cover"
                      src="{{ get_image_url('/assets/opinion-avatar.png', $opinion->person_image) }}"
                      alt="{{ $opinion->name }}"
                    />
                  </figure>
                </div>
                <div class="space-y-3">
                  <!-- Message -->
                  <a href="{{ __url($opinion->encode_title) }}"
                    class="text-base leading-5 line-clamp-3 dark:text-neutral-50">
                    {{ $opinion->title }}
                  </a>
                  <!-- Name -->
                  <p class="text-theme-six-primary text-sm">
                    {{ $opinion->name }}
                  </p>
                </div>
              </div>
            @endforeach

          </div>
        </div>
      @endforeach
      
    </div>
  </div>
</section>
