@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Asosiy yangilik -->
        <div class="col-lg-8 mb-4">
            @if($mainNews)
            <div class="card border-0 shadow-lg rounded-3 mb-4">
                @if($mainNews->image_url)
                    <img src="{{ asset('storage/' . $mainNews->image_url) }}" 
                        class="card-img-top rounded-3" 
                        alt="{{ $mainNews->title }}" 
                        style="height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h1 class="fw-bold text-primary mb-3">{{ $mainNews->title }}</h1>
                    <p class="text-muted mb-4">{{ Str::limit($mainNews->content, 250, '...') }}</p>
                    <a href="{{ route('news.show', $mainNews->id) }}" class="btn btn-outline-primary">
                        Batafsil <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            <!-- Qo'shimcha yangiliklar -->
            <div class="row g-4">
                @foreach($additionalNews as $news)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm rounded-3 h-100">
                            <div class="row g-0">
                                @if($news->image_url)
                                    <div class="col-4">
                                        <img src="{{ asset('storage/' . $news->image_url) }}" 
                                             alt="{{ $news->title }}" 
                                             class="card-img-left rounded-3" 
                                             style="height: 180px; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="col-8">
                                    <div class="card-body d-flex flex-column">
                                        <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark fw-bold">
                                            {{ Str::limit($news->title, 50) }}
                                        </a>
                                        <p class="text-muted small mt-1">
                                            <i class="bi bi-clock"></i> {{ $news->created_at->format('H:i') }} &bullet; 
                                            <span class="text-primary">{{ $news->category->name }}</span>
                                        </p>
                                        <p class="text-muted mt-2 flex-grow-1">{{ Str::limit($news->content, 100, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- So'nggi yangiliklar -->
        <div class="col-lg-4">
            <h5 class="fw-bold mb-4">So'nggi yangiliklar</h5>
            <ul class="list-unstyled">
                @foreach($latestNews as $news)
                    <li class="mb-3">
                        <div class="d-flex align-items-center">
                            @if($news->image_url)
                                <div class="me-3">
                                    <img src="{{ asset('storage/' . $news->image_url) }}" 
                                         alt="{{ $news->title }}" 
                                         class="rounded-3" 
                                         style="width: 80px; height: 50px; object-fit: cover;">
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark">
                                    <h6 class="fw-bold">{{ Str::limit($news->title, 40) }}</h6>
                                    <p class="text-muted small mb-0">
                                        <span class="text-primary">{{ $news->category->name }}</span> 
                                        &bullet;  {{  $news->created_at->format('H:i') }}  
                                    </p>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
