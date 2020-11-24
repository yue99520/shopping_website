@extends('layouts.app')

@section('content')
    @guest
        You are guest.
    @else
        You are logged in.
    @endguest
@endsection
