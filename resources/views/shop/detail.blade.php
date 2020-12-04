<div class="ui row">
    <div class="three wide column">
        <img class="ui fluid image" src="{{ $shop->profile == null? asset('images/default_shop_profile.png') : asset($shop->profile) }}" alt="{{ $shop->title }}">
    </div>
    <div class="thirteen wide column">
        <div class="ui huge header">
            {{ $shop->title }}
            @if($manage_edit_button ?? '')
                <button id="edit_shop_button" class="ui right floated button" data-shop="{{ $shop->id }}"><i class="edit icon"></i>Edit Shop</button>
            @endif
        </div>
        <div class="description">
            Total {{ $shop->commodities()->count() }} commodities
        </div>
        <div class="ui divider"></div>
        <div class="ui list">
            <div class="item">
                <i class="ui user icon"></i>
                <div class="content">
                    Managed by: <a>{{ '@' . $shop->user->name }}</a>
                </div>
            </div>
            <div class="item">
                <i class="ui mail icon"></i>
                <div class="content">
                    Email: {{ $shop->user->email }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui row">
    <div class="sixteen wide column">
        <div class="ui header">
            About the brand
            <div class="ui divider"></div>
        </div>
        <div class="text container">
            <p>
                {{ $shop->description }}
            </p>
        </div>
    </div>
</div>
