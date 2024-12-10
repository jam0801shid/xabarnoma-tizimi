<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    // Admin yangiliklar ro'yxatini ko'rsatish
    public function index()
    {
        $news = News::with('category')->get();
        return view('admin.news.index', compact('news'));
    }

    // Yangilikni yaratish formasi
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    // Yangilikni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content' => 'required|string',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('news') : null;

        News::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image_url' => $imagePath,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Yangilik muvaffaqiyatli qo\'shildi.');
    }

    // Yangilikni tahrirlash formasi
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    // Yangilikni yangilash
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content' => 'required|string',
        ]);

        $news = News::findOrFail($id);
        $imagePath = $news->image_url;

        if ($request->hasFile('image')) {
            // Eski rasmani o'chirish
            if ($imagePath) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('news');
        }

        $news->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image_url' => $imagePath,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.index')->with('success', 'Yangilik muvaffaqiyatli yangilandi.');
    }

    // Yangilikni o'chirish
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        // Rasmni o'chirish
        if ($news->image_url) {
            Storage::delete($news->image_url);
        }

        $news->delete();

        return redirect()->route('admin.index')->with('success', 'Yangilik muvaffaqiyatli o\'chirildi.');
    }
}
