@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <select name="category_id">
            <option value="">Scegli Categoria</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach

        </select>

        <div class="form-group">
            <label for="image">Immagine cover</label>
            <input type="file" name="image" />
        </div>

        <div>
            <label for="title">Inserisci titolo</label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="content">Inserisci contenuto</label>
            <input type="text" name="content">
        </div>

        <input type="submit" value="Crea!">


        <div class="form-group">
            <div>Tags</div>
            @foreach ($tags as $tag)
                <div class="row align-items-center">
                    <input class="mx-2" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                    <div class="form-check-label">{{ $tag->name }}</div>
                </div>
            @endforeach

            @error('tags[]')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

    </form>
@endsection
