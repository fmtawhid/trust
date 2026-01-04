@foreach ($topCategoryData as $topCategoryDataItem )
  <div class="grid grid-cols-3 gap-4 items-center first:pt-3">
    <figure class="w-full h-20 objext-cover rounded-lg overflow-hidden">
      <img 
        class="w-full h-full object-cover" 
        src="{{ isset($topCategoryDataItem->news->photoLibrary->image_base_url) ? $topCategoryDataItem->news->photoLibrary->image_base_url : asset('/assets/opinion-avatar.png') }}" 
        alt="{{ $topCategoryDataItem->news->image_alt }}" />
    </figure>
    <a
      href="{{ __url($topCategoryDataItem->news->encode_title) }}"
      class="col-span-2 font-medium text-neutral-800 hover:text-blue-600 dark:hover:text-blue-600 dark:text-gray-200 leading-5 line-clamp-3 transition_3">
      {{$topCategoryDataItem->news->title}}
    </a>
  </div>
@endforeach
