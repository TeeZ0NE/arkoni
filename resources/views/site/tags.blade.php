@extends('site.index')

@section('content')
    {{--    {!! Breadcrumbs::render('tabs', $dasdasd) !!}--}}

    <div class="container">
        <div class="row">
            {{--<aside class="col-md-3">--}}
            {{--<div class="filters">--}}
            {{--<form method="get" action="{{ route('sub-category',substr($segment,2)) }}" role="search">--}}
            {{--<div class="parameters-block">--}}
            {{--<div class="header">--}}
            {{--@lang('sub-category.brand')--}}
            {{--</div>--}}
            {{--<div class="parameters">--}}
            {{--<ul>--}}
            {{--@foreach($brands as $brand)--}}
            {{--<li>--}}
            {{--<input id="id-{{$brand->id}}" type="checkbox" name="bs[]"--}}
            {{--value="{{$brand->id}}"--}}
            {{--@isset($bs) @if(in_array($brand->id,$bs)) checked @endif @endisset>--}}
            {{--<label for="id-{{$brand->id}}">{{$brand->name}}</label>--}}
            {{--</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="parameters-block">--}}
            {{--<div class="header">--}}
            {{--@lang('sub-category.price')--}}
            {{--</div>--}}
            {{--<div class="parameters">--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<input id="low-to-high" type="radio" name="sort" value="asc_price"--}}
            {{--@if ($sort=='asc_price') checked @endif>--}}
            {{--<label for="low-to-high">@lang('sub-category.high-to-low')</label>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<input id="high-to-low" type="radio" name="sort" value="desc_price"--}}
            {{--@if ($sort=='desc_price') checked @endif>--}}
            {{--<label for="high-to-low">@lang('sub-category.low-to-high')</label>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="parameters-block">--}}
            {{--<div class="header">--}}
            {{--@lang('sub-category.alphabet')--}}
            {{--</div>--}}
            {{--<div class="parameters">--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<input id="a-to-z" type="radio" name="sort" value="asc_name"--}}
            {{--@if ($sort=='asc_name') checked @endif>--}}
            {{--<label for="a-to-z">@lang('sub-category.a-to-z')</label>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<input id="z-to-a" type="radio" name="sort" value="desc_name"--}}
            {{--@if ($sort=='desc_name') checked @endif>--}}
            {{--<label for="z-to-a">@lang('sub-category.z-to-a')</label>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}

            {{--<button type="submit" class="btn btn-filter">@lang('general.show')</button>--}}
            {{--</div>--}}
            {{--</form>--}}
            {{--</div>--}}
            {{--@include('site._calc-aside')--}}
            {{--@include('site._contacts-aside')--}}
            {{--</aside>--}}
            {{--<div class="col-md-9">--}}
            {{--<div class="seo-block-1">--}}
            {{--<div class="container">--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
            {{--<h1 class="title">{{ $scat->$scat_method['h1'] }}</h1>--}}
            {{--{!! $scat->$scat_method['seo_text']  !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@foreach($items as $item)--}}
            {{--<article class="item">--}}
            {{--<div class="container">--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-3">--}}
            {{--<a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">--}}
            {{--<img class="img-fluid" src="{{ asset('/storage/img/'.$item->item_photo) }}"--}}
            {{--alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 text">--}}
            {{--<header class="title">--}}
            {{--<a href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">{{ $item->$i_method['name'] }}</a>--}}
            {{--</header>--}}
            {{--@if($item->getItemShortcut)--}}
            {{--<ul class="commerce">--}}
            {{--@foreach($item->getItemShortcut as $shc)--}}
            {{--<li class="{{$shc->name}}">@lang('general.' . $shc->name)</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
            {{--@endif--}}
            {{--<p class="entity-text">{{ do_excerpt($item->$i_method['description'], 25) }}</p>--}}
            {{--</div>--}}
            {{--<div class="col-md-3 info">--}}
            {{--<div class="call-we">@lang('sub-category.call-we'):</div>--}}
            {{--<div class="phone">--}}
            {{--<a href="tel:{{ config('contacts.phone-1-alt') }}">{{ config('contacts.phone-1-alt') }}</a>--}}
            {{--</div>--}}
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
            {{--<div class="specify">@lang('sub-category.specify')</div>--}}
            {{--@endif--}}
            {{--<a class="go-to"--}}
            {{--href="{{ LaravelLocalization::LocalizeURL('/'.$item->item_url_slug) }}">--}}
            {{--@lang('general.learn-more')<i class="far fa-long-arrow-alt-right"></i>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</article>--}}
            {{--@endforeach--}}
            {{--{{ $items->appends(['sort'=>$sort, 'bs'=>$bs])->links('pagination.default') }}--}}
            {{--</div>--}}
        </div>
    </div>

    {{--TODO: DELETE--}}
    {{--{{ print_array($items) }}--}}

    {{--<center>Sub category data</center>--}}
    {{--id -  {{$scat->id}}<br>--}}
    {{--name - {{$scat->$scat_method['name']}}<br>--}}
    {{--title: {{$scat->$scat_method['title']}}<br>--}}
    {{--desc: {{$scat->$scat_method['description']}}<br>--}}
    {{--h1: {{$scat->$scat_method['h1']}}<br>--}}
    {{--h2: {{$scat->$scat_method['h2']}}<br>--}}
    {{--seo_text: {{$scat->$scat_method['seo_text']}} <br>--}}
    {{--seo_text_2: {{$scat->$scat_method['seo_text_2']}} <br>--}}
    {{--<img src="{{asset('storage/img').'/'.$scat->sub_cat_photo}}" alt="item photo"--}}
    {{--class="img-fluid w-25">--}}
    {{--<hr>--}}

    {{--<form method="get" action="{{ route('sub-category',substr($segment,2)) }}" role="search">--}}
    {{--<div class="form-group">--}}
    {{--<select class="custom-select  mr-sm-1 w-50" name="sort">--}}
    {{--<option value="asc_name" @if ($sort=='asc_name') selected @endif>А-Я Назва--}}
    {{--товара--}}
    {{--</option>--}}
    {{--<option value="desc_name" @if ($sort=='desc_name') selected @endif>Я-А Назва--}}
    {{--товара--}}
    {{--</option>--}}

    {{--<option value="asc_price" @if ($sort=='asc_price') selected @endif>А-Я Ціна--}}
    {{--</option>--}}
    {{--<option value="desc_price" @if ($sort=='desc_price') selected @endif>Я-А Ціна--}}
    {{--</option>--}}
    {{--</select>--}}
    {{--<button type="submit" class="btn btn-warning"><i class="fas fa-sort"></i></button>--}}
    {{--</div>--}}
    {{--<center>Brands</center>--}}
    {{--@foreach($brands as $brand)--}}
    {{--<input type="checkbox" name="bs[]" value="{{$brand->id}}"--}}
    {{--@isset($bs) @if(in_array($brand->id,$bs)) checked @endif @endisset>--}}
    {{--{{$brand->name}}<br>--}}
    {{--@endforeach--}}
    {{--<hr>--}}
    {{--</form>--}}

    {{--@foreach($items as $item)--}}
    {{--id - {{$item->id}}<br>--}}
    {{--name -  {{$item->$i_method['name']}}<br>--}}
    {{--desc - {{$item->$i_method['description']}}<br>--}}
    {{--price - {{$item->price}}<br>--}}
    {{--old pr - {{$item->old_price}}<br>--}}
    {{--brand - {{$item->brand['name']}}<br>--}}
    {{--item url - {{$item->item_url_slug}}<br>--}}
    {{--item shortcuts - @foreach($item->getItemShortcut as $shc){{$shc->name}}&nbsp;@endforeach <br>--}}
    {{--<img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo"--}}
    {{--class="img-fluid w-25"><br>--}}
    {{--<hr>--}}
    {{--@endforeach--}}
    {{--{{$items->appends(['sort'=>$sort, 'bs'=>$bs])->links()}}&nbsp;total:{{$items->total()}}--}}
@endsection