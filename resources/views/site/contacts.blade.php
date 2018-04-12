@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('contacts') !!}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand">@lang('contacts.brand')</div>
                <div class="contact-us">@lang('contacts.contact-us')</div>
                <ul class="phones">
                    <li class="mobil"><i class="fas fa-mobile-alt"></i><a
                                href="tel:{{ config('contacts.mobil-alt') }}">{{ config('contacts.mobil-alt') }}</a>
                    </li>
                    <li class="phone-1"><i class="fas fa-phone-square"></i><a
                                href="tel:{{ config('contacts.phone-1-alt') }}">{{ config('contacts.phone-1-alt') }}</a>
                    </li>
                    <li class="phone-2"><i class="fas fa-phone-square"></i><a
                                href="tel:{{ config('contacts.phone-2-alt') }}">{{ config('contacts.phone-2-alt') }}</a>
                    </li>
                    <li class="mail"><i class="fas fa-envelope"></i><a
                                href="mailto:{{ config('contacts.mail') }}">{{ config('contacts.mail') }}</a></li>
                </ul>
                <div class="addr">@lang('contacts.addr')</div>
                <div class="addr-street"><i class="fas fa-map-marker-alt"></i><a target="_blank" href="https://goo.gl/maps/kD2RDPM2KDP2">@lang('general.address-street')</a></div>
            </div>
        </div>
    </div>

    @include('site._google-map', ['contacts' => false])

@endsection