<div class="tab-pane1 opacity-100 translate-y-0 transition-all duration-500" data-content="all">
    <div
        class="grid md:grid-cols-2 xl:grid-cols-4 gap-3"> 
        @foreach ($sectionTwoNews['leftNews']->chunk(4) as $chunkData)
            @include('themes.gazette.components.home.tab-1.tab-common-card', ['allTabData' => $chunkData])
        @endforeach
    </div>

</div>

