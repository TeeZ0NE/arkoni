<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                @if(isset($class) && $class == 'front')
                    @include('site._logo')
                @else
                    <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
                        @include('site._logo')
                    </a>
                @endif
            </div>
            <div class="col-md-3 col-sm-6">
                <nav>
                    <ul>
                        <li><a href="{{ LaravelLocalization::LocalizeURL('/catalog') }}">@lang('footer.catalog')</a>
                        </li>
                        <li>
                            <a href="{{ LaravelLocalization::LocalizeURL('/brigades') }}">@lang('main-menu.brigades')</a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="{{ LaravelLocalization::LocalizeURL('/cooperation') }}">@lang('main-menu.cooperation')</a>--}}
                        {{--</li>--}}
                    </ul>
                </nav>
            </div>
            <div class="col-sm-6 order-sm-1 col-md-2 order-md-0">
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
            <div class="col-sm-6 order-sm-0 col-md-3 order-md-1">
                @if(!isset($starts))
                    <div id="rating-block" class="rating-block">
                        <div itemscope itemtype="http://schema.org/Product">
                            @include('site._ratings')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9rJLVd79d399U4QBQD3-aHOGxz-TxQ-A&callback=initMap"
        type="text/javascript"></script>
<script>
    function initMap(position) {
        if (window.innerWidth <= 768) {
            position = {lat: 49.238323, lng: 28.460862};
        }
        if (window.location.pathname.split('/').length === 2 || window.location.pathname.split('/')[2] === 'contacts') {
            //create map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.237887, lng: 28.460762},
                zoom: 17
            });
            //create marker
            var marker = new google.maps.Marker({
                position: position || {lat: 49.238323, lng: 28.463262},
                map: map
            });
        }
    }
</script>
<script src="{{ mix('js/site.js') }}"></script>

</body>
</html>