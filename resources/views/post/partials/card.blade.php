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
                <div class="hstack justify-between">
                    <h3 class="card-title line-clamp-2">{{ $post->title }}</h3>
                    <x-post.status-badge :post="$post"/>
                </div>
                <p class="line-clamp-5">{{ $post->description }}</p>
            </a>
            <div @class([
                    'card-actions items-end mt-4',
                    'justify-between' => $showUserInfo,
                    'justify-end' => !$showUserInfo,
                ])>
                @if($showUserInfo)
                    <x-profile.avatar :user="$post->user"/>
                @endif
                <p class="text-muted text-sm">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
@endif


