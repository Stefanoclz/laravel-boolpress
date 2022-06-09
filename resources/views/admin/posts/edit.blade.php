@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <select name="category_id">
            <option value="">Scegli Categoria</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach

        </select>

        <div class="form-group">
            @if ($post->cover)
                <div>
                    <img src="{{ asset('storage/' . $post->cover) }}" />
                </div>
            @endif
            <label for="image">Immagine cover</label>
            <input type="file" name="image" />
        </div>

        <div>
            <label for="title">Modifica titolo</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div>
            <label for="content">Modifica contenuto</label>
            <input type="text" name="content" value="{{ old('content', $post->content) }}">
        </div>

        <div class="form-group">
            <div>Tags</div>
            @foreach ($tags as $tag)
                <div class="row align-items-center">
                    @if ($errors->any())
                        <input type="checkbox" value="{{ $tag->id }}" name="tags[]"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                    @else
                        <input type="checkbox" value="{{ $tag->id }}" name="tags[]"
                            {{ $post->tags->contains($tag) ? 'checked' : '' }} />
                        <div class="form-check-label">{{ $tag->name }}</div>
                    @endif
                </div>
            @endforeach


            @error('tags[]')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <input type="submit" value="modifica!">
    </form>
@endsection
