
<section class="grid md:grid-cols-2 gap-4 md:gap-6 my-6">
    @foreach ($topCatagoryLatestNews as $item)
        <div class="space-y-2 md:border-b dark:border-neutral-700 md:pb-4">
            <a
            href="#"
            class="text-lg font-semibold text-theme-three hover:text-cyan-600 dark:hover:text-cyan-600 dark:text-gray-200 leading-6 line-clamp-2 transition_3"
            >
            {{$item['title']}}
            </a>
            <p class="text-sm line-clamp-2 text-neutral-600 dark:text-neutral-400">
                {{$item['description']}}
            </p>
        </div>
        <hr class="h-px bg-neutral-200 border-0 dark:bg-neutral-700 md:hidden"/>
    @endforeach
</section>
