<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InsightsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['translations', 'categories.translations'])
            ->where('is_published', true)
            ->where('posted_at', '<=', now())
            ->orderBy('posted_at', 'desc')
            ->paginate(config('insights.per_page'));

        return view('insights.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::whereHas('translations', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['translations', 'categories.translations', 'comments' => function($query) {
            $query->where('approved', true);
        }])->firstOrFail();

        return view('insights.show', compact('post'));
    }

    public function category($categorySlug)
    {
        $category = Category::whereHas('translations', function($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->with('translations')->firstOrFail();

        $posts = Post::whereHas('categories', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->with(['translations', 'categories.translations'])
        ->where('is_published', true)
        ->where('posted_at', '<=', now())
        ->orderBy('posted_at', 'desc')
        ->paginate(config('insights.per_page'));

        return view('insights.category', compact('category', 'posts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $posts = Post::whereHas('translations', function($q) use ($query) {
            $q->where('title', 'like', "%$query%")
              ->orWhere('post_body', 'like', "%$query%")
              ->orWhere('short_description', 'like', "%$query%");
        })->with(['translations', 'categories.translations'])
        ->where('is_published', true)
        ->where('posted_at', '<=', now())
        ->orderBy('posted_at', 'desc')
        ->paginate(config('insights.per_page'));

        return view('insights.search', compact('posts', 'query'));
    }
}