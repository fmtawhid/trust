
  <div class="grid md:grid-cols-2 gap-4">
    @foreach ($topCatagoryLatestNews as $item)
        <div class="">
            <a
                href="#"
                class="block w-full h-52 lg:h-80 xl:h-48 object-cover group overflow-hidden"
            >
                <img
                class="w-full h-full object-cover group-hover:scale-105 transition_slow"
                src= {{$item['image']}}
                alt="News Category Large"
                />
            </a>
            <div class="py-3 space-y-2">
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
        </div>
    @endforeach
  </div>

