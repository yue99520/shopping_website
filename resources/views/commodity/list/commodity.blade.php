<div class="item">
    <div class="ui small image">
        <img class="ui image" src="{{ $commodity->profile == null? asset('images/default_shop_profile.png') : asset($commodity->profile) }}">
    </div>
    <div class="middle aligned content">
        <a class="header">{{ $commodity->title }}</a>
        <div class="meta">
            <span class="price">價格 $1200</span>
        </div>
        <div class="description">

        </div>
        <div class="extra">
            <div class="ui right floated buttons">
                <div class="ui green labeled icon button">
                    <i class="ui shop icon"></i>
                    Add to Cart
                </div>
                <div class="ui red button">
                    Buy Now
                </div>
            </div>
        </div>
    </div>
</div>
