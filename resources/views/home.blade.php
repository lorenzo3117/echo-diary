@extends('base')

@section('content')
    <div class="container-small">
        <h1>Your feed</h1>

        @include('post.partials.list', ['posts' => $posts])
    </div>
@endsection
