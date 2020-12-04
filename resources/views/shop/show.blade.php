@extends('layouts.app')

@section('content')
    <div class="ui grid container">
        @component('shop.detail', ['shop' => $shop])
        @endcomponent
        <div class="ui row">
            <div class="sixteen wide column">
                <div class="ui header">
                    商品
                    <div class="ui divider"></div>
                </div>
                <div>
                    <div class="ui items">
                        @foreach($shop->commodities as $commodity)
                            @component('commodity.list.commodity', ['commodity' => $commodity])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
