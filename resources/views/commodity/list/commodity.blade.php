<div class="item">
    <a class="ui small image">
        <img src="{{ $commodity->profile == null? asset('images/default_shop_profile.png') : asset($commodity->profile) }}">
    </a>
    <div class="top aligned content">
        <a class="header">{{ $commodity->title }}</a>
        <div class="ui red right floated meta">
            <div class="ui blue right tag label">價格 {{ $commodity->price }} 元</div>
        </div>
        <div class="description">
            {{ $commodity->description }}
        </div>
        <div class="extra">
            <div class="ui right floated meta">
                <span>已售出 {{ $commodity->sold_amount }} {{ $commodity->unit_string }}</span>
                <span>剩餘 {{ $commodity->remaining_amount }} {{ $commodity->unit_string }}</span>
            </div>
        </div>
        <div class="extra">
            <div class="ui small right floated buttons">
                <div id="add_to_cart_button"
                     class="ui animated basic green {{ $commodity->remaining_amount == 0 ? 'disabled' : '' }} button"
                     onclick="addCommodityToCart({{ $commodity->id }});"
                     data-content="已加入 1 項商品至購物車">
                    <div class="visible content">
                        <i class="plus icon"></i>
                        購物車
                    </div>
                    <div class="hidden content">
                        <i class="shop icon"></i>
                    </div>
                </div>
                <div class="ui animated basic red {{ $commodity->remaining_amount == 0 ? 'disabled' : '' }} button">
                    <div class="visible content">{{ $commodity->remaining_amount == 0 ? '已售完' : '直接購買' }}</div>
                    <div class="hidden content">
                        <i class="right arrow icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
