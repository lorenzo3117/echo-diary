@php use App\Models\User; @endphp

@extends('base')

@section('content')
    <div class="container-small">
        <div class="hstack justify-between mb-8">
            <h2>{{ $user->username }}</h2>
            <div class="hstack">
                @can('admin-dashboard', User::class)
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
