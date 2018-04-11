@extends('site.index')

@section('content')
    {!! Breadcrumbs::render('tags', $tag->$tag_method->title) !!}


    <div class="container">
        <div class="row">
            <aside class="col-md-3 d-none d-lg-block">
                <div class="filters">
                    <form method="get" action="{{ route('tags',substr($segment,2)) }}" role="search">
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.brand')
                            </div>
                            <div class="parameters">
                                <ul>
                                    @foreach($brands as $brand)
                                        <li>
                                            <input id="id-{{$brand->id}}" type="checkbox" name="bs[]"
                                                   value="{{$brand->id}}"
                                                   @isset($bs) @if(in_array($brand->id,$bs)) checked @endif @endisset>
                                            <label for="id-{{$brand->id}}">{{$brand->name}}</label>
                                        </li>
                                    @endforeach
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
                                        <input id="low-to-high" type="radio" name="sort" value="asc_price"
                                               @if ($sort=='asc_price') checked @endif>
                                        <label for="low-to-high">@lang('sub-category.high-to-low')</label>
                                    </li>
                                    <li>
                                        <input id="high-to-low" type="radio" name="sort" value="desc_price"
                                               @if ($sort=='desc_price') checked @endif>
                                        <label for="high-to-low">@lang('sub-category.low-to-high')</label>
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
                                        <input id="a-to-z" type="radio" name="sort" value="asc_name"
                                               @if ($sort=='asc_name') checked @endif>
                                        <label for="a-to-z">@lang('sub-category.a-to-z')</label>
                                    </li>
                                    <li>
                                        <input id="z-to-a" type="radio" name="sort" value="desc_name"
                                               @if ($sort=='desc_name') checked @endif>
                                        <label for="z-to-a">@lang('sub-category.z-to-a')</label>
                                    </li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-filter">@lang('general.show')</button>
                        </div>
                    </form>
                </div>
                @include('site._calc-aside')
                @include('site._contacts-aside')
            </aside>
            <div class="col-md-12 col-lg-9">
                <div class="seo-block-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">{{ $tag->$tag_method->title }}</h1>
                                {!! $tag->$tag_method->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters d-lg-none">
                    <form method="get" action="{{ route('tags',substr($segment,2)) }}" role="search">
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.brand')
                            </div>
                            <div class="parameters">
                                <ul>
                                    @foreach($brands as $brand)
                                        <li>
                                            <input id="id--{{$brand->id}}" type="checkbox" name="bs[]"
                                                   value="{{$brand->id}}"
                                                   @isset($bs) @if(in_array($brand->id,$bs)) checked @endif @endisset>
                                            <label for="id--{{$brand->id}}">{{$brand->name}}</label>
                                        </li>
                                    @endforeach
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
                                        <input id="low--to-high" type="radio" name="sort" value="asc_price"
                                               @if ($sort=='asc_price') checked @endif>
                                        <label for="low--to-high">@lang('sub-category.high-to-low')</label>
                                    </li>
                                    <li>
                                        <input id="high--to-low" type="radio" name="sort" value="desc_price"
                                               @if ($sort=='desc_price') checked @endif>
                                        <label for="high--to-low">@lang('sub-category.low-to-high')</label>
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
                                        <input id="a--to-z" type="radio" name="sort" value="asc_name"
                                               @if ($sort=='asc_name') checked @endif>
                                        <label for="a--to-z">@lang('sub-category.a-to-z')</label>
                                    </li>
                                    <li>
                                        <input id="z--to-a" type="radio" name="sort" value="desc_name"
                                               @if ($sort=='desc_name') checked @endif>
                                        <label for="z--to-a">@lang('sub-category.z-to-a')</label>
                                    </li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-filter">@lang('general.show')</button>
                        </div>
                    </form>
                </div>
                @foreach($items as $item)
                    <article class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">
                                        <img class="img-fluid" src="{{ asset('/storage/img/'.$item->item_photo) }}"
                                             alt="">
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6 text">
                                    <header class="title">
                                        <a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">{{ $item->$i_method['name'] }}</a>
                                    </header>
                                    @if($item->getItemShortcut)
                                        <ul class="commerce">
                                            @foreach($item->getItemShortcut as $shc)
                                                <li class="{{$shc->name}}">@lang('general.' . $shc->name)</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <p class="entity-text">{{ do_excerpt($item->$i_method['description'], 25) }}</p>
                                </div>
                                <div class="col-sm-12 col-md-3 info">
                                    <div class="call-we">@lang('sub-category.call-we'):</div>
                                    <div class="phone">
                                        <a href="tel:{{ config('contacts.phone-1-alt') }}">{{ config('contacts.phone-1-alt') }}</a>
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
                        </div>
                    </article>
                @endforeach
                {{ $items->appends(['sort'=>$sort, 'bs'=>$bs])->links('pagination.default') }}
                @if(count($tags) > 0)
                    <ul class="tags">
                        @foreach($tags as $tag_key => $tag_value)
                            <li>
                                <a href="{{ LaravelLocalization::LocalizeURL('/' . $tag_key) }}">#{{$tag_value}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

@endsection