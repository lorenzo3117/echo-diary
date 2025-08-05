@php use App\Models\User; @endphp

<div class="shadow-sm">
    <div class="flex items-center min-h-16 container">
        <div class="flex-1 hstack">
            <a href="{{ route('home') }}" class="font-bold">EchoDiary</a>
            @include('layout.header.partials.locale-select')
        </div>
        <ul class="menu menu-horizontal items-center gap-2">
            @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
            @endguest
            @auth
                <li>
                    <a href="{{ route('post.create') }}"
                       class="btn btn-outline btn-primary btn-sm"
                    >
                        {{ __('Create post') }}
                    </a>
                </li>
                @can('access-admin-dashboard', User::class)
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a></li>
                @endcan
                @include('layout.header.partials.notifications-dropdown')
                @include('layout.header.partials.profile-dropdown')
            @endauth
        </ul>
    </div>
</div>
