<!-- Top Section -->
<section
    class="bg-white dark:bg-neutral-950 shadow-md top_header  transition-all duration-500 z-20 ease-in dark:shadow-white/10 fixed left-0 top-0 w-full xl:relative">
    <div class="container mx-auto py-2 flex justify-between items-center">
        <!-- Left section -->

        <button onclick="openSidebar()" type="button"
            class="xl:hidden bg-neutral-100 dark:bg-neutral-600 text-neutral-600 dark:text-neutral-50 border dark:border-neutral-800 rounded-full w-9 h-9 flex justify-center items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6H20M4 12H20H7M4 18H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <section class="hidden xl:flex items-center gap-8">
            <div class="flex items-center gap-1 text-neutral-700 dark:text-white">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_146_24422)">
                        <path
                            d="M7.99967 14.6663C4.31767 14.6663 1.33301 11.6817 1.33301 7.99967C1.33301 4.31767 4.31767 1.33301 7.99967 1.33301C11.6817 1.33301 14.6663 4.31767 14.6663 7.99967C14.6663 11.6817 11.6817 14.6663 7.99967 14.6663ZM7.99967 13.333C9.41416 13.333 10.7707 12.7711 11.7709 11.7709C12.7711 10.7707 13.333 9.41416 13.333 7.99967C13.333 6.58519 12.7711 5.22863 11.7709 4.22844C10.7707 3.22824 9.41416 2.66634 7.99967 2.66634C6.58519 2.66634 5.22863 3.22824 4.22844 4.22844C3.22824 5.22863 2.66634 6.58519 2.66634 7.99967C2.66634 9.41416 3.22824 10.7707 4.22844 11.7709C5.22863 12.7711 6.58519 13.333 7.99967 13.333ZM8.66634 7.99967H11.333V9.33301H7.33301V4.66634H8.66634V7.99967Z"
                            fill="currentColor" />
                    </g>
                    <defs>
                        <clipPath id="clip0_146_24422">
                            <rect width="16" height="16" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <span class="text-sm">{{ $formattedDate }}</span>
            </div>
        </section>
        <!-- Mobile Brand Logo -->
        <div class="xl:hidden">
            <a class="hidden dark:block w-32 h-6 flex_center overflow-hidden" href="{{ __url('/') }}">
                <img src="{{ app_setting()->footer_logo }}" alt="Brand logo dark" />
            </a>
            <a class="dark:hidden w-32 h-6 flex_center overflow-hidden" href="{{ __url('/') }}">
                <img src="{{ app_setting()->logo }}" alt="Brand logo light" />
            </a>
        </div>

        <!-- Right section  -->
        <section class="flex items-center gap-2 md:gap-4">
            <!-- Login / Registration -->
            @if (app_setting()->web_user_can_login == 1)
                @include('themes.classic.components.common.login-button')
            @endif

            <!-- Dark/Light Switch-->
            <button id="theme-toggle" type="button" aria-label="Use Dark Mode"
                class="btn_theme bg-neutral-100 dark:bg-neutral-600 text-orange-600 dark:text-white w-9 h-9 flex justify-center items-center rounded-full border dark:border-neutral-800">
                <svg class="hidden dark:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 32 32">
                    <g fill="none" fill-rule="evenodd" transform="translate(-440 -200)">
                        <path fill="currentColor" fill-rule="nonzero" stroke="currentColor" stroke-width="0.5"
                            d="M102,21 C102,18.1017141 103.307179,15.4198295 105.51735,13.6246624 C106.001939,13.2310647 105.821611,12.4522936 105.21334,12.3117518 C104.322006,12.1058078 103.414758,12 102.5,12 C95.8722864,12 90.5,17.3722864 90.5,24 C90.5,30.6277136 95.8722864,36 102.5,36 C106.090868,36 109.423902,34.4109093 111.690274,31.7128995 C112.091837,31.2348572 111.767653,30.5041211 111.143759,30.4810139 C106.047479,30.2922628 102,26.1097349 102,21 Z M102.5,34.5 C96.7007136,34.5 92,29.7992864 92,24 C92,18.2007136 96.7007136,13.5 102.5,13.5 C102.807386,13.5 103.113925,13.5136793 103.419249,13.5407785 C101.566047,15.5446378 100.5,18.185162 100.5,21 C100.5,26.3198526 104.287549,30.7714322 109.339814,31.7756638 L109.516565,31.8092927 C107.615276,33.5209452 105.138081,34.5 102.5,34.5 Z"
                            transform="translate(354.5 192)"></path>
                        <polygon points="444 228 468 228 468 204 444 204"></polygon>
                    </g>
                </svg>
                <svg class="dark:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 32 32">
                    <g fill="none" fill-rule="evenodd" transform="translate(-442 -200)">
                        <g fill="currentColor" transform="translate(356 144)">
                            <path fill-rule="nonzero"
                                d="M108.5 24C108.5 27.5902136 105.590214 30.5 102 30.5 98.4097864 30.5 95.5 27.5902136 95.5 24 95.5 20.4097864 98.4097864 17.5 102 17.5 105.590214 17.5 108.5 20.4097864 108.5 24zM107 24C107 21.2382136 104.761786 19 102 19 99.2382136 19 97 21.2382136 97 24 97 26.7617864 99.2382136 29 102 29 104.761786 29 107 26.7617864 107 24zM101 12.75L101 14.75C101 15.1642136 101.335786 15.5 101.75 15.5 102.164214 15.5 102.5 15.1642136 102.5 14.75L102.5 12.75C102.5 12.3357864 102.164214 12 101.75 12 101.335786 12 101 12.3357864 101 12.75zM95.7255165 14.6323616L96.7485165 16.4038616C96.9556573 16.7625614 97.4143618 16.8854243 97.7730616 16.6782835 98.1317614 16.4711427 98.2546243 16.0124382 98.0474835 15.6537384L97.0244835 13.8822384C96.8173427 13.5235386 96.3586382 13.4006757 95.9999384 13.6078165 95.6412386 13.8149573 95.5183757 14.2736618 95.7255165 14.6323616zM91.8822384 19.0244835L93.6537384 20.0474835C94.0124382 20.2546243 94.4711427 20.1317614 94.6782835 19.7730616 94.8854243 19.4143618 94.7625614 18.9556573 94.4038616 18.7485165L92.6323616 17.7255165C92.2736618 17.5183757 91.8149573 17.6412386 91.6078165 17.9999384 91.4006757 18.3586382 91.5235386 18.8173427 91.8822384 19.0244835zM90.75 25L92.75 25C93.1642136 25 93.5 24.6642136 93.5 24.25 93.5 23.8357864 93.1642136 23.5 92.75 23.5L90.75 23.5C90.3357864 23.5 90 23.8357864 90 24.25 90 24.6642136 90.3357864 25 90.75 25zM92.6323616 30.2744835L94.4038616 29.2514835C94.7625614 29.0443427 94.8854243 28.5856382 94.6782835 28.2269384 94.4711427 27.8682386 94.0124382 27.7453757 93.6537384 27.9525165L91.8822384 28.9755165C91.5235386 29.1826573 91.4006757 29.6413618 91.6078165 30.0000616 91.8149573 30.3587614 92.2736618 30.4816243 92.6323616 30.2744835zM97.0244835 34.1177616L98.0474835 32.3462616C98.2546243 31.9875618 98.1317614 31.5288573 97.7730616 31.3217165 97.4143618 31.1145757 96.9556573 31.2374386 96.7485165 31.5961384L95.7255165 33.3676384C95.5183757 33.7263382 95.6412386 34.1850427 95.9999384 34.3921835 96.3586382 34.5993243 96.8173427 34.4764614 97.0244835 34.1177616zM103 35.25L103 33.25C103 32.8357864 102.664214 32.5 102.25 32.5 101.835786 32.5 101.5 32.8357864 101.5 33.25L101.5 35.25C101.5 35.6642136 101.835786 36 102.25 36 102.664214 36 103 35.6642136 103 35.25zM108.274483 33.3676384L107.251483 31.5961384C107.044343 31.2374386 106.585638 31.1145757 106.226938 31.3217165 105.868239 31.5288573 105.745376 31.9875618 105.952517 32.3462616L106.975517 34.1177616C107.182657 34.4764614 107.641362 34.5993243 108.000062 34.3921835 108.358761 34.1850427 108.481624 33.7263382 108.274483 33.3676384zM112.117762 28.9755165L110.346262 27.9525165C109.987562 27.7453757 109.528857 27.8682386 109.321717 28.2269384 109.114576 28.5856382 109.237439 29.0443427 109.596138 29.2514835L111.367638 30.2744835C111.726338 30.4816243 112.185043 30.3587614 112.392183 30.0000616 112.599324 29.6413618 112.476461 29.1826573 112.117762 28.9755165zM113.25 23L111.25 23C110.835786 23 110.5 23.3357864 110.5 23.75 110.5 24.1642136 110.835786 24.5 111.25 24.5L113.25 24.5C113.664214 24.5 114 24.1642136 114 23.75 114 23.3357864 113.664214 23 113.25 23zM111.367638 17.7255165L109.596138 18.7485165C109.237439 18.9556573 109.114576 19.4143618 109.321717 19.7730616 109.528857 20.1317614 109.987562 20.2546243 110.346262 20.0474835L112.117762 19.0244835C112.476461 18.8173427 112.599324 18.3586382 112.392183 17.9999384 112.185043 17.6412386 111.726338 17.5183757 111.367638 17.7255165zM106.975517 13.8822384L105.952517 15.6537384C105.745376 16.0124382 105.868239 16.4711427 106.226938 16.6782835 106.585638 16.8854243 107.044343 16.7625614 107.251483 16.4038616L108.274483 14.6323616C108.481624 14.2736618 108.358761 13.8149573 108.000062 13.6078165 107.641362 13.4006757 107.182657 13.5235386 106.975517 13.8822384z"
                                transform="translate(0 48)" stroke="currentColor" stroke-width="0.25"></path>
                            <path
                                d="M98.6123,60.1372 C98.6123,59.3552 98.8753,58.6427 99.3368,58.0942 C99.5293,57.8657 99.3933,57.5092 99.0943,57.5017 C99.0793,57.5012 99.0633,57.5007 99.0483,57.5007 C97.1578,57.4747 95.5418,59.0312 95.5008,60.9217 C95.4578,62.8907 97.0408,64.5002 98.9998,64.5002 C99.7793,64.5002 100.4983,64.2452 101.0798,63.8142 C101.3183,63.6372 101.2358,63.2627 100.9478,63.1897 C99.5923,62.8457 98.6123,61.6072 98.6123,60.1372"
                                transform="translate(3 11)"></path>
                        </g>
                        <polygon points="444 228 468 228 468 204 444 204"></polygon>
                    </g>
                </svg>
            </button>

            <!-- Multi-language Start -->
            <div class="{{ $languages->count() > 1 ? '':'hidden' }}">
                <div class="hidden xl:block relative text-left">
                    <button type="button" id="lang-toggle"
                        class="text-sm bg-white border border-gray-300 rounded-lg px-2 py-1 shadow-sm hover:bg-gray-50 focus:outline-none flex gap-0.5 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-50">
                        🌐 <span id="lang-label">{{ $activeLanguage->langname }}</span>
                    </button>
                    <div id="lang-menu"
                        class="absolute right-0 mt-2 w-max bg-white border border-gray-200 rounded-lg shadow-lg transition-all duration-200 ease-out transform opacity-0 scale-95 translate-y-2 pointer-events-none origin-top z-10 dark:bg-neutral-700 dark:border-neutral-600">
                        <ul class="py-1 text-gray-700 dark:text-neutral-50">
                            @foreach ($languages as $lang)
                                <li>
                                    <button
                                        class="lang-option block w-full text-left px-4 py-2 hover:bg-gray-100 hover:dark:bg-neutral-800 rtl:text-right"
                                        data-lang="{{ $lang->value }}">
                                        {{ $lang->langname }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Multi-language End -->
            <div class="xl:hidden">
                @include('themes.classic.components.common.search-button')
            </div>

            <!-- Social section -->
            <div class="hidden xl:flex items-center gap-2">
                <!--  Facebook  -->
                <div class="relative group">
                    <a href="{{ $socialLinks->fb->link ?? 'https://www.facebook.com' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-social-facebook flex justify-center items-center transition-all duration-300 hover:scale-110 hover:opacity-90">
                        <!-- Your SVG here -->
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_5)">
                                <path
                                    d="M9.33335 8.99998H11L11.6667 6.33331H9.33335V4.99998C9.33335 4.31331 9.33335 3.66665 10.6667 3.66665H11.6667V1.42665C11.4494 1.39798 10.6287 1.33331 9.76202 1.33331C7.95202 1.33331 6.66669 2.43798 6.66669 4.46665V6.33331H4.66669V8.99998H6.66669V14.6666H9.33335V8.99998Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_15_5">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <!-- Tooltip with arrow -->
                    <div
                        class="absolute top-full mt-2 left-1/2 -translate-x-1/2 mb-2 flex flex-col items-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                        <!-- Arrow -->
                        <div class="w-2 h-2 bg-social-facebook rotate-45 mt-[-4px]"></div>
                        <div
                            class="bg-social-facebook text-white text-xs px-2 py-1 rounded whitespace-nowrap mt-[-4px] capitalize">
                            {{ localize('facebook') }}
                        </div>
                    </div>
                </div>
                <!-- Twitter -->
                <div class="relative group">
                    <a href="{{ $socialLinks->tw->link ?? 'href="https://www.twitter.com/' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-social-twitter flex justify-center items-center transition-all duration-300 hover:scale-110 hover:opacity-90">
                        <!-- Your SVG here -->
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_10)">
                                <path
                                    d="M14.7746 3.77068C14.2657 3.99581 13.7259 4.14366 13.1733 4.20935C13.7558 3.86097 14.1918 3.31269 14.4 2.66668C13.8533 2.99201 13.254 3.22001 12.6293 3.34335C12.2097 2.8944 11.6535 2.59665 11.0473 2.4964C10.441 2.39615 9.8186 2.49901 9.27682 2.78898C8.73504 3.07896 8.30423 3.5398 8.05138 4.09987C7.79854 4.65995 7.73781 5.28787 7.87864 5.88601C6.77005 5.83045 5.68553 5.54236 4.6955 5.04045C3.70547 4.53855 2.83206 3.83404 2.13197 2.97268C1.88417 3.39831 1.75394 3.88216 1.75464 4.37468C1.75464 5.34135 2.24664 6.19535 2.99464 6.69535C2.55198 6.68141 2.11906 6.56187 1.73197 6.34668V6.38135C1.73211 7.02515 1.95489 7.64909 2.36254 8.14739C2.77019 8.64568 3.33763 8.98766 3.96864 9.11535C3.55772 9.2267 3.12685 9.24312 2.70864 9.16335C2.88655 9.7175 3.23331 10.2021 3.70037 10.5494C4.16743 10.8967 4.73139 11.0892 5.31331 11.1C4.73496 11.5542 4.07276 11.89 3.36456 12.0881C2.65636 12.2863 1.91606 12.3428 1.18597 12.2547C2.46044 13.0743 3.94404 13.5094 5.45931 13.508C10.588 13.508 13.3926 9.25935 13.3926 5.57468C13.3926 5.45468 13.3893 5.33335 13.384 5.21468C13.9299 4.82012 14.401 4.33136 14.7753 3.77135L14.7746 3.77068Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_15_10">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <!-- Tooltip with arrow -->
                    <div
                        class="absolute top-full mt-2 left-1/2 -translate-x-1/2 mb-2 flex flex-col items-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                        <!-- Arrow -->
                        <div class="w-2 h-2 bg-social-twitter rotate-45 mt-[-4px]"></div>
                        <div
                            class="bg-social-twitter text-white text-xs px-2 py-1 rounded whitespace-nowrap mt-[-4px] capitalize">
                            {{ localize('twitter') }}
                        </div>
                    </div>
                </div>
                <!-- Instragram -->
                <div class="relative group">
                    <a href="{{ $socialLinks->instagram->link ?? 'href="https://www.instragram.com/' }}"
                        target="_blank"
                        class="w-8 h-8 rounded-full bg-social-instragram flex justify-center items-center transition-all duration-300 hover:scale-110 hover:opacity-90">
                        <!-- Your SVG here -->
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_15)">
                                <path
                                    d="M7.99998 1.33331C9.81131 1.33331 10.0373 1.33998 10.748 1.37331C11.458 1.40665 11.9413 1.51798 12.3666 1.68331C12.8066 1.85265 13.1773 2.08198 13.548 2.45198C13.887 2.78524 14.1493 3.18837 14.3166 3.63331C14.4813 4.05798 14.5933 4.54198 14.6266 5.25198C14.658 5.96265 14.6666 6.18865 14.6666 7.99998C14.6666 9.81131 14.66 10.0373 14.6266 10.748C14.5933 11.458 14.4813 11.9413 14.3166 12.3666C14.1498 12.8118 13.8874 13.2151 13.548 13.548C13.2146 13.8869 12.8115 14.1491 12.3666 14.3166C11.942 14.4813 11.458 14.5933 10.748 14.6266C10.0373 14.658 9.81131 14.6666 7.99998 14.6666C6.18865 14.6666 5.96265 14.66 5.25198 14.6266C4.54198 14.5933 4.05865 14.4813 3.63331 14.3166C3.1882 14.1496 2.785 13.8873 2.45198 13.548C2.11292 13.2148 1.8506 12.8116 1.68331 12.3666C1.51798 11.942 1.40665 11.458 1.37331 10.748C1.34198 10.0373 1.33331 9.81131 1.33331 7.99998C1.33331 6.18865 1.33998 5.96265 1.37331 5.25198C1.40665 4.54131 1.51798 4.05865 1.68331 3.63331C1.85014 3.1881 2.11252 2.78486 2.45198 2.45198C2.78509 2.1128 3.18827 1.85047 3.63331 1.68331C4.05865 1.51798 4.54131 1.40665 5.25198 1.37331C5.96265 1.34198 6.18865 1.33331 7.99998 1.33331ZM7.99998 4.66665C7.11592 4.66665 6.26808 5.01784 5.64296 5.64296C5.01784 6.26808 4.66665 7.11592 4.66665 7.99998C4.66665 8.88403 5.01784 9.73188 5.64296 10.357C6.26808 10.9821 7.11592 11.3333 7.99998 11.3333C8.88403 11.3333 9.73188 10.9821 10.357 10.357C10.9821 9.73188 11.3333 8.88403 11.3333 7.99998C11.3333 7.11592 10.9821 6.26808 10.357 5.64296C9.73188 5.01784 8.88403 4.66665 7.99998 4.66665V4.66665ZM12.3333 4.49998C12.3333 4.27897 12.2455 4.067 12.0892 3.91072C11.933 3.75444 11.721 3.66665 11.5 3.66665C11.279 3.66665 11.067 3.75444 10.9107 3.91072C10.7544 4.067 10.6666 4.27897 10.6666 4.49998C10.6666 4.72099 10.7544 4.93296 10.9107 5.08924C11.067 5.24552 11.279 5.33331 11.5 5.33331C11.721 5.33331 11.933 5.24552 12.0892 5.08924C12.2455 4.93296 12.3333 4.72099 12.3333 4.49998ZM7.99998 5.99998C8.53041 5.99998 9.03912 6.21069 9.41419 6.58577C9.78927 6.96084 9.99998 7.46955 9.99998 7.99998C9.99998 8.53041 9.78927 9.03912 9.41419 9.41419C9.03912 9.78927 8.53041 9.99998 7.99998 9.99998C7.46955 9.99998 6.96084 9.78927 6.58577 9.41419C6.21069 9.03912 5.99998 8.53041 5.99998 7.99998C5.99998 7.46955 6.21069 6.96084 6.58577 6.58577C6.96084 6.21069 7.46955 5.99998 7.99998 5.99998V5.99998Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_15_15">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <!-- Tooltip with arrow -->
                    <div
                        class="absolute top-full mt-2 left-1/2 -translate-x-1/2 mb-2 flex flex-col items-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                        <!-- Arrow -->
                        <div class="w-2 h-2 bg-social-instragram rotate-45 mt-[-4px]"></div>
                        <div
                            class="bg-social-instragram text-white text-xs px-2 py-1 rounded whitespace-nowrap mt-[-4px] capitalize">
                            {{ localize('instragram') }}
                        </div>
                    </div>
                </div>
                <!-- Youtube -->
                <div class="relative group">
                    <a href="{{ $socialLinks->youtube->link ?? 'href="https://www.youtube.com/' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-social-youtube flex justify-center items-center transition-all duration-300 hover:scale-110 hover:opacity-90">
                        <!-- Your SVG here -->
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_20)">
                                <path
                                    d="M14.362 4.33202C14.6666 5.52002 14.6666 8.00002 14.6666 8.00002C14.6666 8.00002 14.6666 10.48 14.362 11.668C14.1926 12.3247 13.6973 12.8414 13.07 13.016C11.9306 13.3334 7.99998 13.3334 7.99998 13.3334C7.99998 13.3334 4.07131 13.3334 2.92998 13.016C2.29998 12.8387 1.80531 12.3227 1.63798 11.668C1.33331 10.48 1.33331 8.00002 1.33331 8.00002C1.33331 8.00002 1.33331 5.52002 1.63798 4.33202C1.80731 3.67535 2.30265 3.15869 2.92998 2.98402C4.07131 2.66669 7.99998 2.66669 7.99998 2.66669C7.99998 2.66669 11.9306 2.66669 13.07 2.98402C13.7 3.16135 14.1946 3.67735 14.362 4.33202V4.33202ZM6.66665 10.3334L10.6666 8.00002L6.66665 5.66669V10.3334Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_15_20">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <!-- Tooltip with arrow -->
                    <div
                        class="absolute top-full mt-2 left-1/2 -translate-x-1/2 mb-2 flex flex-col items-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                        <!-- Arrow -->
                        <div class="w-2 h-2 bg-social-youtube rotate-45 mt-[-4px]"></div>
                        <div
                            class="bg-social-youtube text-white text-xs px-2 py-1 rounded whitespace-nowrap mt-[-4px] capitalize">
                            {{ localize('youtube') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
