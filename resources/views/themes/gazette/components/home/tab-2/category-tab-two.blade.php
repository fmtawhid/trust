<!-- section head -->
<div
    class="md:flex justify-between gap-4 items-center mb-4">
    <h1
        class="inline-block text-theme-five-primary dark:text-white text-lg font-semibold uppercase pb-1  relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-theme-five-primary dark:before:bg-white before:z-10 before:-bottom-[3px] before:w-full md:before:w-20 mb-4 md:mb-0">
        {{ $sectionTwoNews['rightNews'][0]->category->category_name }}
    </h1>

    <!-- Tab button section -->
    <ul id="tabs" class="flex gap-4 md:gap-6 text-base text-neutral-500 cursor-pointer">
        <li class="tab_gazette2 tab_nav_link" data-tab="all">{{ localize('all') }}</li>
        @if ($sectionTwoRightAllSubNews->isNotEmpty())
            @foreach ($sectionTwoRightAllSubNews as $data)
                <li class="tab_gazette2" data-tab="{{ $data['subcategory']->slug }}">
                    {{ strtoupper($data['subcategory']->category_name) }}</li>
            @endforeach
        @endif
    </ul>
</div>

<!-- Tab Content section -->
<div id="tab-content" class="relative mt-6">
    <!-- All Category  -->
    @include('themes.gazette.components.home.tab-2.all-news')

    <!-- Sub Category  -->
    @if ($sectionTwoRightAllSubNews->isNotEmpty())
        @foreach ($sectionTwoRightAllSubNews as $secTwoRightSubData)
            @include('themes.gazette.components.home.tab-2.sub-tab-content', [
                'secTwoRightSubData' => $secTwoRightSubData,
            ])
        @endforeach
    @endif
</div>
