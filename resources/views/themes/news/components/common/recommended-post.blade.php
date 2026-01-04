<section class="space-y-3 md:border dark:border-neutral-800 md:p-2 md:rounded-md">
    <h2 class="@if (!$themeSettings->background_color || mode()) bg-neutral-900 @endif @if (!$themeSettings->text_color || mode()) text-white @endif p-2 uppercase mb-2"
        style="@if (!mode() && $themeSettings->background_color) background-color: {{ $themeSettings->background_color }}; @endif @if (!mode() && $themeSettings->text_color) color: {{ $themeSettings->text_color }}; @endif">
        {{ localize('recommended_posts') }}
    </h2>

    <!-- Posts -->
    @foreach ($recommendedPosts as $recommendedPost)
        <div class="grid grid-cols-3 gap-2 items-center">
            <figure class="w-full h-20 md:h-32 objext-cover lg:h-20">
                <img class="w-full h-full object-cover"
                    src="{{ isset($recommendedPost->photoLibrary->image_base_url) ? $recommendedPost->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}"
                    alt="{{ $recommendedPost->image_alt }}" />
            </figure>
            <a href="{{ __url($recommendedPost->encode_title) }}"
                class="col-span-2 line-clamp-3 text-neutral-600 hover:text-brand-primary transition_3 dark:text-neutral-50 dark:hover:text-brand-primary">
                {{ $recommendedPost->title }}
            </a>
        </div>
    @endforeach
</section>
