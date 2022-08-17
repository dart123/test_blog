@extends('base.base')

@section('title', 'Create post')

@section('content')

    @include('partials.nav_menu', ['active_menu_item' => 'create_post'])
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    <form id="create_form" action="{{route('articles.store')}}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input id="title" name="title" type="text">
        <label for="description">Description</label>
        <textarea id="description" name="description" cols="5" rows="5"></textarea>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug">
        <input type="hidden" name="user_id" value="{{!empty(Auth::user() ? Auth::user()->id : '')}}">
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
@endsection
