<x-web-layout>
    <!-- Pagination -->
    <section class="container mt-12 lg:mt-1 pt-1">
        <div class="bg-neutral-100 dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 capitalize whitespace-nowrap" href="{{ __url('/') }}">
                        {{ localize('home') }}
                    </a>
                </li>
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <li class="text-brand-primary capitalize line-clamp-1">{{ localize('opinion') }}</li>
            </ul>
        </div>
    </section>

    <!-- Details Page News (right side news sticky) Start -->

    <section class="container mt-2 pb-8 grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 4xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="dark:text-white lg:col-span-2 xl:col-span-2 4xl:col-span-3 gap-6">
            <!-- heading -->
            <div class="mb-2">
                <h1 class="dark:text-white text-2xl lg:text-3xl my-2 font-semibold line-clamp-2">
                    {{ $opinion->title }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center space-x-4 mt-3">
                    <!-- Avatar -->
                    <img src="{{ get_image_url('/assets/default.jpg', $opinion->person_image) }}" alt=""
                        class="w-12 h-12 rounded-full object-cover border shadow-sm" />

                    <!-- Author Details -->
                    <div>
                        <p class="text-md font-semibold dark:text-white text-gray-900">
                            {{ $opinion->name }}
                        </p>
                        @if ($opinion->designation)
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $opinion->designation }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex md:items-center justify-between flex-col md:flex-row gap-4 mt-2">
                    <div class="dark:text-white capitalize flex items-center gap-1 text-sm">
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                        <span>{{ news_publish_date_format($opinion->created_at) }}</span>
                    </div>

                    <!-- Social section -->
                    @include ('themes.magazine.components.common.social-section')

                </div>
            </div>

            @if ($opinion->news_image)
                <div class="my-4">
                    <img src="{{ asset('storage/' . $opinion->news_image) }}" alt="{{ $opinion->image_alt }}"
                        class="w-full max-h-[550px]" />

                    @if (!empty($opinion->image_title))
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic text-center">
                            {{ $opinion->image_title }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="prose-content dark:text-white">
                {!! $opinion->content !!}
            </div>

            <!-- Comment Section -->
            <input type="hidden" form="comment-form" name="news_comment_type" value="opinion">

            @if (app_setting()->web_user_can_comment == 1)
              @include ('themes.magazine.components.details.comment-section')
            @endif

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
            <!-- Popular post -->
            @include('themes.magazine.components.common.popular-post')


            <!-- Top Week -->
            @include('themes.magazine.components.common.recommended-top-week-post')

            <!-- Voting poll -->
            @if ($votingPoll)
                @include('themes.magazine.components.common.voting-poll')
            @endif
        </div>
        </section>

    </section>

</x-web-layout>
