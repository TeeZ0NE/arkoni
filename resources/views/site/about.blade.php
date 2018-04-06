@extends('site.index')

@section('content')

    {{ Breadcrumbs::render('about') }}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>@lang('about.h1')</h1>
                    @lang('about.text', ['img-url' => asset('images/producers')])
                </article>
            </div>
        </div>
    </div>

@endsection