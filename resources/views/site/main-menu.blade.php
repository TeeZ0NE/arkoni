<div class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav>
                    <button class="navbar-toggler d-block d-lg-none" type="button" data-target="#navbarText"
                            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="justify-content-right d-block d-lg-none">
                        <form class="form-inline search" method="get" action="{{ route('se.search') }}" role="search">
                            <input class="form-control mr-sm-2" type="search" placeholder="@lang('header.search')"
                                   aria-label="Search" name="q" value="@isset($q) {{$q}}@endisset">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <div class="collapse navbar-collapse d-lg-none" id="navbarText">
                        <div class="logo-block d-block d-md-none">
                            @if(isset($class) && $class == 'front')
                                @include('site._logo')
                            @else
                                <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
                                    @include('site._logo')
                                </a>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <ul class="language-switch d-md-none">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li @if($localeCode == config('app.locale'))class="active"@endif>
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        @lang('header.langs.' . $localeCode)
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="clearfix"></div>
                        <ul>
                            <li class="parent @if($class == 'front'){{'open'}}@endif">
                                <a class="nav-item nav-link"
                                   href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('main-menu.catalog')
                                        <i
                                                class="fas fa-bars"></i></a>
                                <ul class="categories-items">
                                    @foreach($menu as $id => $cat)
                                        @if(count($cat->sub))
                                            <li>
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
                    </div>
                    <div class="menu-shadow"></div>
                    <ul class="d-none d-lg-flex">
                        <li class="parent @if($class == 'front'){{'open'}}@endif">
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('main-menu.catalog')
                                    <i
                                            class="fas fa-bars"></i></a>
                            <ul class="categories-items">
                                @foreach($menu as $id => $cat)
                                    @if(count($cat->sub))
                                        <li>
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