@extends('layouts.app')

@section('content')
    <div class="ui container">
        @component('messages.error')
            shop_create_error
        @endcomponent
        <h3 class="ui dividing header"><i class="ui shop icon"></i>Create your own shop</h3>
        <form id="shop_create_form" class="ui form">
            @csrf
            <div class="field">
                <label>商店名稱</label>
                <input type="text" name="title" placeholder="title">
            </div>
            <div class="field">
                <label>介紹</label>
                <textarea rows="4" name="description"></textarea>
            </div>
            <button class="ui blue button" type="submit">Submit</button>
        </form>
    </div>
@endsection
