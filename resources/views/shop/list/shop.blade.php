<div class="item">
    <div class="image">
        <img src="{{ asset($shop->profile == null? asset('images/default_shop_profile.png') : $shop->profile) }}" alt="{{ $shop->title }}">
    </div>
    <div class="content">
        <a class="header">{{ $shop->title }}</a>
        <div class="meta">
            <span>Description</span>
        </div>
        <div class="description">
            <p>test content</p>
        </div>
        <div class="extra">
            Total {{ $shop->commodities()->get()->count() }} commodities
        </div>
    </div>
</div>
