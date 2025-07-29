@extends('base')

@section('content')
    <div class="container-small vstack gap-8">
        <div class="hstack justify-between">
            <x-profile.avatar :user="$post->user" />
            <div class="hstack">
                <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>
                @can('update', $post)
                    <x-badge>{{ $post->status }}</x-badge>
                    <x-link href="{{ route('post.edit', $post) }}">Edit</x-link>
                @endcan
            </div>
        </div>

        <h2>{{ $post->title }}</h2>

        <div>
            {{ $post->content }}
        </div>
    </div>
@endsection
