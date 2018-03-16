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