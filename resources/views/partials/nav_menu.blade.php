<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item{{$active_menu_item=='main' ? ' active' : ''}}">
            <a class="nav-link" href="/">Все статьи</a>
        </li>
        @auth
        <li class="nav-item{{$active_menu_item=='catalog' ? ' active' : ''}}">
            <a class="nav-link" href="/articles/my_posts">Мои статьи</a>
        </li>
        @endauth
    </ul>
    @guest
        <a class="login_text" href="{{route('login')}}">Log in</a>
    @endguest
    @auth
        @include('base.logout')
    @endauth
</nav>
