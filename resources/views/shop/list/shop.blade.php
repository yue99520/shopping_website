<div class="item">
    <div class="image">
        <img src="{{ asset($shop->image == null? asset('images/default_shop_profile.png') : $shop->image) }}" alt="{{ $shop->title }}">
    </div>
    <div class="content">
        <div class="ui huge header">{{ $shop->title }}</div>
        <div class="description">
            <p>{{ $shop->description }}</p>
        </div>
        <div class="extra">
            <div class="ui right floated meta">
                <span>總共 {{ $shop->commodities()->get()->count() }} 項商品</span>
            </div>
        </div>
        <div class="extra">
            <a class="ui animated primary right floated button" href="{{ route('shop.show', ['shop' => $shop->id]) }}">
                <div class="visible content">瀏覽更多</div>
                <div class="hidden content">
                    <i class="right arrow icon"></i>
                </div>
            </a>
        </div>
    </div>
</div>
