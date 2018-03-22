@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog') !!}

    <div class="container">
        <div class="row">
            <main class="col-md-9" role="main">
                <div class="title">@lang('blog.title')</div>

                <article>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="{{ asset('/storage/img/') }}" alt="">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i>@lang('general.promotion')</li>
                                <li class="material"><i
                                            class="fas fa-thumbs-up"></i>@lang('general.material')</li>
                                <li></li>
                            </ul>
                            <div class="views"><i class="far fa-eye"></i>387</div>
                            <header><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Акция «БЕСПЛАТНАЯ ДОСТАВКА» - отличная возможность снизить затраты на приобретение стройматериалов!</a></header>
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