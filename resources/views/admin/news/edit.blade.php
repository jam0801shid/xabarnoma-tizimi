@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-primary mb-4">Yangilikni Tahrirlash</h1>

    <form action="{{ route('admin.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Sarlavha</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $news->title }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoriya</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Rasm (agar kerak bo'lsa)</label>
            <input type="file" name="image" class="form-control" id="image">
            @if($news->image_url)
                <img src="{{ asset('storage/' . $news->image_url) }}" class="img-fluid mt-2" alt="Current Image" style="max-width: 200px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Kontent</label>
            <textarea name="content" class="form-control" id="content" rows="5" required>{{ $news->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Yangilash</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>
</div>
@endsection
