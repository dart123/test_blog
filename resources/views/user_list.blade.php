@extends('base.base')

@section('title', 'User list')

@section('content')

    @include('partials.nav_menu', ['active_menu_item' => 'users'])
    <div class="user_container">
    <div class="row">
        <div class="col-3">Id</div>
        <div class="col-3">Name</div>
        <div class="col-3">Email</div>
        <div class="col-3">Created at</div>
    </div>
    @foreach($users as $user)
        <div class="row">
            <div class="col-3">{{$user->id}}</div>
            <div class="col-3">{{$user->name}}</div>
            <div class="col-3">{{$user->email}}</div>
            <div class="col-3">{{$user->created_at}}</div>
        </div>
    @endforeach
    </div>
@endsection
