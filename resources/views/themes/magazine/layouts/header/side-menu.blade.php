@php
    $user = Auth::user();
    $name = $user->name ?? 'Abdullah Al Mamun';
    $initials = collect(explode(' ', $name))->map(fn($n) => strtoupper(substr($n, 0, 1)))->implode('');
    $initials = substr($initials, 0, 2);
    $hasImage = !empty($user->profile_image);
@endphp
<!-- Sidebar Modal Container start-->
<div id="mobileMenuModal" class="fixed inset-0 z-50 bg-black bg-opacity-60 hidden">
    <!-- Sidebar -->
    <div class="side-bar bg-black h-full p-6 pt-2 overflow-x-hidden overflow-y-auto shadow-md side_bar" id="sidebar">
        <!-- Close Button -->
        <button onclick="closeSidebar()"
            class="p-2 text-white bg-red-600 hover:bg-red-800 rounded-full w-8 h-8 flex items-center justify-center absolute top-1 right-1 transition_3 rtl:right-auto rtl:left-1">
            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                    fill="currentColor" />
            </svg>
        </button>

        <!-- Login / Registration -->
        @include('themes.magazine.components.common.login-button-sm')

        <!-- Your existing sidebar menu goes here -->
        <div class="menu w-full space-y-4 mt-6">
            <div class="item relative cursor-pointer">
                <a class="capitalize text-white flex justify-start items-center text-base hover:transition_3 side_nav"
                    href="{{ __url('/') }}">{{ Str::upper(localize('home')) }}</a>
            </div>

            @foreach ($mainMenus as $menu)
                @if ($menu->submenus->isNotEmpty())
                    <div class="item relative cursor-pointer">
                        <a
                            class="sub-btn text-white flex justify-between items-center text-base hover:transition_3 hover:text-red-600 active:text-red-600 side_nav">{{ Str::upper($menu->menu_level) }}

                            <span class="rtl:scale-x-[-1]">
                                <svg class="dropdown transition_3" width="16" height="16"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                </svg>
                            </span>
                        </a>
                        <div
                            class="sub-menu block max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                            @foreach ($menu->submenus as $submenu)
                                @if ($loop->iteration == 1)
                                    <a href="{{ __url($menu->slug) }}"
                                        class="sub-item my-1.5 ml-7 mr-1.5 pt-2 pb-1 text-white flex justify-start items-center text-base hover:transition_3 relative hover:text-red-500 active:text-red-500 side_nav">{{ localize('all') }}</a>
                                @endif
                                <a href="{{ __url($submenu->slug) }}"
                                    class="sub-item my-1.5 ml-7 mr-1.5 pt-2 pb-1 text-white flex justify-start items-center text-base hover:transition_3 relative hover:text-red-500 active:text-red-500 side_nav">{{ $submenu->menu_level }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="item relative cursor-pointer">
                        <a class="capitalize text-white flex justify-start items-center text-base hover:transition_3 side_nav"
                            href="{{ __url($menu->slug) }}">{{ Str::upper($menu->menu_level) }}</a>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Multi-language Start --}}
        @if ($languages->count() > 1)
            <div class="relative inline-block mt-6">
                <button type="button" id="dropdownButton"
                    class="text-white bg-theme-three transition_3 px-4 py-1.5 rounded-md">
                🌐 {{ $languages->firstWhere('value', app()->getLocale())->langname ?? '' }}
                </button>

                <ul id="dropdownMenu"
                    class="absolute left-0 rtl:right-0 rtl:left-auto mt-1 w-max bg-theme-three rounded-sm shadow-md overflow-hidden hidden z-50">
                    @foreach ($languages as $lang)
                        <li>
                            <a href="javascript:void(0)" data-lang="{{ $lang->value }}"
                                class="language_side block px-4 py-2 focus:bg-blue-900 focus:text-white
                                {{ $lang->value == app()->getLocale() ? 'bg-cyan-600 text-white' : 'text-white' }}">
                                {{ $lang->langname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Multi-language End --}}
    </div>
</div>
