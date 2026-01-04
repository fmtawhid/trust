<div
  class="tab-pane4 opacity-0 translate-y-4 absolute top-0 left-0 w-full transition-all duration-500 pointer-events-none pb-8"
    data-content="{{ $secFourSubData['subcategory']->slug }}">
    @include('themes.gazette.components.home.tab-4.common-tab-card', ['allTabData' => $secFourSubData['news']])
</div>
