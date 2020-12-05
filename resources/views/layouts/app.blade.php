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
            <a class="item label">
                <i class="ui shop icon"></i>
                <div id="cart_amount">123</div>
            </a>
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
    $(document).ready(function () {
        updateCartAmount();
    });
</script>
</html>
