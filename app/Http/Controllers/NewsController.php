<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    // app/Http/Controllers/NewsController.php

public function index(Request $request)
{
    


    $mainNews = News::whereHas('category', function ($query) {
        $query->where('name', 'mainNews');
    })->latest()->first();
    
    $additionalNews = News::whereHas('category', function ($query) {
        $query->whereNotIn('name', ['mainNews', 'Brief_news']);
    })->latest()->take(5)->get();
    
    $latestNews = News::whereHas('category', function ($query) {
        $query->where('name', 'Brief_news');
    })->latest()->take(5)->get();
    



    return view('news.index', compact('mainNews', 'additionalNews', 'latestNews'));
}


    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('images', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image_url' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.index')->with('success', 'Yangilik muvaffaqiyatli qo\'shildi');
    }

    public function show($id)
    {
        $news = News::with('comments')->findOrFail($id);
        $news->increment('views');
        return view('news.show', compact('news'));
    }

    public function categoryNews(Category $category){
        $news = $category->news()->latest()->paginate(10);

        return view('news.category', compact('category', 'news'));
    }
}
