@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-primary mb-4">Yangilik Qo'shish</h1>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Sarlavha</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoriya</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Rasm</label>
            <input type="file" name="image" class="form-control" id="image" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Kontent</label>
            <textarea name="content" class="form-control" id="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Qo'shish</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>
</div>
@endsection
