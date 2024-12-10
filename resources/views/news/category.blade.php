@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-primary mb-4">{{ $category->name }} bo‘limidagi yangiliklar</h1>

    @if($news->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($news as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if ($item->image_url)
                            <img src="{{ asset('storage/' . $item->image_url) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex justify-content-center align-items-center text-white" style="height: 200px;">
                                <span>No Image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $item->title }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($item->content, 100, '...') }}
                            </p>
                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i> Batafsil
                            </a>
                        </div>
                        <div class="card-footer text-muted small">
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $news->links() }}
        </div>
    @else
        <p class="text-muted">Bu kategoriyada hali yangiliklar mavjud emas.</p>
    @endif

    <a href="{{ route('news.index') }}" class="btn btn-secondary mt-4"><i class="bi bi-arrow-left"></i> Ortga</a>
</div>
@endsection
