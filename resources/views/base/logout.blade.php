<p class="user_name">{{Auth::user()->name}}</p>
<form method="POST" action="{{ route('logout') }}" id="logout_form">
    @csrf

    <x-responsive-nav-link :href="route('logout')"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-responsive-nav-link>
</form>
