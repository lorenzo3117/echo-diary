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
                    @can('admin-dashboard')
                        <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endcan
                    <li><a href="{{ route('profile.show', auth()->user()) }}">Profile</a></li>
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
