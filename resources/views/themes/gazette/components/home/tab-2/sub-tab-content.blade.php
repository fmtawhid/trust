<div
  class="tab-pane2 opacity-0 translate-y-4 absolute top-0 left-0 w-full transition-all duration-500 pointer-events-none"
    data-content="{{ $secTwoRightSubData['subcategory']->slug }}">
    @include('themes.gazette.components.home.tab-2.common-tab-card', ['allTabData' => $secTwoRightSubData['news']])
</div>



