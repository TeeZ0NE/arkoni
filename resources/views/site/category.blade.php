@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('category', $data['category']->name) !!}

    <div class="seo-block-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">{{ $data['category']->h1 }}</h1>
                    {!! $data['category']->seo_text !!}
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                @foreach($data['sub-categories'] as $item)
                    <div class="col-md-3">
                        <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                            <img class="img-fluid" src="{{ asset('/storage/img/'.$item->photo) }}" alt="">
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

    <div class="seo-block-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">{{$data['category']->h2}}</h2>
                    {!! $data['category']->seo_text_2 !!}
                </div>
            </div>
        </div>
    </div>

    @include('site._services')
@endsection