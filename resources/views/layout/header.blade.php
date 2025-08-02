@php use App\Models\User; @endphp

<div class="shadow-sm">
    <div class="flex items-center min-h-16 container">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="font-bold">EchoDiary</a>
        </div>
        <ul class="menu menu-horizontal items-center gap-2">
            @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
            @endguest
            @auth
                <li><a href="{{ route('post.create') }}"
                       class="btn btn-outline btn-primary btn-sm">{{ __('Create post') }}</a></li>
                @can('access-admin-dashboard', User::class)
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a></li>
                @endcan
                @include('profile.partials.header-button')
            @endauth
        </ul>
    </div>
</div>
