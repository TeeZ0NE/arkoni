<meta itemprop="name" content="@if(isset($title)){{ $title }}@else Arkoni @endif">
<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
    @lang('schema.rated'): <span
            itemprop="ratingValue">{{ number_format($rating['ratings'], 2) }}</span> @lang('schema.of') <span
            itemprop="bestRating">10</span>
    <div class="stars">
        <input type="hidden" class="rating" data-ratings="{{ $rating['ratings'] }}" data-stop="10" data-step="2"
               data-count="{{ $rating['count'] }}" value="{{ number_format($rating['ratings'], 2) }}"
               data-filled="fas fa-star fa-2x" data-empty="far fa-star fa-2x"/>
        <div class="msg">@lang('schema.msg')</div>
    </div>
    @lang('schema.reviews'): <span itemprop="ratingCount">{{ $rating['count'] }}</span>
</div>