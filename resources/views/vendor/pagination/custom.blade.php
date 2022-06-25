@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&lsaquo;</span>
        </li> --}}
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                aria-label="@lang('pagination.previous')"><span aria-hidden="true"><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></span> <span class="sr-only">Previous</span></a>
        </li>
        @else
        {{-- <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
        aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li> --}}
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                aria-label="@lang('pagination.previous')"><span aria-hidden="true"><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></span> <span class="sr-only">Previous</span></a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
        @else
        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
        <li class="page-item active" aria-current="page"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        {{-- <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li> --}}
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                aria-label="@lang('pagination.next')"><span aria-hidden="true"><i class="fa fa-chevron-right"
                        aria-hidden="true"></i></span> <span class="sr-only">Next</span></a>
        </li>
        @else
        {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&rsaquo;</span>
        </li> --}}
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                aria-label="@lang('pagination.next')"><span aria-hidden="true"><i class="fa fa-chevron-right"
                        aria-hidden="true"></i></span> <span class="sr-only">Next</span></a>
        </li>
        @endif
    </ul>
</nav>
@endif

{{-- 
<a href="javascript:void(0)" class="active">1</a>
<a href="javascript:void(0)">2</a>
<a href="javascript:void(0)">3</a>
<a href="javascript:void(0)">4</a>
<a href="javascript:void(0)">5</a>
<a href="javascript:void(0)"><i class="fa fa-angle-double-right"></i></a> --}}
