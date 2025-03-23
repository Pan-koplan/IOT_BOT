@if ($paginator->hasPages())
    <nav class="simple-pagination">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span class="pagination-link">&laquo; Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link ajax-pagination"
                        rel="prev">&laquo; Previous</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link ajax-pagination" rel="next">Next
                        &raquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span class="pagination-link">Next &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
