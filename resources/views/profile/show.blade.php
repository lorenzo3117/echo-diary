@php use App\Models\User; @endphp

@extends('base')

@section('content')
    <div class="container-small">
        <div class="hstack justify-between mb-8">
            <div class="hstack">
                <x-profile.avatar :user="$user" variant="big" />
                @include('profile.partials.follow-button', $user)
            </div>
            <div class="hstack">
                @can('access-admin-dashboard', User::class)
                    <x-link href="{{ route('admin.dashboard', ['email' => $user->email]) }}" asButton>
                        {{ __('Manage') }}
                    </x-link>
                @endcan
            </div>
        </div>

        @include('profile.partials.stats', ['user' => $user, 'postsCount' => $postsCount])

        <div class="divider my-8"></div>

        @include('post.partials.list', [
            'posts' => $posts,
            'showUserInfo' => false,
        ])
    </div>
@endsection
