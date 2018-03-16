@extends('site.index')

@section('content')

    {!! Breadcrumbs::render('catalog') !!}

    <div class="seo-block-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">Каталог товаров</h1>
                    <p>Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non
                        sapien. Duis sagittis imperdiet eros ac posuere. Nunc sapien diam, sollicitudin commodo posuere
                        non, aliquam nec urna.</p>
                    <p>Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue
                        vulputate quis nec sapien.
                        Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci
                        non sapien. Duis sagittis
                        imperdiet eros ac posuere. Nunc sapien diam, sollicitudin commodo posuere non, aliquam nec
                        urna.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                @foreach($data['category'] as $item)
                    <div class="col-md-3">
                        <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                            <img src="{{ asset('/storage/img/'.$item->photo) }}" alt="">
                        </a>
                        <div class="name">{{ $item->name }}</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">@lang('general.learn-more')
                                <i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('site._producers')

    <div class="seo-block-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2 class="title">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>
                        <p>Quisque sodales mi in mi congue, sed laoreet velit rutrum. Vestibulum et purus enim. Vivamus
                            bibendum ligula in turpis hendrerit, ut luctus urna tempus. Phasellus vulputate quam eget
                            diam tincidunt, ut
                            sollicitudin lacus iaculis. Morbi accumsan porta eros at viverra. Vivamus velit enim,
                            sodales tempus fermentum eget,
                            facilisis id massa. Curabitur dictum, ex eget gravida aliquet, nisl ipsum mattis neque, sed
                            gravida dolor mi vel mi.
                            Aliquam in tortor posuere est feugiat ultricies. Suspendisse eu elit at purus molestie
                            vehicula. Maecenas varius
                            molestie dui feugiat vehicula. </p>
                        <p>Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue
                            vulputate quis nec sapien.
                            Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus
                            orci non sapien. Duis sagittis
                            imperdiet eros ac posuere. Nunc sapien diam, sollicitudin commodo posuere non, aliquam nec
                            urna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site._certificates')

    @include('site._services')

{{--    {{ print_array($data['category']) }}--}}

@endsection