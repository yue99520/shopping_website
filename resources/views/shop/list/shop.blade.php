<div class="item">
    <div class="image">
        <img src="{{ asset($shop->profile == null? asset('images/default_shop_profile.png') : $shop->profile) }}" alt="{{ $shop->title }}">
    </div>
    <div class="content">
        <a class="header">{{ $shop->title }}</a>
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
