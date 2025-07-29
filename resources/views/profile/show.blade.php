@extends('base')

@section('content')
    <div class="container-small">
        <div class="hstack justify-between mb-8">
            <h2>{{ $user->username }}</h2>
            <div class="hstack">
                @can('roles', $user)
                    <x-link href="{{ route('admin.dashboard', ['email' => $user->email]) }}" asButton>
                        {{ __('Edit roles') }}
                    </x-link>
                @endcan
            </div>
        </div>

        @include('post.partials.list', [
            'posts' => $user->posts,
            'showUserInfo' => false,
        ])
    </div>
@endsection
