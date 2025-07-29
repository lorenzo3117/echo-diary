@props([
    'post' => null,
    'showUserInfo' => true,
])

@if($post)
    <div class="card">
        {{--        <figure>--}}
        {{--            <img--}}
        {{--                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"--}}
        {{--                alt="Shoes" />--}}
        {{--        </figure>--}}
        <div class="card-body">
            <a href="{{ route('post.show', $post) }}" class="vstack">
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="line-clamp-5">{{ $post->description }}</p>
            </a>
            <div @class([
                    'card-actions items-end',
                    'justify-between' => $showUserInfo,
                    'justify-end' => !$showUserInfo,
                ])>
                @if($showUserInfo)
                    <x-profile.avatar :user="$post->user"/>
                @endif
                <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
@endif


