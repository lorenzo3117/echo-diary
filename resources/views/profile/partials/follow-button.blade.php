@props([
    'user' => null,
])

@if($user)
    @can('follow', $user)
        <form action="{{ route('user.follow', $user) }}" method="POST">
            @csrf

            <x-form.submit-button variant="secondary" isSmall>
                <x-phosphor-user-plus/>
                {{ __('Follow') }}
            </x-form.submit-button>
        </form>
    @endcan
    @can('unfollow', $user)
        <form action="{{ route('user.unfollow', $user) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-form.submit-button variant="secondary" isOutline isSmall>
                <x-phosphor-user-minus/>
                {{ __('Unfollow') }}
            </x-form.submit-button>
        </form>
    @endcan
@endif
