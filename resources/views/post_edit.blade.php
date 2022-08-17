@extends('base.base')

@section('title', 'Edit post')

@section('content')

    @include('partials.nav_menu')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    <form id="edit_form" action="{{route('articles.update', [$post->id])}}" method="POST">
        {{ method_field('put') }}
        @csrf
        <input name="id" type="hidden" value="{{$post->id}}">
        <label for="title">Title</label>
        <input id="title" name="title" type="text" value="{{$post->title}}">
        <label for="description">Description</label>
        <textarea id="description" name="description" cols="5" rows="5">{{$post->description}}</textarea>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{$post->slug}}">
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
@endsection
