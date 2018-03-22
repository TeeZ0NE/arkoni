@extends('site.index')

@section('content')

    <div class="front-banner">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('images/front-banner.png') }}" alt="">
                    <div class="shadow">
                        <h1 class="title">@lang('front.banner.title')</h1>
                        <div class="where">@lang('front.banner.where')</div>
                        <a class="go-to"
                           href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('general.learn-more')
                                <i
                                        class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{ asset('images/info-delivery.png') }}" alt="">
                    <div class="title">@lang('front.info.block-1.title')</div>
                    <div class="body">@lang('front.info.block-1.body')</div>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('images/info-oredr.png') }}" alt="">
                    <div class="title">@lang('front.info.block-2.title')</div>
                    <div class="body">@lang('front.info.block-2.body')</div>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('images/info-market.png') }}" alt="">
                    <div class="title">@lang('front.info.block-3.title')</div>
                    <div class="body">@lang('front.info.block-3.body')</div>
                </div>
            </div>
        </div>
    </div>

    <div class="choice">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">@lang('front.choice.title')</h2>
                    <ul>
                        <li class="items item-1">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-1.title')</div>
                                <div class="desc">@lang('front.choice.item-1.desc')</div>
                                <div class="price">@lang('front.choice.item-1.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-2">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-2.title')</div>
                                <div class="desc">@lang('front.choice.item-2.desc')</div>
                                <div class="price">@lang('front.choice.item-2.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-3">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-3.title')</div>
                                <div class="desc">@lang('front.choice.item-3.desc')</div>
                                <div class="price">@lang('front.choice.item-3.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-4">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-4.title')</div>
                                <div class="desc">@lang('front.choice.item-4.desc')</div>
                                <div class="price">@lang('front.choice.item-4.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-5">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-5.title')</div>
                                <div class="desc">@lang('front.choice.item-5.desc')</div>
                                <div class="price">@lang('front.choice.item-5.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-6">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-6.title')</div>
                                <div class="desc">@lang('front.choice.item-6.desc')</div>
                                <div class="price">@lang('front.choice.item-6.price')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('general.learn-more')<i
                                            class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="competitors">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col col-md-9">
                    <div class="title">@lang('front.competitors.title')</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>@lang('front.competitors.drywall')</th>
                            <th>@lang('front.competitors.paint')</th>
                            <th>@lang('front.competitors.param-3')</th>
                            <th>@lang('front.competitors.param-4')</th>
                            <th>@lang('front.competitors.wallpaper')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="top">
                            <td><img src="{{ asset('images/competitors-logo-1.png') }}" alt=""></td>
                            <td>@lang('general.from') <span class="price">134.00</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">134.00</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">134.00</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">134.00</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">134.00</span> @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td>Логотип 1</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td>Логотип 2</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td>Логотип 3</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td>Логотип 4</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 134.00 @lang('general.uah')</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="info-block">@lang('front.competitors.info')</div>
                </div>
            </div>
        </div>
    </div>

    <div class="best-offers">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">@lang('front.best-offers.title')</div>
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

    <div class="seo">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col col-md-10">
                    <h3 class="title">@lang('front.seo.title')</h3>
                    <div class="body">@lang('front.seo.body')</div>
                </div>
            </div>
        </div>
    </div>

    @include('site._services')

    <div class="comments">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">@lang('front.comments.title')</div>
                    <div id="comments-slider">
                        <div class="frame">
                            <img src="" alt="" class="img-thumbnail rounded-circle">
                            {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            <div class="name">@lang('front.comments.name-1')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.title-1')</span>
                                <div class="comment">@lang('front.comments.comment-1')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img src="" alt="" class="img-thumbnail rounded-circle">
                            {{--                            <img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            <div class="name">@lang('front.comments.name-1')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.title-1')</span>
                                <div class="comment">@lang('front.comments.comment-1')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img src="" alt="" class="img-thumbnail rounded-circle">
                            {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            <div class="name">@lang('front.comments.name-1')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.title-1')</span>
                                <div class="comment">@lang('front.comments.comment-1')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img src="" alt="" class="img-thumbnail rounded-circle">
                            {{--                            <img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            <div class="name">@lang('front.comments.name-1')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.title-1')</span>
                                <div class="comment">@lang('front.comments.comment-1')</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site._producers')

    @include('site._google-map')

@endsection