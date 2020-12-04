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
                @component('commodity.list.commodities', ['shop' => $shop])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
