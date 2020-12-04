@extends('layouts.app')

@section('content')
    @guest
        尚未登入
    @else
        已經登入
    @endguest
@endsection
