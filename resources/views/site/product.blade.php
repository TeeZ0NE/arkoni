@extends('site.index')

@section('content')

    {{ Breadcrumbs::render('home') }}

    <div id="item" class="item">
        <div id="aggregate-rating" class="aggregate-rating" itemscope itemtype="http://schema.org/Product">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img itemprop="image" src="" class="img-thumbnail" alt="">
                        <div id="rating-block" class="rating-block">
                            @include('site._ratings')
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="title" itemprop="name">CM 11 Клеящая смесь Ceramic CM 11 Клеящая смесь Ceramic</div>
                        <ul class="commerce">
                            <li class="stock"><i class="fas fa-tag"></i> @lang('products.stock')</li>
                            <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('products.top-sales')</li>
                            <li class="recommend"><i class="fas fa-certificate"></i> @lang('products.recommend')
                            </li>
                        </ul>
                        <div class="price-block">
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <span class="offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <span itemprop="price" content="180.00">{{-- set price--}}
                                    <span class="price">180.00 <span class="priceCurrency" itemprop="priceCurrency"
                                                                     content="uah">@lang('general.uah')</span></span>
                                </span>
                                <link itemprop="availability" href="http://schema.org/InStock"/><span
                                        class="availability">@lang('product.in-stock')</span>
                            </span>
                        </div>
                        <div class="for">Для облицовки керамической плиткой внутри и снаружи зданий</div>
                        <ul class="params">
                           <li><i class="fas fa-check"></i><strong>Упаковка:</strong> <span>5 кг</span></li>
                           <li><i class="fas fa-check"></i><strong>Страна производитель:</strong> <span>Украина</span></li>
                           <li><i class="fas fa-check"></i><strong>Упаковка:</strong> <span>5 кг
                                   Страна производитель: Украина
                                   Состав: цемент с минеральными наполнителями и органическими
                                   модификаторами</span></li>
                        </ul>
                        <div class="phone-block">
                            @lang('product.arrange')
                                <div class="phone"><i class="fas fa-phone"></i> {{ config('contacts.phone-1-alt') }}</div>
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
                    <div class="title">Характеристика штукатурки Cersanit</div>

                    <p>Производитель оставляет за собой право без предварительного уведомления изменять цены на
                        продукцию, а также ее названия, параметры, упаковку и другие характеристики. Последняя
                        актуальная информация для потребителей, предусмотренная действующим законодательством, находится
                        на упаковке продукции, а также в сопроводительной документации. Претензии со ссылкой на любые
                        другие источники информации производителем не принимаются и не рассматриваются.
                    </p>
                    <p> Последняя актуальная информация для потребителей, предусмотренная действующим законодательством,
                        находится на упаковке продукции, а также в сопроводительной документации. Претензии со ссылкой
                        на любые другие источники информации производителем не принимаются и не рассматриваются.</p>
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

@endsection