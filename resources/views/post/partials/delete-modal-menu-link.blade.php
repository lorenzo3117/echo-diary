@props([
    'post' => null,
])

<x-link x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-post')">
    {{ __('Delete') }}
</x-link>

<x-modal name="delete-post" focusable>
    <h2>{{ __('Delete post?') }}</h2>

    <p>{{ __('Are you sure you want to delete this post? This action is irreversible.') }}</p>

    <form method="post" action="{{ route('post.destroy', $post) }}">
        @csrf
        @method('DELETE')

        <x-form.submit variant="error">
            {{ __('Delete') }}
        </x-form.submit>
    </form>
</x-modal>
