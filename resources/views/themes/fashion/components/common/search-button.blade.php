{{-- Search button  --}}
<div class="search_wrapper relative">
    <button type="button"
        class="btn_search w-9 h-9 leading-[40px] flex justify-center items-center rounded-full text-neutral-600 dark:text-neutral-50 xl:text-white bg-neutral-100 dark:bg-theme-six-secondary xl:bg-theme-six-primary dark:xl:bg-theme-six-primary/50">
        <svg width="16" height="16" class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                fill="currentColor" />
        </svg>
    </button>
    {{-- Search section --}}
    <form action="{{ __url('search') }}" method="GET"
        class="search_section hidden absolute z-99 top-[calc(100%+11px)] right-0 rtl:right-auto rtl:left-0 bg-white dark:bg-neutral-700 shadow-md w-[320px]">
        <input type="text" required name="q" id="q" placeholder="Search..." autocomplete="off"
            class="px-3 py-2 w-full bg-transparent dark:text-white">
        <button type="submit"
            class="w-9 h-[40px] leading-[40px] flex justify-center items-center text-white bg-neutral-800 xl:bg-theme-six-primary dark:bg-neutral-600 absolute right-0 top-0 rtl:right-auto rtl:left-0">
            <!-- SVG here -->
            <svg width="16" height="16" class="rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                    fill="currentColor" />
            </svg>
        </button>
    </form>
</div>
