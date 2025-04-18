@if ($paginator->hasPages())
    <nav class="custom-pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span class="disabled">&raquo;</span>
        @endif
    </nav>
@endif

<style>
    .custom-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .custom-pagination a {
        padding: 0.4rem 0.8rem;
        text-decoration: none;
        background-color: #eee;
        color: #333;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
    }

    .custom-pagination a:hover {
        background-color: #ccc;
    }

    .custom-pagination .active {
        background-color: #333;
        color: white;
        font-weight: bold;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
    }

    .custom-pagination .disabled {
        color: #999;
        padding: 0.4rem 0.8rem;
    }
</style>
