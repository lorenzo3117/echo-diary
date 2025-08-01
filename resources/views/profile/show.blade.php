@extends('base')

@section('content')
    <div class="container-small">
        <div class="hstack justify-between mb-8">
            <div class="hstack">
                <h2>{{ $user->username }}</h2>
                @include('profile.partials.follow-button', $user)
            </div>
            <div class="hstack">
                @can('access-admin-dashboard')
                    <x-link href="{{ route('admin.dashboard', ['email' => $user->email]) }}" asButton>
                        {{ __('Manage') }}
                    </x-link>
                @endcan
            </div>
        </div>

        @include('post.partials.list', [
            'posts' => $posts,
            'showUserInfo' => false,
        ])
    </div>
@endsection
