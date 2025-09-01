<x-web-layout>
    <section class="w-full h-screen overflow-hidden ">
        <div class="flex justify-center items-center flex-col mt-20">
            <figure>
                <img class="w-full h-full object-cover" src="{{ asset('/assets/404.png') }}" alt="" />
            </figure>
            <h2 class="my-6 text-4xl font-bold text-center text-theme-three dark:text-neutral-50">Sorry! Page not found
            </h2>
            <a href="{{ __url('/') }}"
                class="px-6 py-2.5 rounded-lg bg-theme-three hover:bg-theme-five-primary font-semibold text-white text-center capitalize">go
                to home</a>
        </div>
    </section>
</x-web-layout>
