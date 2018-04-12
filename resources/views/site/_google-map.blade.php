<div class="google-map">
    <div id="map"></div>
    @if(!isset($contacts))
        <div class="shadow"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6 col-ls-5 content">
                    <div class="brand">@lang('front.google-map.brand')</div>
                    <div class="located">@lang('front.google-map.located')</div>
                    <div class="address"><i class="fas fa-map-marker-alt"></i>
                        <a target="_blank" href="https://goo.gl/maps/kD2RDPM2KDP2">@lang('general.address-street')</a>
                    </div>
                    <div class="work">@lang('front.google-map.work')</div>
                    <div class="work-time">@lang('general.work-time')</div>
                    <div class="call">@lang('front.google-map.call')</div>
                    <div class="mobil"><i class="fas fa-mobile-alt"></i><a
                                href="tel:{{ config('contacts.mobil') }}">{{ config('contacts.mobil') }}</a></div>
                    <div class="phone-1"><i class="fas fa-phone"></i><a
                                href="tel:{{ config('contacts.phone-1') }}">{{ config('contacts.phone-1') }}</a></div>
                    <div class="phone-2"><i class="fas fa-phone"></i><a
                                href="tel:{{ config('contacts.phone-2') }}">{{ config('contacts.phone-2') }}</a></div>
                </div>
            </div>
        </div>
    @endif
</div>