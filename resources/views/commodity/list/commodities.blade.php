<div class="ui divided items">
    @foreach($shop->commodities as $commodity)
        @component('commodity.list.commodity', ['commodity' => $commodity])
        @endcomponent
    @endforeach
</div>
