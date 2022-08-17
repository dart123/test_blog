@php
    if(!isset($active_menu_item))
        $active_menu_item = 'main';
@endphp
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <ul class="navbar-nav mr-auto">

        <li class="nav-item{{$active_menu_item=='main' ? ' active' : ''}}">
            <a class="nav-link" href="/">{{trans('menu.all_articles')}}</a>
        </li>
        @auth
        <li class="nav-item{{$active_menu_item=='users' ? ' active' : ''}}">
            <a class="nav-link" href="/users">{{trans('menu.user_list')}}</a>
        </li>
        <li class="nav-item{{$active_menu_item=='catalog' ? ' active' : ''}}">
            <a class="nav-link" href="/articles/my_posts">{{trans('menu.my_articles')}}</a>
        </li>
        <li class="nav-item{{$active_menu_item=='create_post' ? ' active' : ''}}">
            <a class="nav-link" href="/articles/create">{{trans('menu.create_article')}}</a>
        </li>
        @endauth
    </ul>
    @guest
        <a class="register_text" href="{{route('register')}}">{{trans('menu.register')}}</a>
        <a class="login_text" href="{{route('login')}}">{{trans('menu.login')}}</a>
    @endguest
    @auth
        @include('base.logout')
    @endauth
</nav>
