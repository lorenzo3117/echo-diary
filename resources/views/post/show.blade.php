@extends('base')

@section('content')
    <div class="container-small vstack">
        <div class="hstack justify-between">
            <x-profile.avatar :user="$post->user" />
            <p class="text-muted text-sm">{{ $post->created_at->diffForHumans() }}</p>
        </div>

        <div class="divider"></div>

        <div class="hstack justify-between">
            <h2>{{ $post->title }}</h2>
            <div class="hstack">
                <x-post.status-badge :post="$post" />
                @can('update', $post)
                    <x-link href="{{ route('post.edit', $post) }}">Edit</x-link>
                @endcan
            </div>
        </div>

        <div>
            {{ $post->content }}
        </div>
    </div>
@endsection
