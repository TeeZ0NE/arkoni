@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog') !!}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">@lang('blog.title')</div>
            </div>
            <main class="col-md-9" role="main">
                @foreach($data['articles'] as $item)
                    <article>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ LaravelLocalization::LocalizeURL('/' . $item->slug) }}">
                                    <img class="img-fluid" src="{{ asset('/storage/img/' . $item->photo) }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="views"><i class="far fa-eye"></i>{{ $item->views }}</div>
                                <header>
                                    <a href="{{ LaravelLocalization::LocalizeURL('/' . $item->slug) }}">{{ $item->title }}</a>
                                </header>
                                <p>{{ do_excerpt($item->body, 40) }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
                @if($data['articles']->total() > 0)
                    {{ $data['articles']->links('pagination.default') }}
                @endif
            </main>
            <aside class="col-md-3">
                @include('site.blog.aside')
            </aside>
        </div>
    </div>

@endsection