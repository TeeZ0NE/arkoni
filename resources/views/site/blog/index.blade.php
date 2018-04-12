@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog') !!}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">@lang('blog.title')</div>
            </div>
            <main class="col-md-12 col-lg-9" role="main">
                @foreach($data['articles'] as $item)
                    <article>
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <a href="{{ LaravelLocalization::LocalizeURL('/' . $item->slug) }}">
                                    <img class="img-fluid" src="{{ asset('/storage/img/' . $item->photo) }}" alt="">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="views"><i class="far fa-eye"></i>{{ $item->views }}</div>
                                <header>
                                    <a href="{{ LaravelLocalization::LocalizeURL('/' . $item->slug) }}">{{ $item->title }}</a>
                                </header>
                                <p>{{ do_excerpt($item->body, 30) }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
                {{ $data['articles']->links() }}
            </main>
            <aside class="col-lg-3 d-none d-lg-block">
                @include('site.blog.aside')
            </aside>
        </div>
    </div>

@endsection