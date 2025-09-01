<div
  class="border-y border-y-neutral-300 dark:border-neutral-800 grid md:grid-cols-2 md:py-4">
  
  <!-- Opinion List -->
  @foreach ($opinions as $index => $opinion)
    @php
      $position = $index % 4;
      $borderClasses = match ($position) {
          0 => 'flex items-center gap-4 py-6 md:py-10 border-r border-b pr-6 border-l md:border-l-0 px-4 md:px-0 dark:border-neutral-800',
          1 => 'flex items-center gap-4 py-6 md:py-10 border-b md:pl-6 pr-6 md:pr-0 border-x md:border-x-0 px-4 md:px-0 dark:border-neutral-800',
          2 => 'flex items-center gap-4 py-6 md:py-10 border-r border-b md:border-b-0 border-l md:border-l-0 pr-6 px-4 md:px-0 dark:border-neutral-800',
          3 => 'flex items-center gap-4 py-6 md:py-10 md:pl-6 pr-6 md:pr-0 border-x md:border-x-0 px-4 md:px-0 dark:border-neutral-800',
          default => '',
      };
    @endphp
    
    <div
      class="{{ $borderClasses }}">
      <!-- Avatar -->
      <div>
        <figure class="w-20 h-20 rounded-full overflow-hidden">
          <img
            class="w-full h-full object-cover"
            src="{{ get_image_url('/assets/opinion-avatar.png', $opinion->person_image) }}"
            alt="{{ $opinion->name }}"
          />
        </figure>
      </div>
      <div>
        <!-- Message -->
        <a href="{{ __url($opinion->encode_title) }}"
          class="text-xl font-semibold line-clamp-3 dark:text-neutral-50 dark:hover:text-brand-primary pr-2">
          {{ $opinion->title }}
        </a>
        <!-- Name -->
        <p class="text-neutral-600 dark:text-red-400 text-sm">{{ $opinion->name }}</p>
      </div>
    </div>
  @endforeach

</div>
