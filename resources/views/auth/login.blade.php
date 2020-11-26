@extends('layouts.app')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            @component('messages.error')
                login_error
            @endcomponent
            <div class="ui segments">
                <div class="ui blue segment big header">
                    Login
                </div>
                <div class="ui secondary segment">
                    <form id="login_form" class="ui form">
                        @csrf
                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="user@gmail.com">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="**********">
                        </div>
                        <button class="ui blue button" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
