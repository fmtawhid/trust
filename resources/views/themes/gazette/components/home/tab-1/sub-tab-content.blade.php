<div
  class="tab-pane1 opacity-0 translate-y-4 absolute top-0 left-0 w-full transition-all duration-500 pointer-events-none"
    data-content="{{ $secTwoSubData['subcategory']->slug }}">

    <div
        class="grid md:grid-cols-2 xl:grid-cols-4 gap-3">
        @foreach ($secTwoSubData['news']->chunk(4) as $chunkData)
          @include('themes.gazette.components.home.tab-1.tab-common-card', ['allTabData' => $chunkData])
        @endforeach
    </div>

</div>
