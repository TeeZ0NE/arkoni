@extends('site.index')

@section('content')

    {!! Breadcrumbs::render('catalog') !!}

    <div class="seo-block-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">@lang('catalog-and-category.h1')</h1>
                    @lang('catalog-and-category.seo-1')
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                @foreach($data['category'] as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
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

    @include('site._producers')

    <div class="seo-block-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">@lang('catalog-and-category.h2')</h2>
                    @lang('catalog-and-category.seo-2')
                </div>
            </div>
        </div>
    </div>

    @include('site._certificates')

    @include('site._services')

@endsection