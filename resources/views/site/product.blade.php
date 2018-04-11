@extends('site.index')

@section('content')

    {{ Breadcrumbs::render('product', $data['item']->$item_method['name']) }}

    <div id="item" class="item">
        <div id="aggregate-rating" class="aggregate-rating" itemscope itemtype="http://schema.org/Product">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="{{ asset('/storage/img/'.$data['item']->item_photo) }}" alt="">
                        <div id="rating-block" class="rating-block">
                            @include('site._ratings')
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="title" itemprop="name">{{ $data['item']->$item_method['name'] }}</div>
                        <div class="clearfix"></div>
                        @if(count($data['item']->getItemShortcut) != 0)
                            <ul class="commerce">
                                @foreach($data['item']->getItemShortcut as $shc)
                                    <li class="{{$shc->name}}">@lang('general.' . $shc->name)</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="price-block offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            @if($data['item']->price != 0 || $data['item']->old_price != 0)
                                @if($data['item']->old_price != 0 && $data['item']->price == 0)
                                    <span itemprop="price"
                                          class="price">{{ number_format($data['item']->old_price, 2, '.', '') }}</span>
                                    <span>@lang('general.uah')</span>
                                @elseif($data['item']->old_price == 0 && $data['item']->price != 0)
                                    <span itemprop="price"
                                          class="price">{{ number_format($data['item']->price, 2, '.', '') }} </span>
                                    <span>@lang('general.uah')</span>
                                @else
                                    <span class="old-price">{{ number_format($data['item']->price, 2, '.', '') }} </span>
                                    <span>@lang('general.uah')</span>
                                    <span itemprop="price"
                                          class="price">{{ number_format($data['item']->old_price, 2, '.', '') }} </span>
                                    <span>@lang('general.uah')</span>
                                @endif
                            @else
                                <span class="specify price">@lang('sub-category.specify')</span>
                                <span itemprop="price" class="price-zero">0</span>
                            @endif
                            <link itemprop="availability" href="http://schema.org/InStock"/>
                            <span class="availability">@lang('product.in-stock')</span>
                            <span class="priceCurrency" itemprop="priceCurrency"
                                  content="UAH">@lang('general.uah')</span>
                        </div>
                        @if(count($item_attrs) != 0)
                            <ul class="params">
                                @foreach($item_attrs as $ia)
                                    <li><i class="fas fa-check"></i><strong>{{ $ia->attributesLang[$column] }}:</strong>
                                        <span>{{ $ia->value }}</span></li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="phone-block">
                            @lang('product.arrange')
                                <div class="phone"><i class="fas fa-phone"></i>
                                    <a href="tel:{{config('contacts.phone-1-alt')}}">{{ config('contacts.phone-1-alt') }}</a>
                                </div>
                        </div>
                    </div>
                    @if(count($data['tags']) > 0)
                        <div class="col-md-12">
                            <ul class="tags">
                                @foreach($data['tags'] as $tag_key=>$tag_value)
                                    <li>
                                        <a href="{{ LaravelLocalization::LocalizeURL('/' . $tag_key) }}">#{{$tag_value}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="seo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">@lang('product.desc')</div>
                    {!! $data['item']->$item_method['description']  !!}
                </div>
            </div>
        </div>
    </div>

    <div class="often-buy">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="title">@lang('product.often-buy.title')</div>
                </div>
                @if(count($data['same_items']) > 0)
                    @foreach($data['same_items'] as $item)
                        <div class="col-sm-6 col-lg-3">
                            <div class="block">
                                <img class="img-fluid" src="{{ asset('storage/img/' . $item->item_photo) }}" alt="">
                                <div class="desc">{{ $item->$item_method['name'] }}</div>
                                @if($item->price != 0 || $item->old_price != 0)
                                    @if($item->old_price != 0 && $item->price == 0)
                                        <span itemprop="price"
                                              class="price">{{ number_format($item->old_price, 2, '.', '') }}
                                            <span>@lang('general.uah')</span></span>
                                    @elseif($item->old_price == 0 && $item->price != 0)
                                        <span itemprop="price"
                                              class="price">{{ number_format($item->price, 2, '.', '') }}
                                            <span>@lang('general.uah')</span></span>
                                    @else
                                        <span class="old-price">{{ number_format($item->price, 2, '.', '') }}
                                            <span>@lang('general.uah')</span></span>
                                        <span itemprop="price"
                                              class="price">{{ number_format($item->old_price, 2, '.', '') }}
                                            <span>@lang('general.uah')</span></span>
                                    @endif
                                @else
                                    <span class="specify price">@lang('sub-category.specify')</span>
                                @endif
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/' . $item->item_url_slug) }}">@lang('general.learn-more')
                                        <i class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @include('site._services')

@endsection