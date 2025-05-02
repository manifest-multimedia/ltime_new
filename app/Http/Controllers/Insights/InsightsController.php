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
    
    public function storeComment(Request $request, $slug)
    {
        // Find the post by slug
        $post = Post::whereHas('translations', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();
        
        // Validate the request
        $validationRules = ['comment' => 'required|min:3'];
        
        // Add captcha validation if enabled
        if (config('insights.captcha.captcha_enabled')) {
            $validationRules['captcha'] = 'required';
        }
        
        // Add author validation for guests
        if (!auth()->check()) {
            $validationRules['author_name'] = 'required';
            
            if (config('insights.comments.ask_for_author_email')) {
                $validationRules['author_email'] = config('insights.comments.require_author_email') 
                    ? 'required|email' 
                    : 'nullable|email';
            }
            
            if (config('insights.comments.ask_for_author_website')) {
                $validationRules['author_website'] = 'nullable|url';
            }
        }
        
        $this->validate($request, $validationRules);
        
        // Verify captcha if enabled
        if (config('insights.captcha.captcha_enabled')) {
            $captchaClass = config('insights.captcha.captcha_type');
            $captcha = new $captchaClass();
            
            if (!$captcha->verify($request->captcha)) {
                return back()
                    ->withErrors(['captcha' => 'Incorrect captcha answer'])
                    ->withInput();
            }
        }
        
        // Create the comment
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->comment = $request->comment;
        
        // Auto-approve based on settings
        $comment->approved = config('insights.comments.auto_approve_comments');
        
        // Set author information
        if (auth()->check()) {
            $user = auth()->user();
            $comment->user_id = $user->id;
            $comment->author_name = $user->name;
            $comment->author_email = $user->email;
        } else {
            $comment->author_name = $request->author_name;
            $comment->author_email = $request->author_email ?? null;
            $comment->author_website = $request->author_website ?? null;
        }
        
        // Save IP address if configured
        if (config('insights.comments.save_ip_address')) {
            $comment->ip = $request->ip();
        }
        
        $comment->save();
        
        return redirect()->back()
            ->with('success', $comment->approved 
                ? 'Your comment has been added!' 
                : 'Your comment has been submitted and awaiting approval.');
    }

    /**
     * Serve blog post images from storage
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function serveImage($filename)
    {
        // Determine the image type by checking its size suffix
        $imageSizes = array_keys(config('insights.image_sizes', []));
        $imageType = 'image_large'; // Default to large if no size detected
        
        // Loop through the image sizes to detect thumbnails, medium images, etc.
        foreach ($imageSizes as $size) {
            if (strpos($filename, '-' . $size) !== false) {
                $imageType = $size;
                break;
            }
        }
        
        // The actual path in storage where the image is stored
        $path = storage_path('app/public/' . config('insights.blog_upload_dir') . '/' . $imageType . '/' . $filename);
        
        // Make sure the file exists
        if (!file_exists($path)) {
            abort(404);
        }
        
        // Return the image with appropriate headers
        return response()->file($path);
    }
}