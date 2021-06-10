@extends('backend.layouts.backend-master')
@section('main-content')
<messanger :reciever="{{$reciever}}" :sender="{{auth()->user()}}" :users="{{$users}}"
    :messages="{{auth()->user()->unreadNotifications}}"></messanger>
@endsection
