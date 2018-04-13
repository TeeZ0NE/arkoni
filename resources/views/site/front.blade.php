@extends('site.index')

@section('content')

    <div class="front-banner">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="front-banner"></div>
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
                <div class="col-sm-6 col-md-4">
                    <img src="{{ asset('images/info-delivery.png') }}" alt="">
                    <div class="title">@lang('front.info.block-1.title')</div>
                    <div class="body">@lang('front.info.block-1.body')</div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <img src="{{ asset('images/info-oredr.png') }}" alt="">
                    <div class="title">@lang('front.info.block-2.title')</div>
                    <div class="body">@lang('front.info.block-2.body')</div>
                </div>
                <div class="col-sm-6 col-md-4">
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
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-podvesnye-potolki') }}">@lang('general.learn-more')
                                        <i
                                                class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-2">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-2.title')</div>
                                <div class="desc">@lang('front.choice.item-2.desc')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-laki-kraski') }}">@lang('general.learn-more')
                                        <i
                                                class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-3">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-3.title')</div>
                                <div class="desc">@lang('front.choice.item-3.desc')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-dobavki-v-beton') }}">@lang('general.learn-more')
                                        <i
                                                class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-4">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-4.title')</div>
                                <div class="desc">@lang('front.choice.item-4.desc')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-stroitelnaya-himiya') }}">@lang('general.learn-more')
                                        <i
                                                class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-5">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-5.title')</div>
                                <div class="desc">@lang('front.choice.item-5.desc')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-fasadnye-materialy') }}">@lang('general.learn-more')
                                        <i
                                                class="far fa-long-arrow-alt-right"></i></a>
                            </div>
                        </li>
                        <li class="items item-6">
                            <div class="shadow">
                                <div class="title">@lang('front.choice.item-6.title')</div>
                                <div class="desc">@lang('front.choice.item-6.desc')</div>
                                <a class="go-to"
                                   href="{{ LaravelLocalization::LocalizeURL('/c-utepliteli') }}">@lang('general.learn-more')
                                        <i
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
                <div class="col col-md-12 col-lg-9">
                    <div class="title">@lang('front.competitors.title')</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>@lang('front.competitors.param-1')</th>
                            <th>@lang('front.competitors.param-2')</th>
                            <th>@lang('front.competitors.param-3')</th>
                            <th>@lang('front.competitors.param-4')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="top">
                            <td><img src="{{ asset('images/competitors-logo-1.png') }}" alt=""></td>
                            <td>@lang('general.from') <span class="price">35.30</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">38.32</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">35.30</span> @lang('general.uah')</td>
                            <td>@lang('general.from') <span class="price">40.00</span> @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/competitors-logo-2.png') }}" alt=""></td>
                            <td>@lang('general.from') 37.08 @lang('general.uah')</td>
                            <td>@lang('general.from') 28.95 @lang('general.uah')</td>
                            <td>@lang('general.from') 54.96 @lang('general.uah')</td>
                            <td>@lang('general.from') 66.94 @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/competitors-logo-3.png') }}" alt=""></td>
                            <td>@lang('general.from') 36.17 @lang('general.uah')</td>
                            <td>@lang('general.from') 35.70 @lang('general.uah')</td>
                            <td>@lang('general.from') 54.62 @lang('general.uah')</td>
                            <td>@lang('general.from') 97.32 @lang('general.uah')</td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/competitors-logo-4.png') }}" alt=""></td>
                            <td>@lang('general.from') 36.00 @lang('general.uah')</td>
                            <td>@lang('general.from') 28.27 @lang('general.uah')</td>
                            <td>@lang('general.from') - @lang('general.uah')</td>
                            <td>@lang('general.from') 59.00 @lang('general.uah')</td>
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
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="title">@lang('front.best-offers.title')</div>
                </div>
                @foreach($data['rand-top-products'] as $item)
                    <div class="col-sm-6 col-lg-3">
                        <div class="block">
                            <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">
                                <img class="img-fluid" src="{{ asset('/storage/img/'.$item->photo) }}" alt="">
                            </a>
                            <div class="name">{{ $item->name }}</div>
                            @if($item->price != 0)
                                <div class="price">{{ number_format($item->price, 2, '.', '') }}@lang('general.uah')</div>
                            @else
                                <div class="price">@lang('sub-category.specify')</div>
                            @endif
                            <a class="go-to"
                               href="{{ LaravelLocalization::LocalizeURL('/'.$item->slug) }}">@lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="seo">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-sm-12 col-lg-10">
                    <h3 class="title">@lang('front.seo.title')</h3>
                    <div class="body">
                        <div class="text text-preview">@lang('front.seo.body.preview')</div>
                        <div class="text text-all">@lang('front.seo.body.all')</div>
                        <div class="read-all">
                            <span class="content-show">@lang('general.show-all')</span>
                            <span class="content-hidden hide">@lang('general.hide-all')</span>
                        </div>
                    </div>
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
                            <img class="rounded-circle" src="{{ asset('images/commentator-1.png') }}" alt="">
                            <div class="name">@lang('front.comments.commentator-1.name')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.commentator-1.title')</span>
                                <div class="comment">@lang('front.comments.commentator-1.comment')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img class="rounded-circle" src="{{ asset('images/commentator-2.png') }}" alt="">
                            <div class="name">@lang('front.comments.commentator-2.name')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.commentator-2.title')</span>
                                <div class="comment">@lang('front.comments.commentator-2.comment')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img class="rounded-circle" src="{{ asset('images/commentator-3.png') }}" alt="">
                            <div class="name">@lang('front.comments.commentator-3.name')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.commentator-3.title')</span>
                                <div class="comment">@lang('front.comments.commentator-3.comment')</div>
                            </div>
                        </div>
                        <div class="frame">
                            <img class="rounded-circle" src="{{ asset('images/commentator-4.png') }}" alt="">
                            <div class="name">@lang('front.comments.commentator-4.name')</div>
                            <div class="text-block">
                                <i class="fas fa-quote-right"></i>
                                <span class="title">@lang('front.comments.commentator-4.title')</span>
                                <div class="comment">@lang('front.comments.commentator-4.comment')</div>
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