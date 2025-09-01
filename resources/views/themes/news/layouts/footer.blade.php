<footer class="relative w-full h-max isolate">
    <img class="absolute top-0 left-0 w-full h-full -z-1"
        src="@if (app_setting()->footer_bg_img) {{ asset('storage/' . app_setting()->footer_bg_img) }} @else {{ asset('/assets/footer-bg.png') }} @endif"
        alt="Footer Background" />
    <div class="container py-8">
        @include ('themes.news.components.common.footer-heading')

        <section
            class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-4 xl:gap-0 border-y border-y-neutral-700 py-8 lg:divide-x lg:divide-neutral-700">
            <!--  {/* Address Section */} -->
            <div class="text-white space-y-8 lg:pr-4 2xl:pr-6">
                <div>
                    <h2 class="text-xl font-bold mb-8 capitalize">{{ localize('about_us') }}</h2>
                    <p>{{ app_setting()->footer_text }}</p>
                </div>
                <ul class="space-y-2">
                    <li class="flex gap-3 items-center">
                        <div>
                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path
                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
                                    fill="#d3d3d3" />
                            </svg>
                        </div>
                        <span>{{ app_setting()->address }}</span>
                    </li>
                    <li class="flex gap-3 items-center">
                        <div>
                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"
                                    fill="#d3d3d3" />
                            </svg>
                        </div>
                        <span>{{ app_setting()->phone }}</span>
                    </li>
                    <li class="flex gap-3 items-center">
                        <div>
                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
                                    fill="#d3d3d3" />
                            </svg>
                        </div>
                        <span>{{ app_setting()->email }}</span>
                    </li>
                </ul>
            </div>
            <!-- {/* Quick Link */} -->
            <div class="text-white lg:px-4 2xl:px-6">
                <h2 class="text-xl font-bold mb-8">{{ localize('categories') }}</h2>

                <div class="grid grid-cols-2 gap-16">
                    @if ($footerCategories->isNotEmpty())
                        @php
                            $leftFooterCategories = $footerCategories->take(5);
                            $rightFooterCategories = $footerCategories->slice(5);
                        @endphp
                        <ul class="space-y-2">
                            @foreach ($leftFooterCategories as $footerCategory)
                                @php
                                    if ($footerCategory->content_type == 'links') {
                                        $link = $footerCategory->link_url;
                                    } elseif ($footerCategory->content_type == 'pages') {
                                        $link = __url($footerCategory->slug);
                                    } else {
                                        $link = __url($footerCategory->slug);
                                    }
                                @endphp

                                <li class="nav_link">
                                    <a href="{{ $link }}">{{ $footerCategory->menu_level }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <ul class="space-y-2">
                            @foreach ($rightFooterCategories as $footerCategory)
                                @php
                                    if ($footerCategory->content_type == 'links') {
                                        $link = $footerCategory->link_url;
                                    } elseif ($footerCategory->content_type == 'pages') {
                                        $link = __url($footerCategory->slug);
                                    } else {
                                        $link = __url($footerCategory->slug);
                                    }
                                @endphp

                                <li class="nav_link">
                                    <a href="{{ $link }}">{{ $footerCategory->menu_level }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <!--  {/* Inportens Link */} -->
            <div class="text-white xl:flex flex-col items-center lg:px-4 2xl:px-6">
                <h2 class="text-xl font-bold mb-8">{{ localize('company') }}</h2>

                <ul class="space-y-2">
                    @if ($footerMenus->isNotEmpty())
                        @foreach ($footerMenus as $footerMenu)
                            @php
                                if ($footerMenu->content_type == 'links') {
                                    $link = $footerMenu->link_url;
                                } elseif ($footerMenu->content_type == 'pages') {
                                    $link = __url($footerMenu->slug);
                                } else {
                                    $link = __url($footerMenu->slug);
                                }
                            @endphp

                            <li class="nav_link">
                                <a href="{{ $link }}">{{ $footerMenu->menu_level }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- {/* Get connected */} -->
            <div class="text-white lg:pl-4 2xl:pl-6">
                <h2 class="text-xl font-bold mb-8 capitalize">{{ localize('sign_up_for_our_newsletter') }}</h2>

                <p class="">
                    {{ localize('subscribe_to_our_newsletter_to_get_our_newest_articles_instantly!') }}
                </p>

                <form id="subscribe-form" class="relative my-6 max-w-xl mx-auto">
                    @csrf

                    <div id="subscribe-message" class="text-sm pb-1 text-center"></div>

                    <div class="relative">
                        <input name="subscriber_email" id="subscriber_email"
                            class="text-neutral-800 py-3 pl-3 pr-28 rounded-md w-full duration-300 ease-in placeholder:text-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                            type="email" placeholder="Email" required />

                        <button type="submit" id="subscribe-btn"
                            class="absolute top-1/2 -translate-y-1/2 right-0 rounded-r-md bg-red-500 text-white hover:bg-red-600 px-4 h-full border border-red-500 flex items-center justify-center gap-1 transition-all duration-300 ease-in">
                            {{ localize('subscribe') }}
                        </button>
                    </div>
                </form>

            </div>
        </section>

        <section class="md:flex items-center justify-between pt-4 text-sm text-white">
            <p class="">{{ app_setting()->copy_right ?? '' }}</p>
            <ul class="flex items-center gap-4 capitalize mt-4 md:mt-0">
                @if ($footerPages->isNotEmpty())
                    @foreach ($footerPages as $footerPage)
                        @php
                            if ($footerPage->content_type == 'links') {
                                $link = $footerPage->link_url;
                            } elseif ($footerPage->content_type == 'pages') {
                                $link = __url($footerPage->slug);
                            } else {
                                $link = __url($footerPage->slug);
                            }
                        @endphp

                        <li>
                            <a class="nav_link" href="{{ $link }}">{{ $footerPage->menu_level }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>
    </div>
</footer>
