@extends('site.index')
@section('content')

    {{ Breadcrumbs::render('search') }}

    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <div class="filters">
                    <form action="" class="filter-parameters">
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.alphabet')
                            </div>
                            <div class="parameters">
                                <form method="get" action="{{ route('se.search') }}" role="search">
                                    <input type="hidden" value="@isset($q){{$q}}@endisset" name="q">
                                    <ul>
                                        <li>
                                            <input id="a-to-z" type="radio" name="sort" value="asc_iname"
                                                   @if ($sort=='asc_iname') checked @endif>
                                            <label for="a-to-z">@lang('sub-category.a-to-z')</label>
                                        </li>
                                        <li>
                                            <input id="z-to-a" type="radio" name="sort" value="desc_iname"
                                                   @if ($sort=='desc_iname') checked @endif>
                                            <label for="z-to-a">@lang('sub-category.z-to-a')</label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn btn-filter">@lang('general.show')</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                @include('site._calc-aside')
                @include('site._contacts-aside')
            </aside>
            <div class="col-md-9">
                <div class="query">@lang('search.query') "{{ $q }}"</div>
                <hr>
                @if($data['items']->isEmpty())
                    <article class="error">{!! __('search.sorry', ['url' => asset('images/smile.png')]) !!}</article>
                @else
                    @foreach($data['items'] as $item)
                        <article class="item">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">
                                        <img class="img-fluid" src="{{ asset('/storage/img/'.$item->item_photo) }}"
                                             alt="">
                                    </a>
                                </div>
                                <div class="col-md-6 text">
                                    <header class="title">
                                        <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">{{ $item->$method['name'] }}</a>
                                    </header>
                                    @if($item->getItemShortcut)
                                        <ul class="commerce">
                                            @foreach($item->getItemShortcut as $shortcut)
                                                <li class="{{$shortcut->name}}">@lang('general.' . $shortcut->name)</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <p class="entity-text">{{ do_excerpt($item->$method['description'], 25) }}</p>
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
                                        <div class="specify">@lang('sub-category.specify')</div>
                                    @endif
                                    <a class="go-to"
                                       href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">
                                        @lang('general.learn-more')<i class="far fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{ $data['items']->appends(['q'=>$q,'sort'=>$sort])->links('pagination.default') }}
                @endif
            </div>
        </div>
    </div>

@endsection
