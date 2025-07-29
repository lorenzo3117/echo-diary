@extends('base')

@section('content')
        <div class="grid grid-cols-2">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            <div class="col-span-2">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
@endsection
