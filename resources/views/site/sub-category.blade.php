@extends('site.index')

@section('content')

    {!! Breadcrumbs::render('sub-category', [
    'category_name' => $data['sub-category']->category_name,
    'category_slug' => $data['sub-category']->category_slug,
    'sub-category' => $data['sub-category']->name]) !!}

    <div class="container">
        <div class="row">
            <aside class="col-md-3">
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
                @include('site._calc-aside')
                @include('site._contacts-aside')
            </aside>
            <div class="col-md-9">
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
                            <div class="col-md-3">
                                <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                                    <img class="img-fluid" src="{{ asset('/storage/img/'.$item->photo) }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-6 text">
                                <header class="title">
                                    <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">{{ $item->name }}</a>
                                </header>
                                <ul class="commerce">
                                    <li class="promotion">@lang('general.promotion')</li>
                                    <li class="top-sales">@lang('general.top-sales')</li>
                                    <li class="exclusive">@lang('general.exclusive')</li>
                                </ul>
                                <p class="entity-text">{{ do_excerpt($item->desc, 25) }}</p>
                            </div>
                            <div class="col-md-3 info">
                                <div class="call-we">@lang('sub-category.call-we'):</div>
                                <div class="phone"><a
                                            href="tel:{{ config('contacts.phone-1-alt') }}">{{ config('contacts.phone-1-alt') }}</a>
                                </div>
                                @if($item->price != 0 || $item->old_price != 0)
                                    @if($item->old_price != 0 && $item->price == 0)
                                        <div class="price">{{ number_format($item->old_price, 2, '.', '') }} @lang('general.uah')</div>
                                    @elseif($item->old_price == 0 && $item->price != 0)
                                        <div class="price">{{ number_format($item->price, 2, '.', '') }} @lang('general.uah')</div>
                                    @else
                                        <span class="old-price">{{ number_format($item->price, 2, '.', '') }} @lang('general.uah')</span>
                                        <div class="price">{{ number_format($item->old_price, 2, '.', '') }} @lang('general.uah')</div>
                                    @endif
                                @else
                                    <div class="">@lang('sub-category.specify')</div>
                                @endif
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

    {{--{{ print_array($data) }}--}}
@endsection