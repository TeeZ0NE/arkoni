@extends('site.index')

@section('content')

    {!! Breadcrumbs::render('sub-category', [
    'category_name' => $data['sub-category']->category_name,
    'category_slug' => $data['sub-category']->category_slug,
    'sub-category' => $data['sub-category']->name]) !!}

    <div class="container">
        <div class="row">
            <aside class="col-sm-3">
                <div class="filters">
                    <form action="" class="filter-parameters">
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.brand')
                            </div>
                            <div class="parameters">
                                <ul>
                                    <li>
                                        <input id="id-1" type="checkbox" name="price">
                                        <label for="id-1">BauGut</label>
                                    </li>
                                    <li>
                                        <input id="id-2" type="checkbox" name="price">
                                        <label for="id-2">Baumit</label>
                                    </li>
                                    <li>
                                        <input id="id-3" type="checkbox" name="price">
                                        <label for="id-3">Belgips</label>
                                    </li>
                                    <li>
                                        <input id="id-4" type="checkbox" name="price">
                                        <label for="id-4">Ceresit</label>
                                    </li>
                                    <li>
                                        <input id="id-5" type="checkbox" name="price">
                                        <label for="id-5">Elite Gips</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.price')
                            </div>
                            <div class="parameters">
                                <ul>
                                    <li>
                                        <input id="low-to-high" type="radio" name="price">
                                        <label for="low-to-high">@lang('sub-category.low-to-high')</label>
                                    </li>
                                    <li>
                                        <input id="high-to-low" type="radio" name="price">
                                        <label for="high-to-low">@lang('sub-category.high-to-low')</label>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.alphabet')
                            </div>
                            <div class="parameters">
                                <ul>
                                    <li>
                                        <input id="a-to-z" type="radio" name="price">
                                        <label for="a-to-z">@lang('sub-category.a-to-z')</label>
                                    </li>
                                    <li>
                                        <input id="z-to-a" type="radio" name="price">
                                        <label for="z-to-a">@lang('sub-category.z-to-a')</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="calc">
                    <div class="header">
                        @lang('sub-category.calc.header')
                    </div>
                    <div class="body">
                        @lang('sub-category.calc.body')
                    </div>
                    <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                        @lang('front.services.block-1.go-to')
                            <i class="far fa-long-arrow-alt-right"></i>
                    </a>
                </div>
                <div class="contacts">
                    <div class="text-center">
                        @lang('sub-category.call')
                    </div>
                    <hr class="separator">
                    <ul class="phones text-center">
                        <li><i class="fas fa-phone"></i>{{ config('contacts.mobil') }}</li>
                        <li><i class="fas fa-phone"></i>{{ config('contacts.phone-1') }}</li>
                        <li><i class="fas fa-phone"></i>{{ config('contacts.phone-2') }}</li>
                    </ul>
                </div>
            </aside>
            <div class="col-sm-9">
                <div class="seo-block-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">{{ $data['sub-category']->h1 }}</h1>
                                {{ $data['sub-category']->seo_text }}
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($data['products'] as $key => $item)
                    <article class="item">
                        <div class="row">
                            <div class="col-md-3 thumbnail">
                                <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                                    <img src="{{ asset('/storage/img/'.$item->photo) }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-6 text">
                                <div class="title">
                                    <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                                        {{ $item->name }}
                                    </a>
                                </div>
                                <ul class="commerce">
                                    <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                    <li class="top-sales"><i
                                                class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                    <li class="recommend"><i
                                                class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                    </li>
                                </ul>
                                <div class="text-block">
                                    {{ $item->desc }}
                                </div>
                            </div>
                            <div class="col-md-3 info">
                                <div class="call-we">@lang('sub-category.call-we'):</div>
                                <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                                <span class="old-price">{{ number_format($item->price, 2, '.', '') }} @lang('general.uah')</span>
                                <div class="price">{{ number_format($item->new_price, 2, '.', '') }} @lang('general.uah')</div>
                                <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                                    @lang('general.learn-more')<i class="far fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
                {{ $data['products']->links('pagination.default') }}
            </div>
        </div>
    </div>


    <div class="seo-block-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2 class="title">{{ $data['sub-category']->h2 }}</h2>
                        {{ $data['sub-category']->seo_text_2 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--{{print_array($data['sub-category'])}}--}}
    {{--{{print_array($data['products'])}}--}}

@endsection