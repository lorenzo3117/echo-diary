@extends('base')

@section('content')
    <div class="container-small">
        <h2 class="mb-8">{{ __('Your notifications') }}</h2>

        <div class="vstack">
            <ul class="dropdown-content w-full">
                @include('notifications.partials.menu-list-items', [
                    'notifications' => $unreadNotifications
                ])
            </ul>

            {{ $unreadNotifications->links() }}
        </div>
    </div>
@endsection
