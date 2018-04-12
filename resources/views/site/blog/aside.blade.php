@include('site._calc-aside')

<div class="offers-aside-block">
    <a href="{{ LaravelLocalization::LocalizeURL('/') }}">
        <img class="img-fluid" src="{{ asset('images/offers-1.png') }}">
    </a>
</div>

@include('site._contacts-aside')