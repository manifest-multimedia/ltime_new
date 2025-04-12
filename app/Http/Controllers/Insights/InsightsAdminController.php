<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\PostTranslation;
use App\Models\Insights\CategoryTranslation;
use App\Models\Insights\Comment;
use App\Models\Insights\UploadedPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InsightsAdminController extends Controller
{
    public function index()
    {
        $posts = Post::with(['translations', 'categories.translations'])
            ->orderBy('posted_at', 'desc')
            ->paginate(10);

        return view('insights.admin.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::with('translations')->get();
        return view('insights.admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'post_body' => 'required',
            'slug' => 'required|unique:insights_post_translations,slug',
            'lang_id' => 'required|exists:insights_languages,id',
            'categories' => 'array',
            'posted_at' => 'nullable|date',
            'image' => 'nullable|image',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'posted_at' => $request->posted_at ?? now(),
            'is_published' => $request->is_published ?? false,
        ]);

        if ($request->hasFile('image')) {
            $this->handleImageUpload($request->file('image'), $post);
        }

        $post->translations()->create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'short_description' => $request->short_description,
            'post_body' => $request->post_body,
            'slug' => Str::slug($request->slug),
            'meta_desc' => $request->meta_desc,
            'seo_title' => $request->seo_title,
            'lang_id' => $request->lang_id,
        ]);

        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('insights.admin.index')
            ->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::with(['translations', 'categories'])->findOrFail($id);
        $categories = Category::with('translations')->get();
        return view('insights.admin.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $this->validate($request, [
            'title' => 'required',
            'post_body' => 'required',
            'slug' => 'required|unique:insights_post_translations,slug,' . $post->id . ',post_id',
            'lang_id' => 'required|exists:insights_languages,id',
            'categories' => 'array',
            'posted_at' => 'nullable|date',
            'image' => 'nullable|image',
        ]);

        $post->update([
            'posted_at' => $request->posted_at ?? now(),
            'is_published' => $request->is_published ?? false,
        ]);

        if ($request->hasFile('image')) {
            $this->handleImageUpload($request->file('image'), $post);
        }

        $post->translations()->updateOrCreate(
            ['lang_id' => $request->lang_id],
            [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'short_description' => $request->short_description,
                'post_body' => $request->post_body,
                'slug' => Str::slug($request->slug),
                'meta_desc' => $request->meta_desc,
                'seo_title' => $request->seo_title,
            ]
        );

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('insights.admin.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('insights.admin.index')
            ->with('success', 'Post deleted successfully');
    }

    protected function handleImageUpload($image, Post $post)
    {
        $filename = Str::slug($post->translations->first()->title) . '-' . time() . '.' . $image->getClientOriginalExtension();
        
        foreach (config('insights.image_sizes') as $size => $data) {
            if (!$data['enabled']) continue;

            $resizedImage = Image::make($image);
            
            if ($data['crop']) {
                $resizedImage->fit($data['w'], $data['h']);
            } else {
                $resizedImage->resize($data['w'], $data['h'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $path = Storage::disk('public')->path(config('insights.blog_upload_dir') . '/' . $size);
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $resizedImage->save($path . '/' . $filename);
            
            $post->translations()->update([
                $size => $filename
            ]);
        }
    }

    // Category management methods
    public function categories()
    {
        $categories = Category::with('translations')->paginate(10);
        return view('insights.admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('insights.admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'slug' => 'required|unique:insights_category_translations,slug',
            'lang_id' => 'required|exists:insights_languages,id',
        ]);

        $category = Category::create([
            'created_by' => Auth::id(),
        ]);

        $category->translations()->create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->slug),
            'category_description' => $request->category_description,
            'lang_id' => $request->lang_id,
        ]);

        return redirect()->route('insights.admin.categories')
            ->with('success', 'Category created successfully');
    }

    // Comment management methods
    public function comments()
    {
        $comments = Comment::with(['post.translations', 'user'])->paginate(10);
        return view('insights.admin.comments.index', compact('comments'));
    }

    public function approveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['approved' => true]);

        return redirect()->back()->with('success', 'Comment approved successfully');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}