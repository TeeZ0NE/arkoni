@extends('site.index')

@section('content')

    {{ Breadcrumbs::render('product', $data['product']->name) }}

    <div id="item" class="item">
        <div id="aggregate-rating" class="aggregate-rating" itemscope itemtype="http://schema.org/Product">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('/storage/img/'.$data['product']->photo) }}" alt="">
                        <div id="rating-block" class="rating-block">
                            @include('site._ratings')
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="title" itemprop="name">{{ $data['product']->name }}</div>

                        <ul class="commerce">
                            <li class="promotion">@lang('general.promotion')</li>
                            <li class="top-sales">@lang('general.top-sales')</li>
                            <li class="exclusive">@lang('general.exclusive')</li>
                        </ul>

                        {{--@if($item->price != 0 || $item->old_price != 0)--}}
                        {{--@if($item->old_price != 0 && $item->price == 0)--}}
                        {{--<div class="price">{{ number_format($item->old_price, 2, '.', '') }} @lang('general.uah')</div>--}}
                        {{--@elseif($item->old_price == 0 && $item->price != 0)--}}
                        {{--<div class="price">{{ number_format($item->price, 2, '.', '') }} @lang('general.uah')</div>--}}
                        {{--@else--}}
                        {{--<span class="old-price">{{ number_format($item->price, 2, '.', '') }} @lang('general.uah')</span>--}}
                        {{--<div class="price">{{ number_format($item->old_price, 2, '.', '') }} @lang('general.uah')</div>--}}
                        {{--@endif--}}
                        {{--@else--}}
                        {{--<div class="">@lang('sub-category.specify')</div>--}}
                        {{--@endif--}}


                        <div class="price-block">
                            <span class="old-price">{{ number_format($data['product']->price, 2, '.', '') }} @lang('general.uah')</span>
                            <span class="offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <span itemprop="price"
                                      content="{{ number_format($data['product']->old_price, 2, '.', '') }}">{{-- set price--}}
                                    <span class="price">{{ number_format($data['product']->old_price, 2, '.', '') }}
                                        <span class="priceCurrency"
                                              itemprop="priceCurrency"
                                              content="uah">@lang('general.uah')</span></span>
                                </span>
                                <link itemprop="availability" href="http://schema.org/InStock"/><span
                                        class="availability">@lang('product.in-stock')</span>
                            </span>
                        </div>
                        @if($data['product']->attrs)
                            <ul class="params">
                                @foreach($data['product']->attrs as $key => $attr)
                                    <li><i class="fas fa-check"></i><strong>{{ $attr->name }}:</strong>
                                        <span>{{ $attr->value }}</span></li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="phone-block">
                            @lang('product.arrange')
                            <div class="phone"><i class="fas fa-phone"></i>{{ config('contacts.phone-1-alt') }}
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-md-12">--}}
                    {{--<ul class="tags">--}}
                    {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">#штукатурка фасадная</a></li>--}}
                    {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">#штукатурка фасадная</a></li>--}}
                    {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">#штукатурка фасадная</a></li>--}}
                    {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">#штукатурка фасадная</a></li>--}}
                    {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">#штукатурка фасадная</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="seo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">@lang('product.desc')</div>
                    {!! $data['product']->desc  !!}
                </div>
            </div>
        </div>
    </div>

    <div class="often-buy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">@lang('product.often-buy.title')</div>
                </div>
                <div class="col-md-3">
                    <div class="block block-1">
                        <img src="" alt="" class="img-thumbnail">
                        {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                        <div class="desc">Минеральная вата Роклайт 1200х600х50 мм 5,76 м2</div>
                        <div class="price">201.20 @lang('general.uah')</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')
                            <i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-1">
                        <img src="" alt="" class="img-thumbnail">
                        {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                        <div class="desc">Минеральная вата Роклайт 1200х600х50 мм 5,76 м2</div>
                        <div class="price">201.20 @lang('general.uah')</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')
                            <i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-1">
                        <img src="" alt="" class="img-thumbnail">
                        {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                        <div class="desc">Минеральная вата Роклайт 1200х600х50 мм 5,76 м2 b 5,76 м2</div>
                        <div class="price">201.20 @lang('general.uah')</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')
                            <i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-1">
                        <img src="" alt="" class="img-thumbnail">
                        {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                        <div class="desc">Минеральная вата Роклайт 1200х600х50 мм 5,76 м2</div>
                        <div class="price">201.20 @lang('general.uah')</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')
                            <i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site._services')

    <div class="text-center">
        id:{{$item->id}}<br>
        name:{{$item->$item_method['name']}}<br>
        desc:{{$item->$item_method['description']}}<br>
        price: {{$item->price}}<br>
        old_price:{{$item->old_price}}<br>
        brand:{{$item->brand['name']}}<br>
        tags name: @foreach($tags as $tag_key=>$tag_value)
            <a href="{{$tag_key}}">{{$tag_value}}</a>
        @endforeach
        <br>
        <img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo" class="img-fluid w-25"><br>
        shortcuts: @foreach($item->getItemShortcut as $sh){{$sh['name']}}::@endforeach<br>
        attributes: @foreach($item_attrs as $ia){{$ia->attributesLang[$column]}}-{{$ia->value}}<br>@endforeach<br>
    </div>
    <hr>
    <center>Same products</center>
    @isset($same_items)
        <div class="text-center">
            @foreach($same_items as $item)
                id:{{$item->id}}<br>
                url: {{$item->item_url_slug}}<br>
                name:{{$item->$item_method['name']}}<br>
                desc:{{$item->$item_method['description']}}<br>
                price: {{$item->price}}<br>
                old_price:{{$item->old_price}}<br>
                <br>
                <img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo" class="img-fluid w-25"><br>
            @endforeach
        </div>
    @endisset
@endsection