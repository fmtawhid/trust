@php
    use Illuminate\Support\Str;
@endphp
<section class="@if (!$themeSettings->background_color) bg-red-700 @endif hidden xl:block fixed_top_menu"
    @if ($themeSettings->background_color) style="background-color: {{ $themeSettings->background_color }};" @endif>
    <div class="container flex justify-between items-center gap-6 relative py-2">
        <div class="hidden lg:block side-bar">
            <div class="menu flex items-center gap-2 xl:gap-4">
                <div class="item relative cursor-pointer py-2">
                    <a class="capitalize @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 side_nav_news"
                        @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif
                        href="{{ __url('/') }}">{{ Str::upper(localize('home')) }}</a>
                </div>

                @foreach ($mainMenus as $menu)
                    @if ($menu->submenus->isNotEmpty())
                        <div class="item cursor-pointer py-2">
                            <a href="{{ __url($menu->slug) }}"
                                class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                                @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>{{ Str::upper($menu->menu_level) }}

                                <span class="rtl:scale-x-[-1]">
                                    <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                        width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                    </svg>
                                </span>
                            </a>
                            <div
                                class="sub-menu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out bg-neutral-50 dark:bg-neutral-800 absolute top-full left-7 w-[96%] shadow-md z-20">
                                <div class="grid grid-cols-5">
                                    <div id="category_tabs" class="overflow-hidden py-4 px-4">
                                        @foreach ($menu->submenus as $submenu)
                                            @if ($loop->iteration == 1)
                                                <a href="{{ __url($menu->slug) }}"
                                                    data-tab="{{ Str::slug($submenu->menu_level, '_') }}_all"
                                                    class="sub-item block my-1 text-base hover:text-red-500 dark:hover:text-red-500 text-red-600 dark:text-red-500 transition_3">
                                                    {{ localize('all') }}
                                                </a>
                                            @endif
                                            <a href="{{ __url($submenu->slug) }}" type="button"
                                                data-tab="{{ Str::slug($submenu->menu_level, '_') }}"
                                                class="sub-item block my-1 text-base hover:text-red-500 dark:hover:text-red-500 text-gray-800 dark:text-white transition_3">
                                                {{ $submenu->menu_level }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="col-span-4">
                                        <div
                                            class="relative max-h-max min-h-[270px] xl:min-h-[300px] 2xl:min-h-[320px]">
                                            @foreach ($menu->submenus as $submenu)
                                                @if ($loop->iteration == 1)
                                                    <div data-content="{{ Str::slug($submenu->menu_level, '_') }}_all"
                                                        class="tab-content absolute inset-0 grid grid-cols-3 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse opacity-100 translate-y-0 pointer-events-auto transition-all duration-300 ease-in-out">
                                                        @foreach ($menu->top_combined_submenu_news as $item)
                                                            <div class="overflow-hidden px-2">
                                                                <a href="{{ __url($item->encode_title) }}"
                                                                    class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                                        src="{{ $item->photoLibrary ? $item->photoLibrary->image_base_url : asset('assets/news-card-view.png') }}"
                                                                        alt="" />
                                                                </a>
                                                                <div class="p-2 space-y-2">
                                                                    <div class="line-clamp-2">
                                                                        <a href="{{ __url($item->encode_title) }}"
                                                                            class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                                            {{ $item->title }}
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                                        <span>{{ $item->postByUser->full_name ?? localize('unknown') }}</span>
                                                                        <svg width="12" height="12"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 448 512">
                                                                            <path fill="currentColor"
                                                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                                        </svg>
                                                                        <span>{{ news_publish_date_format($item->publish_date) }}</span>
                                                                        <svg width="14" height="14"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512">
                                                                            <path fill="currentColor"
                                                                                d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                                                        </svg>
                                                                        <span>{{ $item->comments_count ?? 0 }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div data-content="{{ Str::slug($submenu->menu_level, '_') }}"
                                                    class="tab-content absolute inset-0 grid grid-cols-3 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse opacity-0 translate-y-2 pointer-events-none transition-all duration-300 ease-in-out">
                                                    @foreach ($submenu->top_news as $item)
                                                        <div class="overflow-hidden px-2">
                                                            <a href="{{ __url($item->encode_title) }}"
                                                                class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                                    src="{{ $item->photoLibrary ? $item->photoLibrary->image_base_url : asset('assets/news-card-view.png') }}"
                                                                    alt="" />
                                                            </a>
                                                            <div class="p-2 space-y-2">
                                                                <div class="line-clamp-2">
                                                                    <a href="{{ __url($item->encode_title) }}"
                                                                        class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                                        {{ $item->title }}
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                                    <span>{{ $item->postByUser->full_name ?? localize('unknown') }}</span>
                                                                    <svg width="12" height="12"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 448 512">
                                                                        <path fill="currentColor"
                                                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                                    </svg>
                                                                    <span>{{ news_publish_date_format($item->publish_date) }}</span>
                                                                    <svg width="14" height="14"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512">
                                                                        <path fill="currentColor"
                                                                            d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                                                    </svg>
                                                                    <span>{{ $item->comments_count ?? 0 }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="item cursor-pointer py-2">
                            <a href="{{ __url($menu->slug) }}"
                                class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                                @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>{{ Str::upper($menu->menu_level) }}

                                <span class="rtl:scale-x-[-1]">
                                    <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                        width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                    </svg>
                                </span>
                            </a>
                            <div
                                class="sub-menu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out bg-neutral-50 dark:bg-neutral-800 absolute top-full left-7 w-[96%] shadow-md z-20">
                                <div
                                    class="grid grid-cols-4 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse">
                                    @foreach ($menu->top_news as $item)
                                        <div class="overflow-hidden px-2">
                                            <a href="{{ __url($item->encode_title) }}"
                                                class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                    src="{{ $item->photoLibrary ? $item->photoLibrary->image_base_url : asset('assets/news-card-view.png') }}"
                                                    alt="News" />
                                            </a>
                                            <div class="p-2 space-y-2">
                                                <div class="line-clamp-2">
                                                    <a href="{{ __url($item->encode_title) }}"
                                                        class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                        {{ $item->title }}
                                                    </a>
                                                </div>

                                                <div
                                                    class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                    <span>{{ $item->postByUser->full_name ?? localize('unknown') }}</span>
                                                    <svg width="12" height="12"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path fill="currentColor"
                                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                    </svg>
                                                    <span>{{ news_publish_date_format($item->publish_date) }}</span>
                                                    <svg width="14" height="14"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M168.2 384.9c-15-5.4-31.7-3.1-44.6 6.4c-8.2 6-22.3 14.8-39.4 22.7c5.6-14.7 9.9-31.3 11.3-49.4c1-12.9-3.3-25.7-11.8-35.5C60.4 302.8 48 272 48 240c0-79.5 83.3-160 208-160s208 80.5 208 160s-83.3 160-208 160c-31.6 0-61.3-5.5-87.8-15.1zM26.3 423.8c-1.6 2.7-3.3 5.4-5.1 8.1l-.3 .5c-1.6 2.3-3.2 4.6-4.8 6.9c-3.5 4.7-7.3 9.3-11.3 13.5c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c5.1 0 10.2-.3 15.3-.8l.7-.1c4.4-.5 8.8-1.1 13.2-1.9c.8-.1 1.6-.3 2.4-.5c17.8-3.5 34.9-9.5 50.1-16.1c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9zM144 272a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm80 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                                    </svg>
                                                    <span>{{ $item->comments_count ?? 0 }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (isset($allRssFeeds) && $allRssFeeds->isNotEmpty())
                    @if ($allRssFeeds->count() > 1)

                        <div class="item cursor-pointer py-2">
                            <a href="{{ __url('rss-news') }}"
                                class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                                @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>
                                {{ strtoupper(localize('rss_news')) }}

                                <span class="rtl:scale-x-[-1]">
                                    <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                        width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                    </svg>
                                </span>
                            </a>

                            <div
                                class="sub-menu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out bg-neutral-50 dark:bg-neutral-800 absolute top-full left-7 w-[96%] shadow-md z-20">
                                <div class="grid grid-cols-5">
                                    <div id="category_tabs" class="overflow-hidden py-4 px-4">
                                        @foreach ($allRssFeeds as $submenu)
                                            @if ($loop->iteration == 1)
                                                <a href="{{ __url('rss-news') }}"
                                                    data-tab="{{ $submenu['slug'] }}_all"
                                                    class="sub-item block my-1 text-base hover:text-red-500 dark:hover:text-red-500 text-red-600 dark:text-red-500 transition_3">
                                                    {{ localize('all') }}
                                                </a>
                                            @endif
                                            <a href="{{ __url( $submenu['slug']) }}" type="button"
                                                data-tab="{{ $submenu['slug'] }}"
                                                class="sub-item block my-1 text-base hover:text-red-500 dark:hover:text-red-500 text-gray-800 dark:text-white transition_3">
                                                {{ $submenu['feed_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="col-span-4">
                                        <div
                                            class="relative max-h-max min-h-[270px] xl:min-h-[300px] 2xl:min-h-[320px]">
                                            @foreach ($allRssFeeds as $submenu)
                                                @if ($loop->iteration == 1)
                                                    <div data-content="{{ $submenu['slug'] }}_all"
                                                        class="tab-content absolute inset-0 grid grid-cols-3 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse opacity-100 translate-y-0 pointer-events-auto transition-all duration-300 ease-in-out">

                                                        @foreach ($randomRssFeedsNews as $item)
                                                            <div class="overflow-hidden px-2">
                                                                <a href="{{ __url($item['encode_title']) }}"
                                                                    class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                                        src="{{ $item['image'] ? $item['image'] : asset('assets/news-card-view.png') }}"
                                                                        alt="" />
                                                                </a>
                                                                <div class="p-2 space-y-2">
                                                                    <div class="line-clamp-2">
                                                                        <a href="{{ __url($item['encode_title']) }}"
                                                                            class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                                            {{ $item['title'] }}
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                                        <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                                                        <svg width="12" height="12"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 448 512">
                                                                            <path fill="currentColor"
                                                                                d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                                        </svg>
                                                                        <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <div data-content="{{ $submenu['slug'] }}"
                                                    class="tab-content absolute inset-0 grid grid-cols-3 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse opacity-0 translate-y-2 pointer-events-none transition-all duration-300 ease-in-out">
                                                    @foreach (collect($allRssFeedsNews[$submenu['id']]['news'])->take(3) as $item)
                                                        <div class="overflow-hidden px-2">
                                                            <a href="{{ __url($item['encode_title']) }}"
                                                                class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                                    src="{{ $item['image'] ? $item['image'] : asset('assets/news-card-view.png') }}"
                                                                    alt="" />
                                                            </a>
                                                            <div class="p-2 space-y-2">
                                                                <div class="line-clamp-2">
                                                                    <a href="{{ __url($item['encode_title']) }}"
                                                                        class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                                        {{ $item['title'] }}
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                                    <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                                                    <svg width="12" height="12"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 448 512">
                                                                        <path fill="currentColor"
                                                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                                    </svg>
                                                                    <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else

                        <div class="item cursor-pointer py-2">
                            <a href="{{ __url('rss-news') }}"
                                class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                                @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>
                                {{ strtoupper(localize('rss_news')) }}

                                <span class="rtl:scale-x-[-1]">
                                    <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                        width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                    </svg>
                                </span>
                            </a>

                            <div
                                class="sub-menu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out bg-neutral-50 dark:bg-neutral-800 absolute top-full left-7 w-[96%] shadow-md z-20">
                                <div
                                    class="grid grid-cols-4 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse">

                                    @foreach (collect($allRssFeedsNews[$allRssFeeds[0]['id']]['news'])->take(4) as $item)
                                        <div class="overflow-hidden px-2">
                                            <a href="{{ __url($item['encode_title']) }}"
                                                class="w-full h-36 2xl:h-48 group overflow-hidden block">
                                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                    src="{{ $item['image'] ? $item['image'] : asset('assets/news-card-view.png') }}"
                                                    alt="" />
                                            </a>
                                            <div class="p-2 space-y-2">
                                                <div class="line-clamp-2">
                                                    <a href="{{ __url($item['encode_title']) }}"
                                                        class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                        {{ $item['title'] }}
                                                    </a>
                                                </div>

                                                <div
                                                    class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                    <span>{{ $item['author'] ?? localize('unknown') }}</span>
                                                    <svg width="12" height="12"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path fill="currentColor"
                                                            d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                    </svg>
                                                    <span>{{ news_publish_date_format($item['pubDate']) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endif


                @if (isset($allVedioNews) && $allVedioNews->isNotEmpty())
                    <div class="item cursor-pointer py-2">
                        <a href="{{ __url('videos') }}"
                            class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                            @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>{{ Str::upper(localize('video')) }}

                            <span class="rtl:scale-x-[-1]">
                                <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                    width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                </svg>
                            </span>
                        </a>
                        <div
                            class="sub-menu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out bg-neutral-50 dark:bg-neutral-800 absolute top-full left-7 w-[96%] shadow-md z-20">
                            <div class="grid grid-cols-4 py-4 px-2 divide-x dark:divide-neutral-600 rtl:divide-x-reverse">
                                @foreach ($allVedioNews as $video)
                                    <div class="overflow-hidden px-2">
                                        <figure class="relative w-full h-36 2xl:h-48 group overflow-hidden block">
                                            <a href="{{ __url($video->encode_title) }}" class="">
                                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                                    src="{{ get_image_url('/assets/thumbnail-image.jpg', $video->thumbnail_image) }}"
                                                    alt="{{ $video->image_alt }}" />
                                            </a>
                                            <a href="{{ __url($video->encode_title) }}"
                                                class="bg-neutral-800/20 hover:border-red-300 text-white hover:text-red-300 transition_3 border w-12 h-12 rounded-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex justify-center items-center group">
                                                <span
                                                    class="absolute inline-flex h-full w-full group-hover:animate-ping rounded-full group-hover:bg-red-300 opacity-75"></span>

                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.5 8.40192C20.5 9.55663 20.5 12.4434 18.5 13.5981L5 21.3923C3 22.547 0.499999 21.1036 0.499999 18.7942L0.5 3.20577C0.5 0.896366 3 -0.547006 5 0.607694L18.5 8.40192Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a>
                                        </figure>

                                        <div class="p-2 space-y-2">
                                            <div class="line-clamp-2">
                                                <a href="{{ __url($video->encode_title) }}"
                                                    class="text-neutral-800 dark:text-white dark:hover:text-brand-primary font-bold text-lg leading-6 transition_3 hover:text-brand-primary">
                                                    {{ $video->title }}
                                                </a>
                                            </div>

                                            <div class="text-neutral-500 capitalize flex items-center gap-1 text-sm">
                                                <span>{{ $video->postByUser->full_name ?? localize('unknown') }}</span>
                                                <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512">
                                                    <path fill="currentColor"
                                                        d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                                </svg>
                                                <span>{{ news_publish_date_format($video->publish_date) }}</span>
                                                <span>{{ views_format($video->total_view) }}&nbsp;{{ localize('view') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- more menu --}}
                <div class="item cursor-pointer py-2 relative">
                    <a class="sub-btn @if (!$themeSettings->text_color) text-white @endif flex justify-start items-center hover:transition_3 hover:text-red-600 active:text-red-600 side_nav_news"
                        @if (!mode() && $themeSettings->text_color) style="color: {{ $themeSettings->text_color }};" @endif>{{ Str::upper(localize('more')) }}

                        <span class="rtl:scale-x-[-1]">
                            <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512">
                                <path fill="currentColor"
                                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                            </svg>
                        </span>
                    </a>
                    <div
                        class="sub-menu overflow-hidden max-h-0 transition-max-height duration-300 ease-in-out bg-white dark:bg-neutral-800 absolute top-[calc(100%+4px)] left-0 w-max shadow-md z-20 dark:text-white">
                        <ul class="divide-y relative">
                            @foreach ($pageMenus as $page)
                                @if ($page->pagesubmenus->isNotEmpty())
                                    <li class="py-2 isolate relative overflow-hidden inner_menu">
                                        <div
                                            class="px-3 hover:text-brand-primary transition_3 flex gap-3 justify-between items-center">
                                            {{ $page->menu_level }}
                                            <span class="rtl:scale-x-[-1]">
                                                <svg class="absolute lg:relative right-0 transition_3 lg:ml-1 rtl:lg:mr-1 rtl:lg:ml-auto dropdown"
                                                    width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 320 512">
                                                    <path fill="currentColor"
                                                        d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <ul
                                            class="inner_sub_menu absolute top-0 left-0 opacity-0 bg-white dark:bg-neutral-700 z-20 max-w-2 w-0 divide-y shadow-md">
                                            @foreach ($page->pagesubmenus as $submenu)
                                                @php $menuLink = $submenu->content_type == 'links' ? $submenu->link_url : __url($submenu->slug); @endphp
                                                <li class="py-2">
                                                    <a class="px-3 block hover:text-brand-primary transition_3"
                                                        href="{{ $menuLink }}">{{ $submenu->menu_level }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    @php $menuLink = $page->content_type == 'links' ? $page->link_url : __url($page->slug); @endphp
                                    <li class="py-2">
                                        <a class="px-3 block hover:text-brand-primary transition_3"
                                            href="{{ $menuLink }}">{{ $page->menu_level }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search button -->
        @include('themes.news.components.common.search-button')

    </div>
</section>
