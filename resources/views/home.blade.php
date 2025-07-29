@extends('base')

@section('content')
    <div class="container-small">
        <h2 class="mb-8">Your feed</h2>

        @include('post.partials.list', ['posts' => $posts])
    </div>
@endsection
