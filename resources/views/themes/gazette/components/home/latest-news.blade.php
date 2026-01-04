<section class="border dark:border-neutral-800 p-2 rounded-md">
    <div class="@if (!$themeSettings->background_color || mode()) bg-neutral-900 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase mb-2"
        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif"">
        {{ localize('latest_post') }}
    </div>

    <div class="space-y-3">
        @foreach ($latestNews as $latestNewsItem)
            <div class="grid grid-cols-3 gap-2 items-center first:pt-3">
                <a href="{{ __url($latestNewsItem->encode_title) }}"
                    class="col-span-2 font-semibold text-theme-three hover:text-cyan-600 dark:hover:text-cyan-600 dark:text-gray-200 leading-5 line-clamp-3 transition_3">
                    {{ $latestNewsItem->title }}
                </a>
                <figure class="w-full h-20 md:h-24 lg:h-28 xl:h-20 objext-cover">
                    <img class="w-full h-full object-cover"
                        src="{{ isset($latestNewsItem->photoLibrary->image_base_url) ? $latestNewsItem->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                        alt="{{ $latestNewsItem->image_alt }}" />
                </figure>
            </div>
            <hr class="h-px last:hidden bg-neutral-200 border-0 dark:bg-neutral-700" />
        @endforeach
    </div>

</section>
