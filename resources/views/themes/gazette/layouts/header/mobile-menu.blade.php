<section class="container mt-16 xl:hidden">
    <ul class="mobile_category_menu flex items-center gap-4 overflow-x-auto overflow-y-hidden">
        <li><a href="{{ __url('/') }}"
                class="uppercase text-nowrap whitespace-nowrap text-base font-semibold dark:text-white transition_3 {{ request()->segment(1) === null ? 'text-blue-800 dark:!text-blue-600' : '' }}">{{ localize('home') }}</a>
        </li>
        @foreach ($mainMenus as $menu)
            <li><a href="{{ __url($menu->slug) }}"
                    class="uppercase text-nowrap whitespace-nowrap text-base font-semibold dark:text-white transition_3 {{ request()->segment(1) === $menu->slug ? 'text-blue-800 dark:!text-blue-600' : '' }}">{{ $menu->menu_level }}</a>
            </li>
        @endforeach
        <li><a href="{{ __url('videos') }}"
                class="uppercase text-nowrap whitespace-nowrap text-base font-semibold dark:text-white transition_3 {{ request()->segment(1) === 'videos' ? 'text-blue-800 dark:!text-blue-600' : '' }}">{{ localize('video') }}</a>
        </li>
    </ul>
</section>
