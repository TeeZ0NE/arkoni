@if (count($breadcrumbs))
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach ($breadcrumbs as $breadcrumb)

                                @if ($breadcrumb->url && !$loop->last)
                                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                                @else
                                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                                @endif

                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


@endif