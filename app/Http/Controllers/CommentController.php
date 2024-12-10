<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $news_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        

        Comment::create([
            'content' =>$request->input('content'),
            'user_id' => auth()->id(),
            'news_id' => $news_id,
        ]);

        return redirect()->route('news.show', $news_id);
    }
}
