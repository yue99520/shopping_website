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
            @component('shop.detail', [
                            'shop' => $shop,
                            'manage_edit_button' => true
                        ])
            @endcomponent
        @endif
    </div>
@endsection
