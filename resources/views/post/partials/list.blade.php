@props([
    'posts' => null,
    'showUserInfo' => true,
])

@if($posts == null || $posts->isEmpty())
    <p class="center py-16">{{ __('No posts to show') }}</p>
@else
    <div class="vstack gap-8">
        @foreach ($posts as $post)
            @include('post.partials.card', [
                'post' => $post,
                'showUserInfo' => $showUserInfo,
            ])
        @endforeach

        {{ $posts->onEachSide(1)->links() }}
    </div>
@endif
