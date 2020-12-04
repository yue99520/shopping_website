<div class="item">
    <div class="ui small image">
        <img class="ui image" src="{{ $commodity->profile == null? asset('images/default_shop_profile.png') : asset($commodity->profile) }}">
    </div>
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
                <span>已售出 {{ $commodity->remaining_amount }} {{ $commodity->unit_string }}</span>
                <span>剩餘 {{ $commodity->remaining_amount }} {{ $commodity->unit_string }}</span>
            </div>
        </div>
        <div class="extra">
            <div class="ui small right floated buttons">
                <div class="ui animated basic green button">
                    <div class="visible content">
                        <i class="plus icon"></i>
                        購物車
                    </div>
                    <div class="hidden content">
                        <i class="shop icon"></i>
                    </div>
                </div>
                <div class="ui animated basic red button">
                    <div class="visible content">直接購買</div>
                    <div class="hidden content">
                        <i class="right arrow icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
