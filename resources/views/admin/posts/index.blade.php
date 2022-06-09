@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Tutti i Post</h1>
            <a href="{{ route('admin.posts.create') }}">Crea nuovo post</a>
        </div>
        <div class="row">
            <div class="col-2">
                Titolo
            </div>
            <div class="col-4">
                Contenuto
            </div>
            <div class="col-2">
                Categoria
            </div>
            <div class="col-2">
                Tags
            </div>
            <div class="col-2">
                interagisci
            </div>
        </div>
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-2">
                    {{ $post->title }}
                </div>
                <div class="col-4">
                    {{ $post->content }}
                </div>
                <div class="col-2">
                    {{ $post->category->name }}
                </div>
                <div class="col-2">
                    @foreach ($post->tags as $tag)
                        <span>{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div class="col-2">
                    <a href="{{ route('admin.posts.show', $post->id) }}">dettaglio</a>
                    <a href="{{ route('admin.posts.create') }}">Nuovo</a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
