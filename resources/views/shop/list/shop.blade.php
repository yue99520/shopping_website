<div class="item">
    <div class="image">
        <img src="{{ asset($shop->image == null? asset('images/default_shop_profile.png') : $shop->image) }}" alt="{{ $shop->title }}">
    </div>
    <div class="content">
        <a class="header" href="{{ route('shop.show', ['shop' => $shop->id]) }}">{{ $shop->title }}</a>
        <div class="meta">
            <span>something here</span>
        </div>
        <div class="description">
            <p>{{ $shop->description }}</p>
        </div>
        <div class="extra">
            Total {{ $shop->commodities()->get()->count() }} commodities
        </div>
    </div>
</div>
