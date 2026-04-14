@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center custom p-4">

            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link text-decoration-none">‹ Prev</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">‹ Prev</a>
                </li>
            @endif

            {{-- Current --}}
            <li class="page-item active">
                <span class="page-link">{{ $paginator->currentPage() }}</span>
            </li>

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next ›</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next ›</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
