@props([
    'post' => null,
])

@if($post)
    @canany(['update', 'delete'], $post)
        <div class="dropdown dropdown-end">
            <x-button tabindex="0" role="button" isCircle>
                <x-phosphor-note-pencil/>
            </x-button>
            <ul tabindex="0" class="dropdown-content">
                @can('update', $post)
                    <li>
                        <x-link href="{{ route('post.edit', $post) }}">Edit</x-link>
                    </li>
                @endcan
                @can('delete', $post)
                    <li>
                        <x-link x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-post')">
                            {{ __('Delete') }}
                        </x-link>
                    </li>
                @endcan
            </ul>
        </div>

        @can('delete', $post)
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
        @endcan
    @endcanany
@endif
