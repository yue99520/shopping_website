@extends('layouts.app')

@section('content')
    <div class="ui container">
        <div class="ui items">
            @foreach($shops as $shop)
                @component('shop.list.shop', ['shop' => $shop])
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
