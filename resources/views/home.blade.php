@extends('base')

@section('content')
    <div class="container-small">
        <h1 class="mb-8">Your feed</h1>

        @include('post.partials.list', ['posts' => $posts])
    </div>
@endsection
