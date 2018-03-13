<!doctype html>
<html lang="{{ config('app.locale') }}" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">

{{--    <title>@if(isset($title)){{ $title }}@endif</title>--}}
    {{--<meta name="description" content="@if(isset($description)){{ $description }}@endif">--}}

    {{--@if(count(Request::segments()) < 2 )--}}
        {{--<link rel='alternate' hreflang='ru' href='{{ url('https://hyperhost.ua/ru') }}'/>--}}
        {{--<link rel='alternate' hreflang='uk' href='{{ url('https://hyperhost.ua/uk') }}'/>--}}
    {{--@else--}}
        {{--@php--}}
        {{--$url = Request::segments();--}}
        {{--unset($url[0]);--}}
        {{--@endphp--}}
        {{--<link rel='alternate' hreflang='ru' href='{{ url('https://hyperhost.ua/ru/' . implode('/',$url)) }}'/>--}}
        {{--<link rel='alternate' hreflang='uk' href='{{ url('https://hyperhost.ua/uk/' . implode('/',$url)) }}'/>--}}
    {{--@endif--}}

    {{--<meta property="og:title" content="@if(isset($title)){{$title}}@endif"/>--}}
    {{--<meta property="og:description" content="@if(isset($description)){{$description}}@endif"/>--}}
    {{--<meta property="og:type" content="website">--}}
    {{--<meta property="og:site" content="{{ LaravelLocalization::LocalizeURL('/')}}">--}}
    {{--<meta property="og:url" content="{{ LaravelLocalization::LocalizeURL($_SERVER['REQUEST_URI']) }}">--}}
    {{--<meta property="og:image" content="{{ asset('img/logosocialnet-' . config('app.locale') . '.jpg')}}"/>--}}
    {{--<meta property="og:image:type" content="image/png">--}}
    {{--<meta property="og:image:width" content="300">--}}
    {{--<meta property="og:image:height" content="200">--}}
    {{--<meta property="og:site_name" content="HyperHost">--}}

    {{--<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">--}}
    {{--<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">--}}
    {{--<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">--}}
    {{--<link rel="manifest" href="{{ asset('/manifest.json') }}">--}}
    {{--<link rel="mask-icon" href="{{ asset('/safari-pinned-tab.svg') }}" color="#5bbad5">--}}
    {{--<meta name="theme-color" content="#ffffff">--}}

    <link rel="stylesheet" href="{{ mix('css/site.css') }}">


</head>
<body id="anchor" class="@if(isset($class)){{$class}}@endif {{ config('app.locale') }}">