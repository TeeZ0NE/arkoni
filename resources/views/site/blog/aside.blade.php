@include('site._calc-aside')

<div class="offers-aside-block">
    <a href="{{ LaravelLocalization::LocalizeURL('/s-kraski-dlya-vnutrennih-rabot') }}">
        <img class="img-fluid" src="{{ asset('images/offers-aside-block-' . config('app.locale') . '.png') }}">
    </a>
</div>

@include('site._contacts-aside')