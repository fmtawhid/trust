<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{ app_setting()->favicon }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="base-url" content="{{ url('/') }}">

    {!! SEOTools::generate() !!}

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{ \App\Helpers\ThemeHelper::asset('plugins/swiper/css/swiper-bundle.min.css') }}" />

    <!-- Tailwind css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen relative">

    <main id="main-bg" role="main" class="flex justify-center items-center bg-neutral-800">
        <a href="{{ __url('/web-stories') }}"
            class="w-10 h-10 text-white flex_center absolute lg:top-3 right-3 top-4 bg-red-600 hover:bg-red-700 rounded-full transition_3 z-40">
            <svg width='24' height='24' fill='currentColor' xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512">
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
        </a>
        <div class="daily-stories">
            <div class="daily-stories__outer">
                <div class="daily-stories__container">
                    @foreach ($storyDetail->details as $stories)
                        <div class="main_image_container relative">
                            <div class="slide bg_gradient_top" data-timeout="2000">
                                <img src="{{ $stories->image_path ? asset('storage/' . $stories->image_path) : asset('assets/story-blank.png') }}"
                                    alt="Story" title="{{ $stories->title }}" />
                            </div>
                            <div
                                class="inner_text_content absolute left-1/2 -translate-x-1/2 w-full p-4 space-y-4 text-center">
                                <p class="text-2xl text-center text-white line-clamp-4">{{ $stories->title }}</p>
                                @if ($stories->button_text && $stories->button_link)
                                    <a href="{{ $stories->button_link }}"
                                        class="text-sm px-6 py-2 inline-flex items-center justify-center gap-1 bg-black text-white hover:bg-red-600 rounded-full transition_5">
                                        <svg width="16" height="16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <path
                                                d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z" />
                                        </svg>
                                        <span class="">{{ $stories->button_text }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="progress-bars" data-count="{{ $storyDetail->story_details_count }}">
                @for ($i = 0; $i < $storyDetail->story_details_count; $i++)
                    <div class="bar" data-index="{{ $i }}"><span
                            style="animation-duration: 2000ms;"></span></div>
                @endfor
            </div>

            <div class="context-menu-container ">
                <a href="#" class="btn_play_push">
                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <circle fill="#ffffff" cx="7" cy="16" r="2" />
                        <circle fill="#ffffff" cx="16" cy="16" r="2" />
                        <circle fill="#ffffff" cx="25" cy="16" r="2" />
                    </svg>
                </a>
                <div class="context-menu bg-white">
                    <a href="#" id="c-menu_save" target="_blank" class="link">Save picture</a>
                    <a href="{{ url()->full() }}" id="c-menu_share" target="_blank" class="link">Share</a>
                    <a href="{{ url()->full() }}" id="c-menu_copy" class="link">Copy link</a>
                    <a href="#" id="c-menu_cancel" class="link bg-brand-primary text-white">Cancel</a>
                </div>
            </div>

            <!-- Slider Next/Preview Button -->
            <button id="prev-slide" type="button"
                class="flex justify-center items-center bg-brand-primary w-10 h-10 rounded-full transition-all duration-300 ease-in-out rtl:order-2 absolute top-1/2 -translate-y-1/2 left-3 z-30">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"
                    fill="none">
                    <path d="M13.1,13.9L9.2,10l3.9-3.8L11.9,5l-5,5l5,5L13.1,13.9z" fill="#ffffff" />
                </svg>
            </button>
            <button id="next-slide" type="button"
                class="flex justify-center items-center bg-brand-primary w-10 h-10 rounded-full transition-all duration-300 ease-in-out absolute top-1/2 -translate-y-1/2 right-3 z-30">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"
                    fill="none">
                    <path
                        d="M6.7168 13.55L10.5501 9.71667L6.7168 5.88334L7.88346 4.71667L12.8835 9.71667L7.88346 14.7167L6.7168 13.55Z"
                        fill="#ffffff" />
                </svg>
            </button>
        </div>

        {{-- play/push button --}}
        <div class="central-area" data-state="playing">
            <div class="btn_play_push">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" />
                    <path id="path_play" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M10 8l6 4-6 4V8z" />
                    <path id="path_pause" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M10 15V9M14 15V9" />
                </svg>
            </div>
        </div>

    </main>

    <input type="hidden" name="story_page_hidden_url" id="story_page_hidden_url" value="{{ url('/') }}">

    <!-- Global Modal -->
    <div id="globalModal"
        class="fixed inset-0 flex items-center justify-center bg-black/75 z-50 opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="globalModalContent">
            <!-- Close Button -->
            <button id="globalModalClose"
                class="p-2 text-white bg-red-600 hover:bg-red-800 rounded-full w-8 h-8 flex items-center justify-center absolute top-4 right-4 transition_3">
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                        fill="currentColor" />
                </svg>
            </button>

            <!-- Dynamic Content Goes Here -->
            <div id="modalBody"></div>
        </div>
    </div>
    {{-- Btn scroll To Top --}}
    <button id="scrollToTopBtn" type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="hidden bg-red-600 hover:bg-brand-primary rounded-full w-10 h-10 flex justify-center items-center fixed bottom-4 right-2 hover:-translate-y-1 z-50 transition-all duration-300 ease-in">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="#fff"
                d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
        </svg>
    </button>
    {{-- scrollToTopBtn --}}
    <script>
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollToTopBtn.classList.remove('hidden');
            } else {
                scrollToTopBtn.classList.add('hidden');
            }
        });

        const subscribeUrl = "{{ route('subscribe.ajax') }}";
        const categoryLoadMoreUrl = "{{ route('load.more.category.news') }}";
        const ajaxPollVoteUrl = "{{ route('ajax.poll.vote') }}";
        const ajaxPollResultUrl = "{{ route('ajax.poll.result', ['poll' => '__POLL_ID__']) }}";
    </script>
    <script src="{{ asset(path: 'website/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ \App\Helpers\ThemeHelper::asset('js/story.js') }}"></script>

</body>

</html>
