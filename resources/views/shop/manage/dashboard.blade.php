@extends('layouts.app')

@section('content')
    <div class="ui grid container">
        @if($shop == null)
            <div class="ui placeholder segment">
                <div class="ui icon header">
                    <i class="shop icon"></i>
                    You haven't create a shop.
                </div>
                <div class="ui primary button">Create one!</div>
            </div>
        @else
            <div class="ui row">
                <div class="ten wide column">
                    <div class="ui segment">
                        some basic shop information here
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
