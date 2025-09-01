<div
  class="tab-pane3 opacity-0 translate-y-4 absolute top-0 left-0 w-full transition-all duration-500 pointer-events-none"
    data-content="{{ $secThreeSubData['subcategory']->slug }}">
    @include('themes.gazette.components.home.tab-3.common-tab-card', ['allTabData' => $secThreeSubData['news']])
</div>



