@extends('base')

@section('content')
    <div class="container-small">
        <h2 class="mb-8">{{ __('Edit post :title', ['title' => $post->title]) }}</h2>

        @include('post.partials.form', ['post' => $post])
    </div>
@endsection
