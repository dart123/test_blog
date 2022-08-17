@extends('base.base')

@section('title', 'Каталог статей')

@section('content')

    @include('partials.nav_menu')

    <div class="row post_container">
            @foreach($posts as $post)
                @include('post_list_item', ['post' => $post])
            @endforeach
    </div>

    <div class="row pagination">
        <div class="col-12">
            {{$posts->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

@endsection
