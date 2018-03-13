<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @if(isset($class) && $class == 'front')
                    @include('site._logo')
                @else
                    <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
                        @include('site._logo')
                    </a>
                @endif
            </div>
            <div class="col-md-3">
                <nav>
                    <ul>
                        <li><a href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('footer.catalog')</a>
                        </li>
                        <li>
                            <a href="{{ LaravelLocalization::LocalizeURL('/brigades') }}">@lang('main-menu.brigades')</a>
                        </li>
                        <li>
                            <a href="{{ LaravelLocalization::LocalizeURL('/cooperation') }}">@lang('main-menu.cooperation')</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-2">
                <nav>
                    <ul>
                        <li><a href="{{ LaravelLocalization::LocalizeURL('/about') }}">@lang('main-menu.about')</a></li>
                        <li>
                            <a href="{{ LaravelLocalization::LocalizeURL('/contacts') }}">@lang('main-menu.contacts')</a>
                        </li>
                        <li><a href="{{ LaravelLocalization::LocalizeURL('/blog') }}">@lang('main-menu.blog')</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3">
                @if(!isset($starts))
                    <div id="rating-block" class="rating-block">
                        <div itemscope itemtype="http://schema.org/Page">
                            @include('site._ratings')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtY8V5eaXIVOjVkhfm-VLaqEyHuSNyvtY"
        async defer></script>
<script src="{{ mix('js/site.js') }}"></script>

</body>
</html>