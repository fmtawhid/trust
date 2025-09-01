  <section class="my-8">
      <!-- Slider Next/Preview Button -->
      <div class="flex items-center justify-between gap-2 mb-4">
          <button type="button"
              class="text-teal-600 hover:text-brand-primary flex justify-center items-center transition-all duration-300 ease-in-out article-swiper-button-prev">
              <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  viewBox="0 0 20 20" fill="none">
                  <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="currentColor" />
              </svg>
              <span class="text-sm">{{ localize('previous_article') }}</span>
          </button>
          <button type="button"
              class="text-teal-600 hover:text-brand-primary flex justify-center items-center transition-all duration-300 ease-in-out article-swiper-button-next">
              <span class="text-sm">{{ localize('next_article') }}</span>
              <svg class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  viewBox="0 0 20 20" fill="none">
                  <path
                      d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                      fill="currentColor" />
              </svg>
          </button>
      </div>
      <!-- Article Slider Section -->
      <div class="swiper w-full h-full ArticleSwiper">
          <div class="swiper-wrapper">
              <!-- Article Slider 1 -->
              <div class="swiper-slide">
                  <div class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">
                      @if ($previousNews->isNotEmpty())
                          @foreach ($previousNews as $prevNews)
                              @if ($loop->iteration % 2 != 0)
                                  <div
                                      class="flex items-center gap-4 py-6 md:py-10 border-b md:border-b-0 md:border-r pr-6 px-4 md:px-0 dark:border-neutral-800">
                                      <!-- card image -->
                                    <a href="{{ __url($prevNews->encode_title) }}">
                                        <figure class="w-[100px] h-16 overflow-hidden">
                                          <img class="w-full h-full object-cover"
                                              src="{{ isset($prevNews->photoLibrary->image_base_url) ? $prevNews->photoLibrary->image_base_url : asset('assets/opinion-avatar.png') }}"
                                              alt="News" />
                                        </figure>
                                    </a>
                                    <!-- Message -->
                                    <a href="{{ __url($prevNews->encode_title) }}" class="text-neutral-600 dark:text-neutral-100 line-clamp-2">
                                        {{ $prevNews->title ?? null }}
                                    </a>

                                  </div>
                              @else
                                  <div
                                      class="flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 px-4 md:px-0 dark:border-neutral-800">
                                      <!-- card image -->

                                    <a href="{{ __url($prevNews->encode_title) }}">
                                        <figure class="w-[100px] h-16 overflow-hidden">
                                          <img class="w-full h-full object-cover"
                                              src="{{ isset($prevNews->photoLibrary->image_base_url) ? $prevNews->photoLibrary->image_base_url : asset('assets/opinion-avatar.png') }}"
                                              alt="" />
                                        </figure>
                                    </a>

                                    <!-- Message -->
                                    <a href="{{ __url($prevNews->encode_title) }}" class="dark:text-neutral-100 line-clamp-2">
                                        {{ $prevNews->title ?? null }}
                                    </a>
                                  </div>
                              @endif
                          @endforeach
                      @endif
                  </div>
              </div>
              <!-- Article Slider 2 -->
              <div class="swiper-slide">
                  <div class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">
                      @if ($nextNews->isNotEmpty())
                          @foreach ($nextNews as $nextNewsData)
                              @if ($loop->iteration % 2 != 0)
                                  <!-- Article List 1 -->
                                  <div
                                      class="flex items-center gap-4 py-6 md:py-10 border-b md:border-b-0 md:border-r pr-6 px-4 md:px-0 dark:border-neutral-800">
                                      <!-- card image -->
                                    <a href="{{ __url($nextNewsData->encode_title) }}">
                                        <figure class="w-[100px] h-16 overflow-hidden">
                                          <img class="w-full h-full object-cover"
                                              src="{{ isset($nextNewsData->photoLibrary->image_base_url) ? $nextNewsData->photoLibrary->image_base_url : asset('assets/opinion-avatar.png') }}"
                                              alt="News" />
                                      </figure>
                                    </a>

                                    <!-- Message -->
                                    <a href="{{ __url($nextNewsData->encode_title) }}" class="text-neutral-600 dark:text-neutral-100">
                                        {{ $nextNewsData->title ?? null }}
                                    </a>
                                  </div>
                              @else
                                  <!-- Article List 2 -->
                                  <div
                                      class="flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 px-4 md:px-0 dark:border-neutral-800">
                                      <!-- card image -->

                                    <a href="{{ __url($nextNewsData->encode_title) }}">
                                        <figure class="w-[100px] h-16 overflow-hidden">
                                          <img class="w-full h-full object-cover"
                                              src="{{ isset($nextNewsData->photoLibrary->image_base_url) ? $nextNewsData->photoLibrary->image_base_url : asset('assets/opinion-avatar.png') }}"
                                              alt="" />
                                        </figure>
                                    </a>

                                    <!-- Message -->
                                    <a href="{{ __url($nextNewsData->encode_title) }}" class="text-neutral-600 dark:text-neutral-100">
                                        {{ $nextNewsData->title ?? null }}
                                    </a>
                                  </div>
                              @endif
                          @endforeach
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </section>
