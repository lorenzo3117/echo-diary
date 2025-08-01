@extends('base')

@section('content')
    <div class="container-small vstack">
        <div class="vstack gap-8">
            <div class="hstack">
                <x-profile.avatar :user="$post->user"/>
                <p class="text-muted text-sm">&#x2022;</p>
                <p class="text-muted text-sm">{{ $post->created_at->diffForHumans() }}</p>
            </div>

            <div class="hstack justify-between">
                <h1>{{ $post->title }}</h1>

                <div class="hstack">
                    <x-post.status-badge :post="$post"/>
                    @include('post.partials.action-menu', $post)
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div>
            {{ sanitizeHtml($post->content) }}
        </div>
    </div>
@endsection
