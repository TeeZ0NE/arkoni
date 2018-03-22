@php
    $class = 'error-404';
    $starts = false;
    $title = __('seo.404-title');
    $description = __('seo-404.description');
@endphp

@extends('site.index')

@section('content')
    <div class="error-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <div class="number">404</div>
                        <div class="text-error">
                            @lang('error.msg')
                        </div>
                        <div class="to-front">
                            @lang('error.to-front', ['url' => LaravelLocalization::LocalizeURL('/')])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection