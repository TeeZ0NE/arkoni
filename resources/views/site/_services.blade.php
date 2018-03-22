<div class="services">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('site._calc-aside')
            </div>
            <div class="col-md-4">
                <div class="block block-2">
                    <div class="title">@lang('front.services.block-2.title')</div>
                    <div class="body">@lang('front.services.block-2.body')</div>
                    <a class="go-to"
                       href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('front.services.block-2.go-to')<i
                                class="far fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block block-3">
                    <div class="title">@lang('front.services.block-3.title')</div>
                    <div class="body">@lang('front.services.block-3.body')</div>
                    <a class="go-to"
                       href="{{ LaravelLocalization::LocalizeURL('/') }}">@lang('front.services.block-3.go-to')<i
                                class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>