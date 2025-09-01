<section class="my-6">

    <!-- section head -->
    <div
        class="flex flex-col md:flex-row justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative md:before:absolute md:before:left-0 rtl:md:before:left-auto rtl:md:before:right-0 md:before:h-1 md:before:bg-brand-primary md:before:z-10 md:before:-bottom-[3px] md:before:w-20">
        <h1 class="text-brand-primary text-lg font-semibold uppercase">
            {{ $sectionThreeAllNews[0]->category->category_name }}
        </h1>

        <!-- Tab button section -->
        <ul id="tabs" class="flex gap-4 md:gap-6 text-base text-neutral-500 cursor-pointer">
            <li class="tab tab_nav_link" data-tab="all">{{ localize('all') }}</li>
            @if ($sectionThreeAllSubNews->isNotEmpty())
                @foreach ($sectionThreeAllSubNews as $data)
                    <li class="tab" data-tab="{{ $data['subcategory']->slug }}">
                        {{ strtoupper($data['subcategory']->category_name) }}</li>
                @endforeach
            @endif
        </ul>
    </div>

    <!-- Tab Content section -->
    <div id="tab-content" class="relative mt-6">
        <!-- All Category  -->
        @include('themes.classic.components.home.tab-content.all-tab-content')

        <!-- Sub Category  -->
        @if ($sectionThreeAllSubNews->isNotEmpty())
            @foreach ($sectionThreeAllSubNews as $secThreeSubData)
                @include('themes.classic.components.home.tab-content.sub-tab-content', [
                    'secThreeSubData' => $secThreeSubData,
                ])
            @endforeach
        @endif
    </div>

</section>
