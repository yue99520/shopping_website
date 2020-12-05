<script>
    function addCommodityToCart(commodity_id) {
        let cart = $.cookie('cart');

        if (cart === undefined || cart === null) {
            cart = [];
        } else {
            cart = JSON.parse(cart);
        }

        let found_commodity = false;
        for (let i = 0; i < cart.length; i++) {
            if (cart[i].id === commodity_id) {
                cart[i].amount ++;
                found_commodity = true;
                break;
            }
        }

        if (! found_commodity) {
            cart.push({
                id: commodity_id,
                amount: 1,
            });
        }

        $.cookie('cart', JSON.stringify(cart), {
            expires: 60,
            path: '/'
        });

        updateCartAmount();
    }

    $(document).ready(function () {

    });
</script>
<div class="ui divided items">
    @foreach($shop->commodities as $commodity)
        @component('commodity.list.commodity', ['commodity' => $commodity])
        @endcomponent
    @endforeach
</div>
