@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog') !!}

    <div class="container">
        <div class="row">
            <main class="col-md-9" role="main">
                <article>
                    <ul class="commerce">
                        <li class="promotion"><i class="fas fa-tag"></i>@lang('general.promotion')</li>
                        <li class="material"><i class="fas fa-thumbs-up"></i>@lang('general.material')</li>
                    </ul>
                    <div class="date">19.03.18</div>
                    <div class="views"><i class="far fa-eye"></i>387</div>
                    <header>Акция «БЕСПЛАТНАЯ ДОСТАВКА» - отличная возможность снизить затраты
                        на приобретение стройматериалов!
                    </header>
                    {{--                    {{ Удалить картинку потом }}--}}
                    <img src="{{ asset('images/real-mens-tools-picjumbo-com.png') }}" alt="">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a dolor ut orci mollis tincidunt.
                        Morbi tellus libero, ultrices sit amet augue at, pellentesque hendrerit arcu. Nulla sit amet
                        pulvinar erat. Fusce sit amet porttitor nunc, quis scelerisque magna. Proin ligula turpis,
                        ultrices eu condimentum sed, dapibus sit amet quam. Nulla imperdiet sollicitudin massa, et
                        lobortis nunc blandit vel. Donec luctus, orci at rutrum pretium, sem erat molestie nibh, vel
                        facilisis ligula lorem nec nibh.
                    </p>
                    <p>Nulla eu tortor vitae mi dignissim sollicitudin ut ut magna. Proin a nunc ut augue sollicitudin
                        ultricies vel nec mauris. Duis massa ante, vestibulum malesuada laoreet ac, sagittis eu est.
                        Quisque ac lectus purus. Morbi a commodo ante, at dapibus massa. Vestibulum hendrerit est a ex
                        egestas tincidunt. Ut sollicitudin feugiat luctus. Aliquam ut odio ut massa euismod venenatis
                        sit amet ut neque. Duis viverra enim in quam finibus pellentesque in eu lacus. Quisque neque
                        mauris, cursus ac dui sed, viverra porttitor ligula. Morbi congue efficitur accumsan. Aenean et
                        risus odio. Quisque id sollicitudin ipsum.
                    </p>
                    <p>Quisque eu arcu odio. Aenean tellus dolor, aliquet placerat erat in, tempor semper justo. Nulla
                        vestibulum, mauris pretium pharetra vehicula, tortor sem blandit magna, sit amet accumsan dui
                        massa sed erat. Vestibulum sit amet mi pulvinar, consectetur metus eget, varius tortor. Aenean
                        sollicitudin ex a pretium efficitur. Ut aliquam vulputate sapien, pretium commodo massa
                        convallis sed. Fusce interdum lacus ut metus euismod dapibus. Proin at purus et augue iaculis
                        imperdiet a et urna. Praesent id fermentum est, eu lacinia velit. Vivamus aliquam augue metus,
                        sit amet vulputate nunc fermentum a. In rhoncus sapien quis dolor mattis, ac iaculis urna
                        eleifend. Phasellus eu justo dignissim, hendrerit tellus at, consectetur diam. Ut enim urna,
                        tempor ac feugiat non, rutrum vitae nulla. Cras felis est, ultrices vel metus sit amet, vehicula
                        mattis sapien. Vestibulum quis facilisis dolor. Etiam id venenatis quam.
                    </p>
                    <p>Aenean volutpat euismod nisl, tempus porta diam fringilla eget. Curabitur finibus nisl purus, at
                        fermentum mauris sollicitudin non. Curabitur sollicitudin quam nunc, ac tincidunt magna
                        tincidunt ac. Phasellus at dignissim eros. Nulla ut efficitur arcu. Donec porttitor ipsum quis
                        bibendum aliquam. Phasellus eget nibh tincidunt quam placerat luctus. Curabitur nec mi sit amet
                        nulla sollicitudin aliquet. Maecenas ornare eleifend ante, sit amet eleifend nibh aliquam at.
                        Donec id nunc varius, ornare nibh id, hendrerit dolor. Proin eget ante sed sapien molestie
                        molestie. Ut mattis, neque non mollis placerat, orci nisi vehicula nulla, ut ultrices massa
                        justo sit amet leo. Maecenas eget mauris non sapien commodo aliquet. Aenean vitae accumsan
                        dolor, eget aliquet odio. Donec id tortor luctus nunc commodo ornare vel ut ipsum.
                    </p>
                    <footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="assessment">@lang('blog.assessment')</div>
                                <div id="rating-block" class="rating-block">
                                    <div itemscope itemtype="http://schema.org/Product">
                                        @include('site._ratings')
                                    </div>
                                </div>
                                <div class="watch-more">@lang('blog.watch-more')</div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('images/real-mens-tools-picjumbo-com.png') }}" alt="">
                                <header><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Акция «БЕСПЛАТНАЯ
                                        ДОСТАВКА» - отличная возможность снизить затраты на приобретение
                                        стройматериалов!</a></header>

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('images/real-mens-tools-picjumbo-com.png') }}" alt="">
                                <header><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Акция «БЕСПЛАТНАЯ
                                        ДОСТАВКА» - отличная возможность снизить затраты на приобретение
                                        стройматериалов!</a></header>

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('images/real-mens-tools-picjumbo-com.png') }}" alt="">
                                <header><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Акция «БЕСПЛАТНАЯ
                                        ДОСТАВКА» - отличная возможность снизить затраты на приобретение
                                        стройматериалов!</a></header>

                            </div>
                        </div>
                    </footer>
                </article>
            </main>
            <aside class="col-md-3">
                @include('site.blog.aside')
            </aside>
        </div>
    </div>

@endsection