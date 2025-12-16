@if ($paginator->hasPages())
<nav class="d-flex justify-content-center mt-3">
    <ul class="pagination tour-pagination mb-0">

        {{-- Nút Trước --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Trước</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Trước</a>
            </li>
        @endif

        {{-- Các trang --}}
        @foreach ($elements as $element)

            {{-- Dấu ... --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Danh sách số --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Nút Sau --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Sau</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Sau</span>
            </li>
        @endif

    </ul>
</nav>
@endif
