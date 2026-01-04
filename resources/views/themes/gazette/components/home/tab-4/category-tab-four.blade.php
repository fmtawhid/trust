<!-- section head -->
<div
    class="flex flex-col lg:flex-row justify-between gap-2 lg:items-center mb-4">
    <h1 class="text-theme-five-primary text-lg font-semibold uppercase pb-1  relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-theme-five-primary before:z-10 before:-bottom-[3px] before:w-full md:before:w-20">
        {{ $sectionFourNews[0]->category->category_name }}
    </h1>

    <!-- Tab button section -->
    <ul id="tabs" class="flex gap-4 md:gap-6 text-base text-neutral-500 cursor-pointer">
        <li class="tab_gazette4 tab_nav_link" data-tab="all">{{ localize('all') }}</li>
        @if ($sectionFourAllSubNews->isNotEmpty())
            @foreach ($sectionFourAllSubNews as $data)
                <li class="tab_gazette4" data-tab="{{ $data['subcategory']->slug }}">
                    {{ strtoupper($data['subcategory']->category_name) }}</li>
            @endforeach
        @endif
    </ul>
</div>

<!-- Tab Content section -->
<div id="tab-content" class="relative mt-6">
    <!-- All Category  -->
    @include('themes.gazette.components.home.tab-4.all-news')

    <!-- Sub Category  -->
    @if ($sectionFourAllSubNews->isNotEmpty())
        @foreach ($sectionFourAllSubNews as $secFourSubData)
            @include('themes.gazette.components.home.tab-4.sub-tab-content', [
                'secFourSubData' => $secFourSubData,
            ])
        @endforeach
    @endif
</div>
