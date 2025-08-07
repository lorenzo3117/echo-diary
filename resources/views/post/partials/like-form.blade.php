@props([
    'post' => null,
])

@if($post)
    @can('favorite', $post)
        <form method="POST" action="{{ route('post.like', $post) }}">
            @csrf

            @if($post->favorites->contains(auth()->user()))
                <x-form.submit-button variant="secondary">
                    <x-phosphor-heart-fill/>
                    {{ __('Unfavorite') }}
                </x-form.submit-button>
            @else
                <x-form.submit-button variant="secondary">
                    <x-phosphor-heart/>
                    {{ __('Favorite') }}
                </x-form.submit-button>
            @endif
        </form>
    @endcan
@endif
