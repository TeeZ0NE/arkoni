@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog') !!}

    <div class="container">
        <div class="row">
            <div class="col-12"><div class="title">@lang('blog.title')</div></div>
            <main class="col-md-9" role="main">
                <article>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ LaravelLocalization::LocalizeURL('/b-eqweqweqw') }}">
                                <img class="thumb" src="{{ asset('/storage/img/') }}" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <ul class="commerce">
                                <li class="promotion"></i>@lang('general.promotion')</li>
                                <li class="material">@lang('general.material')</li>
                            </ul>
                            <div class="views"><i class="far fa-eye"></i>387</div>
                            <header><a href="{{ LaravelLocalization::LocalizeURL('/b-deqwedasda') }}">Акция «БЕСПЛАТНАЯ ДОСТАВКА» - отличная возможность снизить затраты на приобретение стройматериалов!</a></header>
                            <p>Всегда отличная возможность сэкономить существенную сумму. Не ищите «подводных камней» и подвохов в наших акциях</p>
                        </div>
                    </div>
                </article>

                {{--{{ $data['products']->links('pagination.default') }}--}}
            </main>
            <aside class="col-md-3">
                @include('site.blog.aside')
            </aside>
        </div>
    </div>

@endsection