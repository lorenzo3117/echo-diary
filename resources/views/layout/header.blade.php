<div class="shadow-sm">
    <div class="flex items-center min-h-16 container">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="font-bold">EchoDiary</a>
        </div>
        <div class="flex items-center gap-2">
            <ul class="menu menu-horizontal">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="link no-underline" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
