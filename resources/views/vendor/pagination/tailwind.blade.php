@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="text-sm text-gray-600">
            Mostrando {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
        </div>

        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-gray-300 border border-gray-200 rounded-lg cursor-not-allowed">←</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">←</a>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1.5 text-sm text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">→</a>
            @else
                <span class="px-3 py-1.5 text-sm text-gray-300 border border-gray-200 rounded-lg cursor-not-allowed">→</span>
            @endif

        </div>
    </nav>
@endif