<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-sm-none d-md-block">
                @if(isset($class) && $class == 'front')
                    @include('site._logo')
                @else
                    <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
                        @include('site._logo')
                    </a>
                @endif
            </div>
            <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="mobil"><i class="fas fa-mobile-alt"></i><a
                            href="tel:{{ config('contacts.mobil') }}">{{ config('contacts.mobil') }}</a></div>
                <div class="phone-1"><i class="fas fa-phone"></i><a
                            href="tel:{{ config('contacts.phone-1') }}">{{ config('contacts.phone-1') }}</a></div>
                <div class="phone-2"><i class="fas fa-phone"></i><a
                            href="tel:{{ config('contacts.phone-2') }}">{{ config('contacts.phone-2') }}</a></div>
            </div>
            <div class=" col-sm-6 col-md-5 col-lg-3">
                <div class="address"><i class="fas fa-map-marker-alt"></i>
                    <a target="_blank" href="https://goo.gl/maps/kD2RDPM2KDP2">@lang('general.address-street')</a>
                </div>
                <div class="work-time"><i class="far fa-clock"></i>@lang('general.work-time')</div>
            </div>
            <div class="col-sm-2 col-md-1 col-lg-4">
                <ul class="language-switch">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li @if($localeCode == config('app.locale'))class="active"@endif>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @lang('header.langs.' . $localeCode)
                            </a>
                        </li>
                    @endforeach
                </ul>
                <form class="form-inline search d-none d-lg-block" method="get" action="{{ route('se.search') }}" role="search">
                    <input class="form-control mr-sm-2" type="search" placeholder="@lang('header.search')"
                           aria-label="Search" name="q" value="@isset($q) {{$q}}@endisset">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</header>