@props([
    'comment' => null,
])

@if($comment)
    @canany(['update', 'delete'], $comment)
        <div class="dropdown dropdown-end">
            <x-button tabindex="0" role="button" isCircle>
                <x-phosphor-note-pencil/>
            </x-button>
            <ul tabindex="0" class="dropdown-content">
                @can('update', $comment)
                    <li>
                        <x-link x-data="" x-on:click.prevent="$dispatch('open-modal', 'update-comment-{{ $comment->id }}')">
                            {{ __('Update') }}
                        </x-link>
                    </li>
                @endcan
                @can('delete', $comment)
                    <li>
                        <x-link x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-comment-{{ $comment->id }}')">
                            {{ __('Delete') }}
                        </x-link>
                    </li>
                @endcan
            </ul>
        </div>

        @can('update', $comment)
            <x-modal name="update-comment-{{ $comment->id }}" focusable>
                @include('comment.partials.form', ['comment' => $comment])
            </x-modal>
        @endcan

        @can('delete', $comment)
            <x-modal name="delete-comment-{{ $comment->id }}" focusable>
                <h2>{{ __('Delete comment?') }}</h2>

                <p>{{ __('Are you sure you want to delete this comment? This action is irreversible.') }}</p>

                <form method="post" action="{{ route('comment.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')

                    <x-form.submit-button variant="error">
                        {{ __('Delete') }}
                    </x-form.submit-button>
                </form>
            </x-modal>
        @endcan
    @endcanany
@endif
