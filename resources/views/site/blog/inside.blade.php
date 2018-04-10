@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('blog-inside', $data['article']->title) !!}

    <div class="container">
        <div class="row">
            <main class="col-md-9" role="main">
                <article>
                    <div class="views"><i class="far fa-eye"></i>{{ $data['article']->views }}</div>
                    <h1 class="title">{{ $data['article']->title }}</h1>

                    <img class="img-fluid" src="{{ asset('/storage/img/' . $data['article']->photo) }}" alt="">
                    {!! $data['article']->body !!}
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
                            @foreach($data['similar'] as $item )
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ asset('/storage/img/' . $item->photo) }}" alt="">
                                    <header><a href="{{ LaravelLocalization::LocalizeURL('/' . $item->url_slug) }}">{{ $item->title }}</a></header>

                                </div>
                            @endforeach
                            <div id="disqus_thread"></div>
                            <script>

                                /**
                                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                                /*
                                 var disqus_config = function () {
                                 this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                 this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                 };
                                 */
                                (function() { // DON'T EDIT BELOW THIS LINE
                                    var d = document, s = d.createElement('script');
                                    s.src = 'https://arkoni-vn-ua.disqus.com/embed.js';
                                    s.setAttribute('data-timestamp', +new Date());
                                    (d.head || d.body).appendChild(s);
                                })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
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