@extends('base')

@section('content')
    <div class="container-small">
        <h2 class="mb-8">{{ __('Create a new post') }}</h2>

        @include('post.partials.form')
    </div>
@endsection
