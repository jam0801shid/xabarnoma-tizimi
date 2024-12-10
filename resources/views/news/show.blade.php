@extends('layouts.app')

@section('content')

<div class="container py-5">
    <!-- Yangilikning rasm va sarlavhasi -->
    @if (isset($news->image_url))
    <div class="position-relative mb-4">
        <img src="{{ asset('storage/' . $news->image_url) }}" class="img-fluid rounded-3 shadow-lg w-100" alt="{{ $news->title }}" style="height: 500px; object-fit: cover;">
        
        <!-- Ko'rishlar soni va yaratish vaqti -->
        <div class="position-absolute bottom-0 start-0 p-3 text-white">
            <span class="badge bg-info text-dark me-2">
                <i class="bi bi-eye"></i> {{ $news->views }} Ko'rishlar
            </span>
            <span class="badge bg-info text-dark">
                <i class="bi bi-calendar"></i> {{ $news->created_at->format('d M, Y') }}
            </span>
        </div>
    </div>
    @endif

    <!-- Yangilikning sarlavhasi va kontenti -->
    <h1 class="text-center text-primary fw-bold mb-4">{{ $news->title }}</h1>
    <p class="lead text-muted text-center mb-4">{{ $news->content }}</p>

    <hr class="my-4">

    <!-- Fikrlar bo'limi -->
    <h2 class="text-primary mb-3"><i class="bi bi-chat-left-text"></i> Fikrlar</h2>
    @foreach ($news->comments as $comment)
        <div class="card mb-3 shadow-sm rounded-3">
            <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">
                        <i class="bi bi-person-circle"></i> {{ $comment->user->name }} 
                    </span>
                    <span class="text-muted small">
                        <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Fikr qo'shish formasi -->
    <h3 class="text-secondary mb-3"><i class="bi bi-pencil-square"></i> Fikr Qo'shish</h3>
    <form action="{{ route('comment.store', $news->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" name="content" rows="4" placeholder="Fikringizni yozing..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Jo'natish</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('news.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Ortga</a>
    </div>
</div>

@endsection
