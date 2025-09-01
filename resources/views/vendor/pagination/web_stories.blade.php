@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
        <ul class="flex flex-wrap justify-center gap-1 text-sm line-height-25">

            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">{{ localize('first') }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->url(1) }}"
                       class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700 transition">
                        {{ localize('first') }}
                    </a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">←</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700 transition">
                        ←
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="px-3 py-2 text-gray-400">...</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-2 bg-brand-primary text-white font-semibold rounded">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700 transition">
                        →
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">→</span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                       class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700 transition">
                        {{ localize('last') }}
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">{{ localize('last') }}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
