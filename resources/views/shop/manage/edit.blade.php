@extends('layouts.app')

@section('content')
    <div class="ui container">
        @component('messages.error')
            shop_edit_error
        @endcomponent
        <div class="ui segment">
            <h3 class="ui dividing header">Manage Your Shop</h3>
            <form id="shop_edit_form" class="ui form" enctype="multipart/form-data">
                @csrf
                <input type="text" name="shop_id" value="{{ $shop->id }}" hidden>
                <div class="field">
                    <label>商店名稱</label>
                    <input type="text" name="title" placeholder="title">
                </div>
                <div class="field">
                    <label>
                        商店圖像
                    </label>
                    <img id="image_input_preview" class="ui medium image" src="{{ $shop->image == null? asset('images/default_shop_profile.png') : $shop->image }}" alt="{{ $shop->title }}">
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
                    <label>介紹</label>
                    <textarea rows="18" name="description">{{ $shop == null? : $shop->description }}</textarea>
                </div>
                <button class="ui blue button" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#shop_edit_form').form('set value', 'title', '{{ $shop == null? : $shop->title}}');
        });
    </script>
@endsection
