@extends('layouts.app')

@section('content')
    <div class="ui grid container">
        @if($shop == null)
            <div class="ui two column centered row">
                <div class="ui placeholder segment">
                    <div class="ui icon header">
                        <i class="shop icon"></i>
                        Sorry, You don't have a shop yet.
                    </div>
                    <a class="ui primary button" href="{{ route('shop.create') }}">
                        Create now!
                        <i class="right arrow icon"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="ui row">
                <div class="ten wide column">
                    <img class="ui small left floated image" src="{{ asset($shop->profile == null? asset('images/default_shop_profile.png') : $shop->profile) }}" alt="{{ $shop->title }}">
                    <div class="ui huge header">
                        {{ $shop->title }}
                        <button id="edit_shop_button" class="ui right floated button" data-shop="{{ $shop->id }}"><i class="edit icon"></i>Edit</button>
                    </div>
                    <div class="text container">
                        <div class="content">
                            {{ $shop->description }}
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui segment">
                        ten of the most popular commodities in this shop
                    </div>
                </div>
            </div>
            <div class="ui row">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        some cool graphic here
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
