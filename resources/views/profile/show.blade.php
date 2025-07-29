@extends('base')

@section('content')
    <div class="hstack justify-between">
        <h2>{{ $user->username }}</h2>
        <div class="hstack">
            @if(auth()->user()->can('update', $user) && auth()->user() == $user)
                <x-link href="{{ route('profile.edit') }}" asButton>
                    {{ __('Settings') }}
                </x-link>
            @endif
{{--            TODO fix RoleSeeder--}}
{{--            @can('update', auth()->user())--}}
{{--                <x-link href="{{ route('profile.edit') }}" asButton>--}}
{{--                    {{ __('Settings') }}--}}
{{--                </x-link>--}}
{{--            @endcan--}}
            @can('roles', $user)
                <x-link href="{{ route('admin.dashboard', ['email' => $user->email]) }}" asButton>
                    {{ __('Edit roles') }}
                </x-link>
            @endcan
        </div>
    </div>
@endsection
