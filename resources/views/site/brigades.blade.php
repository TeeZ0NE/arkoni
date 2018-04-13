@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('brigades') !!}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">@lang('brigades.title')</h1>
                @lang('brigades.text-block-1')
                    <div class="text-center">
                        <img class="img-fluid" src="{{ asset('images/brigades-img-1.png') }}" alt="">
                    </div>
                    @lang('brigades.text-block-2')
            </div>
        </div>
    </div>

@endsection