@extends('layouts.app')

@section('content')
    <div class="ui container">
        @component('messages.error')
            shop_edit_error
        @endcomponent
        <h3 class="ui dividing header">Manage Your Shop</h3>
        <form id="shop_edit_form" class="ui form">
            @csrf
            <input type="text" name="shop_id" value="{{ $shop->id }}" hidden>
            <div class="field">
                <label>Title</label>
                <input type="text" name="title" placeholder="title">
            </div>
            <div class="field">
                <label>Description</label>
                <textarea rows="18" name="description">{{ $shop == null? : $shop->description }}</textarea>
            </div>
            <button class="ui blue button" type="submit">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#shop_edit_form').form('set value', 'title', '{{ $shop == null? : $shop->title}}');
        });
    </script>
@endsection
