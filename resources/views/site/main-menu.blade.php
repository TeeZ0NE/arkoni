<div class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav>
                    <ul>

                        <li class="parent @if($class == 'front'){{'open'}}@endif">
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('main-menu.catalog')<i
                                        class="fas fa-bars"></i></a>
                            <ul class="categories-items">

                                @foreach($data['main-menu'] as $id => $cat)
                                    @if(count($cat->sub))
                                        <li class="sub-categories-items">
                                            <a href="{{ LaravelLocalization::LocalizeURL('/'.$cat->slug) }}">{{ $cat->name }}</a>
                                            <ul>
                                                @foreach($cat->sub as $key => $val)
                                                    <li>
                                                        <a href="{{ LaravelLocalization::LocalizeURL('/'.$val->slug ) }}">{{ $val->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ LaravelLocalization::LocalizeURL('/'.$cat->slug) }}">{{ $cat->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                                {{--<li><a href="/c-catalog-2">Подпункт 2</a></li>--}}
                                {{--<li class="sub-categories-items"><a href="#">Подпункт 3</a>--}}
                                {{--<ul>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.1 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.2 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.3 </a></li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-categories-items"><a href="#">Подпункт 4</a>--}}
                                {{--<ul>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 4.1 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 4.2 </a></li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-categories-items"><a href="#">Подпункт 5</a>--}}
                                {{--<ul>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.1 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.2 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.3 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.4 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.5 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.6 </a></li>--}}
                                {{--<li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.7 </a></li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li><a href="#">Подпункт 6</a></li>--}}
                                {{--<li><a href="#">Подпункт 7</a></li>--}}
                                {{--<li><a href="#">Подпункт 8</a></li>--}}
                                {{--<li><a href="#">Подпункт 9</a></li>--}}
                            </ul>
                        </li>
                        <li>
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/brigades') }}">@lang('main-menu.brigades')</a>
                        </li>
                        <li>
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/about') }}">@lang('main-menu.about')</a>
                        </li>
                        <li>
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/cooperation') }}">@lang('main-menu.cooperation')</a>
                        </li>
                        <li>
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/blog') }}">@lang('main-menu.blog')</a>
                        </li>
                        <li>
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/contacts') }}">@lang('main-menu.contacts')</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>