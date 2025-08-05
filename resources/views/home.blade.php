@php use App\Models\User; @endphp

@extends('base')

@section('content')
    <div class="container-small">
        <div class="hstack justify-between mb-8">
            <h1>{{ __('Your feed') }}</h1>
            @can('filter-followings', User::class)
                <form method="GET" action="{{ route('home') }}" id="followingForm">
                    <x-form.checkbox
                        label="{{ __('Only following') }}"
                        name="following"
                        x-data=""
                        x-on:change="document.getElementById('followingForm').submit()"
                        isToggle
                    />
                </form>
            @endcan
        </div>

        @include('post.partials.list', ['posts' => $posts])
    </div>
@endsection
