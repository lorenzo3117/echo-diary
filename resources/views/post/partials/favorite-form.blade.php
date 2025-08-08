@props([
    'post' => null,
])

@if($post)
    @can('favorite', $post)
        <form method="POST" action="{{ route('post.like', $post) }}">
            @csrf

            @if($post->favorites->contains(auth()->user()))
                <x-form.submit-button variant="secondary" isCircle isOutline>
                    <x-phosphor-heart-fill/>
                </x-form.submit-button>
            @else
                <x-form.submit-button variant="secondary" isCircle isOutline>
                    <x-phosphor-heart/>
                </x-form.submit-button>
            @endif
        </form>
    @endcan
@endif
