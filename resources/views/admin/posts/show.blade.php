@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div>
            <img src="{{ asset('storage/' . $post->cover) }}" />
        </div>
        <div>
            {{ $post->title }}
        </div>
        <div>
            {{ $category->name }}
        </div>
        <div>
            {{ $post->content }}
        </div>
        <div>
            <h5>Tags</h5>
            @foreach ($post->tags as $tag)
                <span>{{ $tag->name }}</span>
            @endforeach
        </div>
        <div>
            <a href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Elimina</button>
            </form>

        </div>
        <a href="{{ route('admin.posts.index') }}">Indietro</a>
    </div>
@endsection
