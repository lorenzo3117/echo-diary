@props([
    'user' => null,
])

@if($user)
    @can('follow', $user)
        <form action="{{ route('user.follow', $user) }}" method="POST">
            @csrf

            <x-form.submit variant="secondary">
                <x-phosphor-user-plus/>
                {{ __('Follow') }}
            </x-form.submit>
        </form>
    @endcan
    @can('unfollow', $user)
        <form action="{{ route('user.unfollow', $user) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-form.submit variant="secondary" isOutline>
                <x-phosphor-user-minus/>
                {{ __('Unfollow') }}
            </x-form.submit>
        </form>
    @endcan
@endif
