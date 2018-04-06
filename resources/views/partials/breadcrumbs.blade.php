@if (count($breadcrumbs))
    <?php $possition = 1; ?>
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                            @foreach ($breadcrumbs as $breadcrumb)

                                @if ($breadcrumb->url && !$loop->last)
                                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"
                                        class="breadcrumb-item"><a itemprop="item" href="{{ $breadcrumb->url }}"><span
                                                    itemprop="name">{{ $breadcrumb->title }}</span>
                                            <meta itemprop="position" content="{{ $possition++ }}"/>
                                        </a></li>
                                @else
                                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"
                                        class="breadcrumb-item active"><span
                                                itemprop="name">{{ $breadcrumb->title }}</span>
                                        <meta itemprop="position" content="{{ $possition++ }}"/>
                                    </li>
                                @endif

                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


@endif