@extends('layouts.app')

@section('content')
<div class="container py-5">
<div class="text-end">
        <a href="{{ route('admin.create') }}" class="btn btn-success">Yangilik Qo'shish</a>
    </div>
    <h1 class="fw-bold text-primary mb-4">Yangiliklar Boshqaruvi</h1>

    <!-- Yangiliklar ro'yxati -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rasm</th>
                    <th>Sarlavha</th>
                    <th>Kategoriyalar</th>
                    <th>Yaratilgan</th>
                    <th>Amallar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->image_url)
                            <img src="{{ asset('storage/' . $item->image_url) }}" class="img-fluid" alt="{{ $item->title }}" style="height: 50px; object-fit: cover;">
                        @endif
                    </td>
                    <td>{{ Str::limit($item->title, 40) }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->created_at->format('d M, Y') }}</td>
                    <td>
                        <a href="{{route('admin.edit',$item->id)}} " class="btn btn-warning btn-sm">Tahrirlash</a>
                        <form action="{{ route('admin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Siz rostdan ham o‘chirmoqchimisiz?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">O'chirish</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Yangilik qo'shish tugmasi -->
    
</div>
@endsection
