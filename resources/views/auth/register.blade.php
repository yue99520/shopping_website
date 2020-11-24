@extends('layouts.app')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            @component('component.error_message')
                register_error
            @endcomponent
            <div class="ui segments">
                <div class="ui green segment big header">
                    Register
                </div>
                <div class="ui secondary segment">
                    <form id="register_form" class="ui form">
                        @csrf
                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="name" placeholder="Ernie12345">
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="user@gmail.com">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="**********">
                        </div>
                        <div class="field">
                            <label>Password Confirm</label>
                            <input type="password" name="password_confirmation" placeholder="**********">
                        </div>
                        <button class="ui green button" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
