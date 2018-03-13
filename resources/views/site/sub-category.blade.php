@extends('site.index')

@section('content')

    {{ Breadcrumbs::render('home') }}

    <div class="container">
        <div class="row">
            <aside class="col-sm-3">
                <div class="filters">
                    <form action="" class="filter-parameters">
                        <div class="parameters-block">
                            <div class="header">
                                @lang('sub-category.brand')
                            </div>
                            <div class="parameters">
                                <ul>
                                    <li>
                                        <input id="id-1" type="checkbox" name="price">
                                        <label for="id-1">BauGut</label>
                                    </li>
                                    <li>
                                        <input id="id-2" type="checkbox" name="price">
                                        <label for="id-2">Baumit</label>
                                    </li>
                                    <li>
                                        <input id="id-3" type="checkbox" name="price">
                                        <label for="id-3">Belgips</label>
                                    </li>
                                    <li>
                                        <input id="id-4" type="checkbox" name="price">
                                        <label for="id-4">Ceresit</label>
                                    </li>
                                    <li>
                                        <input id="id-5" type="checkbox" name="price">
                                        <label for="id-5">Elite Gips</label>
                                    </li>
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
                                        <input id="low-to-high" type="radio" name="price">
                                        <label for="low-to-high">@lang('sub-category.low-to-high')</label>
                                    </li>
                                    <li>
                                        <input id="high-to-low" type="radio" name="price">
                                        <label for="high-to-low">@lang('sub-category.high-to-low')</label>
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
                                        <input id="a-to-z" type="radio" name="price">
                                        <label for="a-to-z">@lang('sub-category.a-to-z')</label>
                                    </li>
                                    <li>
                                        <input id="z-to-a" type="radio" name="price">
                                        <label for="z-to-a">@lang('sub-category.z-to-a')</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="calc">
                    <div class="header">
                        @lang('sub-category.calc.header')
                    </div>
                    <div class="body">
                        @lang('sub-category.calc.body')
                    </div>
                    <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                        @lang('front.services.block-1.go-to')
                            <i class="far fa-long-arrow-alt-right"></i>
                    </a>
                </div>
                <div class="contacts">
                    <div class="text-center">
                        @lang('sub-category.call')
                    </div>
                    <hr class="separator">
                    <ul class="phones text-center">
                        <li><i class="fas fa-phone"></i>{{ config('contacts.mobil') }}</li>
                        <li><i class="fas fa-phone"></i>{{ config('contacts.phone-1') }}</li>
                        <li><i class="fas fa-phone"></i>{{ config('contacts.phone-2') }}</li>
                    </ul>
                </div>
            </aside>
            <div class="col-sm-9">
                <div class="seo-block-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">Штукатурки</h1>
                                <p>Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas
                                    lacus orci non
                                    sapien. Duis sagittis imperdiet eros ac posuere. Nunc sapien diam, sollicitudin
                                    commodo posuere non, aliquam nec urna.</p>
                                <p>Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna
                                    congue vulputate quis nec sapien.
                                    Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas
                                    lacus orci non sapien. Duis sagittis
                                    imperdiet eros ac posuere. Nunc sapien diam, sollicitudin commodo posuere non,
                                    aliquam nec urna.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{--start each --}}
                <article class="item">
                    <div class="row">
                        <div class="col-md-3 thumbnail">
                            <a class="url-thumbnail" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="" alt="" class="img-thumbnail">
                                {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            </a>
                        </div>
                        <div class="col-md-6 text">
                            {{--<div class="body">--}}
                            <div class="title">
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">Штукатурка ROTBAND
                                    виробника Кнауф </a>
                            </div>
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                <li class="recommend"><i class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                </li>
                            </ul>
                            <div class="text-block">
                                <?php echo do_excerpt('Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue vulputate quis nec sapien. Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non sapien.', 30) ?>
                            </div>
                            {{--</div>--}}
                        </div>
                        <div class="col-md-3 info">
                            {{--<div class="info">--}}
                            <div class="call-we">@lang('sub-category.call-we'):</div>
                            <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <div class="price">180.00 @lang('general.uah')</div>
                            <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/p-product-1') }}">
                                @lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <article class="item">
                    <div class="row">
                        <div class="col-md-3 thumbnail">
                            <a class="url-thumbnail" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="" alt="" class="img-thumbnail">
                                {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            </a>
                        </div>
                        <div class="col-md-6 text">
                            {{--<div class="body">--}}
                            <div class="title">
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">Штукатурка ROTBAND
                                    виробника Кнауф </a>
                            </div>
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                <li class="recommend"><i class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                </li>
                            </ul>
                            <div class="text-block">
                                <?php echo do_excerpt('Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue vulputate quis nec sapien. Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non sapien.', 30) ?>
                            </div>
                            {{--</div>--}}
                        </div>
                        <div class="col-md-3 info">
                            {{--<div class="info">--}}
                            <div class="call-we">@lang('sub-category.call-we'):</div>
                            <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <div class="price">180.00 @lang('general.uah')</div>
                            <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/p-product-2') }}">
                                @lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
                <article class="item">
                    <div class="row">
                        <div class="col-md-3 thumbnail">
                            <a class="url-thumbnail" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="" alt="" class="img-thumbnail">
                                {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            </a>
                        </div>
                        <div class="col-md-6 text">
                            {{--<div class="body">--}}
                            <div class="title">
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">Штукатурка ROTBAND
                                    виробника Кнауф </a>
                            </div>
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                <li class="recommend"><i class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                </li>
                            </ul>
                            <div class="text-block">
                                <?php echo do_excerpt('Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue vulputate quis nec sapien. Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non sapien.', 30) ?>
                            </div>
                            {{--</div>--}}
                        </div>
                        <div class="col-md-3 info">
                            {{--<div class="info">--}}
                            <div class="call-we">@lang('sub-category.call-we'):</div>
                            <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <div class="price">180.00 @lang('general.uah')</div>
                            <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                @lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
                <article class="item">
                    <div class="row">
                        <div class="col-md-3 thumbnail">
                            <a class="url-thumbnail" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="" alt="" class="img-thumbnail">
                                {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            </a>
                        </div>
                        <div class="col-md-6 text">
                            {{--<div class="body">--}}
                            <div class="title">
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">Штукатурка ROTBAND
                                    виробника Кнауф </a>
                            </div>
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                <li class="recommend"><i class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                </li>
                            </ul>
                            <div class="text-block">
                                <?php echo do_excerpt('Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue vulputate quis nec sapien. Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non sapien.', 30) ?>
                            </div>
                            {{--</div>--}}
                        </div>
                        <div class="col-md-3 info">
                            {{--<div class="info">--}}
                            <div class="call-we">@lang('sub-category.call-we'):</div>
                            <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <div class="price">180.00 @lang('general.uah')</div>
                            <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                @lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
                <article class="item">
                    <div class="row">
                        <div class="col-md-3 thumbnail">
                            <a class="url-thumbnail" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                <img src="" alt="" class="img-thumbnail">
                                {{--<img src="{{ asset('images/comments/.png') }}" alt="">--}}
                            </a>
                        </div>
                        <div class="col-md-6 text">
                            {{--<div class="body">--}}
                            <div class="title">
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">Штукатурка ROTBAND
                                    виробника Кнауф </a>
                            </div>
                            <ul class="commerce">
                                <li class="stock"><i class="fas fa-tag"></i> @lang('sub-category.stock')</li>
                                <li class="top-sales"><i class="fas fa-thumbs-up"></i> @lang('sub-category.top-sales')</li>
                                <li class="recommend"><i class="fas fa-certificate"></i> @lang('sub-category.recommend')
                                </li>
                            </ul>
                            <div class="text-block">
                                <?php echo do_excerpt('Nunc vitae tempor magna, eu imperdiet turpis. Pellentesque accumsan ante sed magna congue vulputate quis nec sapien. Donec malesuada, turpis id ornare ultricies, diam odio faucibus nunc, eget egestas lacus orci non sapien.', 30) ?>
                            </div>
                            {{--</div>--}}
                        </div>
                        <div class="col-md-3 info">
                            {{--<div class="info">--}}
                            <div class="call-we">@lang('sub-category.call-we'):</div>
                            <div class="phone">{{ config('contacts.phone-1-alt') }}</div>
                            <span class="old-price">194.45 @lang('general.uah')</span>
                            <div class="price">180.00 @lang('general.uah')</div>
                            <a class="go-to" href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                @lang('general.learn-more')
                                    <i class="far fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

{{--                {{ $paginator->links('view.name') }}--}}
            </div>
        </div>
    </div>

    {{--end each--}}

    <div class="seo-block-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2 class="title">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>
                        <p>Quisque sodales mi in mi congue, sed laoreet velit rutrum. Vestibulum et purus enim. Vivamus
                            bibendum ligula in turpis hendrerit, ut luctus urna tempus. Phasellus vulputate quam eget
                            diam tincidunt, ut
                            sollicitudin lacus iaculis. Morbi accumsan porta eros at viverra. Vivamus velit enim,
                            sodales tempus fermentum eget,
                            facilisis id massa. Curabitur dictum, ex eget gravida aliquet, nisl ipsum mattis neque, sed
                            gravida dolor mi vel mi.
                            Aliquam in tortor posuere est feugiat ultricies. Suspendisse eu elit at purus molestie
                            vehicula. Maecenas varius
                            molestie dui feugiat vehicula. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection