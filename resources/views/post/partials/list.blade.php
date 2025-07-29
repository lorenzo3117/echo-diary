@props([
    'posts' => null,
    'showUserInfo' => true,
])

@if($posts == null || $posts->isEmpty())
    <p class="center">{{ __('No posts to show') }}</p>
@else
    <div class="vstack gap-8">
        @foreach ($posts as $post)
            @include('post.partials.card', [
                'post' => $post,
                'showUserInfo' => $showUserInfo,
            ])
        @endforeach
    </div>
@endif
