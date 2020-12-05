<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="url" content="{{ route('root') }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('semantic-dist/semantic.css') }}">
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{ asset('semantic-dist/semantic.js') }}"></script>
</head>
<body>
<div class="ui container-fluid">
    <div class="ui menu">
        <a class="item" href="{{ route('home') }}">
            <div class="huge header">
                HOME
            </div>
        </a>
        <a class="item" href="{{ route('shop.index') }}">
            Stores
        </a>
        <div class="right menu">
            <a id="shopping_cart" class="item label">
                <i class="ui shop icon"></i>
                <div id="cart_amount"></div>
            </a>
            <div class="ui flowing popup bottom center transition hidden">
                <div class="ui small header">購物車
                    <button class="ui very basic right floated tiny button" onclick="clearCart()">清空</button>
                </div>
                <div class="ui segment">
                    <table class="ui very basic table">
                        <thead>
                            <tr>
                                <th>商品名稱</th>
                                <th>數量</th>
                                <th class="right aligned">總計</th>
                            </tr>
                        </thead>
                        <tbody id="cart_preview_tbody">
                        </tbody>
                    </table>
                </div>
                <div class="ui extra">
                    <button class="ui green tiny right floated button">去結帳</button>
                </div>
            </div>
            <div class="item">
                <div class="ui input">
                    <input type="text" placeholder="Search..." >
                </div>
            </div>
            @guest
                <a class="item" href="{{ route('login') }}">
                    Login
                </a>
                <a class="item" href="{{ route('register') }}">
                    Register
                </a>
            @else
                <div class="ui dropdown item">
                    <i class="user icon"></i>
                    <div class="menu">
                        <a class="item" href="{{ route('shop.dashboard') }}">My Store</a>
                        <div class="item">Something</div>
                        <div class="item">Something</div>
                        <div class="divider"></div>
                        <div id="logout_button" class="item">
                            Log out<i class="sign-out icon"></i>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
    <div id="csrf" hidden>
        {{ csrf_token() }}
    </div>
    @yield('content')
</div>
</body>
<template id="cart_preview_tbody_template">
    <tr>
        <td id="cart_preview_tbody_title"></td>
        <td id="cart_preview_tbody_amount"></td>
        <td id="cart_preview_tbody_total" class="right aligned"></td>
    </tr>
</template>
<script>
    function updateCartAmount() {
        let cart = $.cookie('cart');
        if (cart === undefined || cart === null) {
            $('#cart_amount').html(0);
        } else {
            cart = JSON.parse(cart);
            let count = 0;
            for (let i = 0; i < cart.length; i++) {
                count = count + cart[i].amount;
            }
            $('#cart_amount').html(count);
        }
    }

    function getCartPreviewTbodyTemplate() {
        let html = $("#cart_preview_tbody_template").html();
        return $(html).clone();
    }

    function clearCart() {
        let cart = [];
        $.cookie('cart', JSON.stringify(cart), {
            expires: 60,
            path: '/'
        });

        updateCartAmount();
        updateCartPreviewContent();
    }

    function updateCartPreviewContent() {
        function getPreviewString(str, max) {
            if (str.length > max) {
                return str.substr(0, max) + '...';
            }
            return str;
        }

        let cart = $.cookie('cart');
        if (cart === undefined || cart === null) {
            cart = [];
        } else {
            cart = JSON.parse(cart);
        }

        let template = getCartPreviewTbodyTemplate();

        let html = '';
        let total = 0;
        $.each(cart, function (key, ele) {
            let temp_total = ele.price * ele.amount;
            total += temp_total;

            template.find('#cart_preview_tbody_title').text(getPreviewString(ele.title, 20));
            template.find('#cart_preview_tbody_amount').text(ele.amount);
            template.find('#cart_preview_tbody_total').text(temp_total + ' 元');

            html += template[0].outerHTML;
        });

        template.find('#cart_preview_tbody_title').text('');
        template.find('#cart_preview_tbody_amount').text('');
        template.find('#cart_preview_tbody_total').text('小計： ' + total + ' 元');

        html += template[0].outerHTML;

        $('#cart_preview_tbody').html(html);
    }

    $(document).ready(function () {
        updateCartAmount();

        $('#shopping_cart').click(function () {
            updateCartPreviewContent();
        });

        $('#shopping_cart')
            .popup({
                on: 'click'
            })
        ;
    });
</script>
</html>
