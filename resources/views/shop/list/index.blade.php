@extends('layouts.app')

@section('content')
    <div class="ui container">
        <div class="ui huge header">
            商店列表
        </div>
        <div class="ui divided items">
            @foreach($shops as $shop)
                @component('shop.list.shop', ['shop' => $shop])
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
