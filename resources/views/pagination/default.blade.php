{{--@if ($paginator->lastPage() > 1)--}}
    {{--<nav>--}}
        {{--<ul class="pagination justify-content-end">--}}
            {{--<li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">--}}
                {{--<a class="page-link" href="{{ $paginator->url(1) }}">@lang('pagination.previous')</a>--}}
            {{--</li>--}}
            {{--@for ($i = 1; $i <= $paginator->lastPage(); $i++)--}}
                {{--<li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">--}}
                    {{--<a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>--}}
                {{--</li>--}}
            {{--@endfor--}}
            {{--<li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">--}}
                {{--<a class="page-link"--}}
                   {{--href="{{ $paginator->url($paginator->currentPage()+1) }}">@lang('pagination.next')</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</nav>--}}
{{--@endif--}}

@if ($paginator->hasPages())
    <ul class="pagination justify-content-end">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
        @endif
    </ul>
@endif
