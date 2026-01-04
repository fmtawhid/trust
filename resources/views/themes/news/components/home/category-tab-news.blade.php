<section class="my-6">
  <!-- section head -->
  <div
    class="flex justify-between gap-2 items-center mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 rtl:before:left-auto rtl:before:right-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-20">
    <h1 class="text-brand-primary text-lg font-semibold uppercase">
      {{ $sectionThreeAllNews[0]->category->category_name }}
    </h1>
    <!-- Tab button section -->
    <ul
      id="tabs"
      class="flex gap-4 md:gap-6 text-base text-neutral-500 cursor-pointer">
      <li class="tab_news tab_nav_link" data-tab="all">{{ localize('all') }}</li>
        @if ($sectionThreeAllSubNews->isNotEmpty())
          @foreach ($sectionThreeAllSubNews as $data)
            <li class="tab_news" data-tab="{{ $data['subcategory']->slug }}">
              {{ strtoupper($data['subcategory']->category_name) }}
            </li>
          @endforeach
        @endif
    </ul>
  </div>
  
  <!-- Tab Content section -->
  <div id="tab-content" class="relative mt-6">
    <!-- All Category  -->
    @include('themes.news.components.home.tab-content.all-tab-content')
    
    <!-- Sub Category  -->
    @if ($sectionThreeAllSubNews->isNotEmpty())
      @foreach ($sectionThreeAllSubNews as $secThreeSubData)
        @include('themes.news.components.home.tab-content.sub-tab-content', [
          'secThreeSubData' => $secThreeSubData,
        ])
      @endforeach
    @endif
  </div>

</section>
