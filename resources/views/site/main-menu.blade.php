<div class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav>
                    <ul>
                        <li class="parent @if($class == 'front'){{'open'}}@endif">
                            <a class="nav-item nav-link"
                               href="{{ LaravelLocalization::LocalizeURL('/categories') }}">@lang('main-menu.catalog')<i
                                        class="fas fa-bars"></i></a>
                            <ul class="categories-items">
                                <li class="sub-categories-items"><a href="#">Подпункт 1</a>
                                    <ul>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 1.1 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 1.2 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 1.3 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 1.4 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 1.5 </a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Подпункт 2</a></li>
                                <li class="sub-categories-items"><a href="#">Подпункт 3</a>
                                    <ul>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.1 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.2 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 3.3 </a></li>
                                    </ul>
                                </li>
                                <li class="sub-categories-items"><a href="#">Подпункт 4</a>
                                    <ul>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 4.1 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 4.2 </a></li>
                                    </ul>
                                </li>
                                <li class="sub-categories-items"><a href="#">Подпункт 5</a>
                                    <ul>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.1 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.2 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.3 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.4 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.5 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.6 </a></li>
                                        <li><a href="{{ LaravelLocalization::LocalizeURL('/') }}">Подпункт 5.7 </a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Подпункт 6</a></li>
                                <li><a href="#">Подпункт 7</a></li>
                                <li><a href="#">Подпункт 8</a></li>
                                <li><a href="#">Подпункт 9</a></li>
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