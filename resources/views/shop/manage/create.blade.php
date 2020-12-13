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
                <label>Title</label>
                <input type="text" name="title" placeholder="title">
            </div>
            <div class="field">
                <label>
                    商店圖像
                </label>
                <img id="image_input_preview" class="ui medium image" src="{{ asset('images/default_shop_profile.png') }}">
                <br>
                <div class="ui input">
                    <label for="image_input" class="ui icon button">
                        選擇檔案
                        <i class="file icon"></i>
                    </label>
                    <input type="file" id="image_input" name="image" style="display:none" data-image="" accept="image/png,image/jpg,image/jpeg,image/JPEG,image/JPG">
                </div>
            </div>
            <div class="field">
                <label>Description</label>
                <textarea rows="4" name="description"></textarea>
            </div>
            <button class="ui blue button" type="submit">Submit</button>
        </form>
    </div>
@endsection
