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
        $post = new Post(); // Create an empty post instance to prevent undefined variable errors
        return view('insights.admin.create', compact('categories', 'post'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'post_body' => 'required',
                'slug' => 'required|unique:insights_post_translations,slug',
                'lang_id' => 'required|exists:insights_languages,id',
                'categories' => 'array',
                'posted_at' => 'nullable|date',
                'image' => 'nullable|image',
            ]);

            // Create the post first
            $post = Post::create([
                'user_id' => Auth::id(),
                'posted_at' => $request->posted_at ?? now(),
                'is_published' => $request->has('is_published'),
            ]);

            \Log::info("Post created with ID: {$post->id}", [
                'title' => $request->title,
                'is_published' => $post->is_published,
            ]);

            // Create the translation immediately before image handling
            $translation = $post->translations()->create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'short_description' => $request->short_description,
                'post_body' => $request->post_body,
                'slug' => Str::slug($request->slug),
                'meta_desc' => $request->meta_desc,
                'seo_title' => $request->seo_title,
                'lang_id' => $request->lang_id,
            ]);

            // Make sure to load the translation relation
            $post->load('translations');

            // Now handle image upload after translation is created
            if ($request->hasFile('image')) {
                $this->handleImageUpload($request->file('image'), $post);
            }

            if ($request->categories) {
                $post->categories()->sync($request->categories);
            }

            return redirect()->route('insights.admin.index')
                ->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            \Log::error("Error creating post: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->except(['_token']),
            ]);
            
            return redirect()->back()
                ->with('error', 'Error creating post: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            // Explicitly find the post by ID
            $post = Post::find($id);
            
            // If no post found, throw an exception
            if (!$post) {
                \Log::error("Post not found with ID: {$id}");
                throw new \Exception("Post not found with ID: {$id}");
            }
            
            // Eager load translations and categories to avoid N+1 queries
            $post->load(['translations', 'categories']);
            
            $categories = Category::with('translations')->get();
            
            // Make sure translations is initialized as a collection, even if it's empty
            if (!$post->relationLoaded('translations') || !($post->translations instanceof \Illuminate\Support\Collection)) {
                $post->setRelation('translations', collect([]));
            }
            
            // If the post has no translations, create a properly initialized dummy translation object for the form
            if ($post->translations->isEmpty()) {
                $defaultLang = \App\Models\Insights\Language::getDefault();
                $tempTranslation = new PostTranslation();
                
                // Initialize all required fields with empty values to prevent null errors
                $tempTranslation->post_id = $post->id;
                $tempTranslation->title = '';
                $tempTranslation->slug = '';
                $tempTranslation->post_body = '';
                $tempTranslation->short_description = '';
                $tempTranslation->subtitle = '';
                $tempTranslation->meta_desc = '';
                $tempTranslation->seo_title = '';
                $tempTranslation->lang_id = $defaultLang ? $defaultLang->id : 1; // Default to 1 if no default found
                
                $post->setRelation('translations', collect([$tempTranslation]));
            }
            
            return view('insights.admin.edit', compact('post', 'categories'));
        } catch (\Exception $e) {
            \Log::error("Error editing post: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('insights.admin.index')
                ->with('error', 'Error editing post: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Get the post with translations eager loaded
            $post = Post::with('translations')->find($id);
            
            // If no post found, throw an exception
            if (!$post) {
                \Log::error("Post not found with ID: {$id}");
                throw new \Exception("Post not found with ID: {$id}");
            }
            
            // Find the current translation for the requested language if it exists
            $currentTranslation = $post->translations->where('lang_id', $request->lang_id)->first();
            $translationId = $currentTranslation ? $currentTranslation->id : null;
            
            $this->validate($request, [
                'title' => 'required',
                'post_body' => 'required',
                'slug' => 'required|unique:insights_post_translations,slug,' . $translationId,
                'lang_id' => 'required|exists:insights_languages,id',
                'categories' => 'array',
                'posted_at' => 'nullable|date',
                'image' => 'nullable|image',
            ]);

            \Log::info("Updating post with ID: {$id}", [
                'title' => $request->title,
                'slug' => $request->slug
            ]);

            $post->update([
                'posted_at' => $request->posted_at ?? now(),
                'is_published' => $request->has('is_published'),
            ]);

            // Update or create the translation
            $translation = $post->translations()->updateOrCreate(
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

            // Reload the translations relation after update
            $post->load('translations');

            // Handle image upload after ensuring translations exist
            if ($request->hasFile('image')) {
                $this->handleImageUpload($request->file('image'), $post);
            }

            if ($request->has('categories')) {
                $post->categories()->sync($request->categories);
            } else {
                $post->categories()->detach();
            }

            \Log::info("Post updated successfully: {$id}");

            return redirect()->route('insights.admin.index')
                ->with('success', 'Post updated successfully');
                
        } catch (\Exception $e) {
            \Log::error("Error updating post: " . $e->getMessage(), [
                'post_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error updating post: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($post_id)
    {
        try {
            // Make sure we have a valid numeric ID
            if (!is_numeric($post_id)) {
                \Log::error("Invalid post ID format for deletion: {$post_id}");
                return redirect()->route('insights.admin.index')
                    ->with('error', 'Invalid post ID format');
            }
            
            // Find the post using the numeric ID
            $post = Post::with('translations')->find($post_id);
            
            if (!$post) {
                \Log::error("Post not found for deletion with ID: {$post_id}");
                return redirect()->route('insights.admin.index')
                    ->with('error', 'Post not found with ID: ' . $post_id);
            }
            
            \Log::info("Deleting post with ID: {$post_id}", [
                'post_id' => $post->id,
                'translation_count' => $post->translations->count()
            ]);
            
            // Use a database transaction to ensure all related data is properly deleted
            \DB::beginTransaction();
            
            try {
                // Remove category associations
                $post->categories()->detach();
                
                // Delete any comments
                $post->comments()->delete();
                
                // Delete translations - they should automatically be deleted by the foreign key constraint
                // but we'll ensure they're gone
                $post->translations()->delete();
                
                // Finally delete the post itself
                $post->delete();
                
                \DB::commit();
                
                \Log::info("Post deleted successfully: {$post_id}");
                
                return redirect()->route('insights.admin.index')
                    ->with('success', 'Post deleted successfully');
            } catch (\Exception $innerException) {
                \DB::rollBack();
                throw $innerException;
            }
        } catch (\Exception $e) {
            \Log::error("Error deleting post: " . $e->getMessage(), [
                'post_id' => $post_id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('insights.admin.index')
                ->with('error', 'Error deleting post: ' . $e->getMessage());
        }
    }

    protected function handleImageUpload($image, Post $post)
    {
        // Always load the translations first to ensure they're available
        $post = $post->fresh(['translations']);
        
        // Check if post has translations, if not, this could be an issue
        if ($post->translations->isEmpty()) {
            \Log::error("Cannot upload image: post has no translations", ['post_id' => $post->id]);
            throw new \Exception("Post must have at least one translation before uploading an image.");
        }
        
        // Use the loaded translations collection
        $currentTranslation = $post->translations->sortByDesc('updated_at')->first();
        if (!$currentTranslation) {
            \Log::error("Cannot determine current translation for image upload", ['post_id' => $post->id]);
            throw new \Exception("Cannot determine which translation to update with the image.");
        }
        
        $filename = Str::slug($currentTranslation->title) . '-' . time() . '.' . $image->getClientOriginalExtension();
        
        \Log::info("Uploading image for post", [
            'post_id' => $post->id,
            'translation_id' => $currentTranslation->id,
            'filename' => $filename
        ]);
        
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
            
            // Update only the current translation with the new image
            $currentTranslation->update([
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
        $categories = Category::with('translations')->get();
        $category = new Category(); // Create empty category instance to avoid variable undefined error
        return view('insights.admin.categories.create', compact('categories', 'category'));
    }

    public function storeCategory(Request $request)
    {
        try {
            $this->validate($request, [
                'category_name' => 'required',
                'slug' => 'required|unique:insights_category_translations,slug',
                'lang_id' => 'required|exists:insights_languages,id',
            ]);

            // First create the category
            $category = Category::create([
                'created_by' => Auth::id(),
                'parent_id' => $request->parent_id ?: null,
            ]);

            // Then explicitly create the translation with all required fields
            $translation = CategoryTranslation::create([
                'category_id' => $category->id,
                'category_name' => $request->category_name,
                'slug' => Str::slug($request->slug),
                'category_description' => $request->category_description,
                'lang_id' => $request->lang_id,
            ]);

            // Ensure the category has the translation loaded
            $category->setRelation('translations', collect([$translation]));

            // Log the category creation safely
            $logService = app(\App\Services\InsightsLogService::class);
            try {
                $logService->logCategoryCreated($category, Auth::user());
            } catch (\Exception $logException) {
                \Log::error("Error logging category creation: " . $logException->getMessage());
                // Continue execution even if logging fails
            }

            return redirect()->route('insights.admin.categories')
                ->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            \Log::error("Error creating category: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()
                ->with('error', 'Error creating category: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editCategory($id)
    {
        try {
            // Explicitly find the category by ID using a simple query
            $category = Category::find($id);
            
            // If no category found, throw an exception
            if (!$category) {
                throw new \Exception("Category not found with ID: {$id}");
            }
            
            // Eager load translations to avoid N+1 queries
            $category->load('translations');
            
            $categories = Category::with('translations')
                ->where('id', '!=', $id)
                ->get();
            
            // If the category has no translations, create a dummy translation object for the form
            if ($category->translations->isEmpty()) {
                $defaultLang = \App\Models\Insights\Language::getDefault();
                $tempTranslation = new CategoryTranslation();
                $tempTranslation->category_id = $category->id;
                $tempTranslation->lang_id = $defaultLang ? $defaultLang->id : 1; // Default to 1 if no default found
                $category->setRelation('translations', collect([$tempTranslation]));
            }
            
            return view('insights.admin.categories.edit', compact('category', 'categories'));
        } catch (\Exception $e) {
            \Log::error("Error editing category: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('insights.admin.categories')
                ->with('error', 'Error editing category: ' . $e->getMessage());
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            \Log::info("Attempting to update category with ID: " . $id, $request->except('_token', '_method'));
            
            // Explicitly find the category by ID
            $category = Category::find($id);
            
            // If no category found, throw an exception
            if (!$category) {
                throw new \Exception("Category not found with ID: {$id}");
            }
            
            \Log::info("Category found for update: ", ['id' => $category->id]);
            
            $this->validate($request, [
                'category_name' => 'required',
                'slug' => 'required',
                'lang_id' => 'required|exists:insights_languages,id',
            ]);
            
            // Check for slug uniqueness with a custom query to avoid errors when there are no translations
            $existingTranslation = CategoryTranslation::where('slug', Str::slug($request->slug))
                ->where('category_id', '!=', $category->id)
                ->first();
                
            if ($existingTranslation) {
                \Log::info("Slug already exists: " . $request->slug);
                return back()->withErrors(['slug' => 'The slug has already been taken.'])->withInput();
            }
            
            // Update or create the translation
            $translation = CategoryTranslation::updateOrCreate(
                [
                    'category_id' => $category->id,
                    'lang_id' => $request->lang_id
                ],
                [
                    'category_name' => $request->category_name,
                    'slug' => Str::slug($request->slug),
                    'category_description' => $request->category_description,
                ]
            );
            
            \Log::info("Category translation updated/created", [
                'translation_id' => $translation->id,
                'category_name' => $translation->category_name
            ]);

            // Update parent category if provided
            $category->update([
                'parent_id' => $request->parent_id ?: null
            ]);

            return redirect()->route('insights.admin.categories')
                ->with('success', 'Category updated successfully');
                
        } catch (\Exception $e) {
            \Log::error("Error updating category: " . $e->getMessage(), [
                'category_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('insights.admin.categories')
                ->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    public function destroyCategory($id)
    {
        try {
            \Log::info("Attempting to delete category with ID: " . $id);
            
            // Explicitly find the category by ID
            $category = Category::find($id);
            
            // If no category found, throw an exception
            if (!$category) {
                throw new \Exception("Category not found with ID: {$id}");
            }
            
            \Log::info("Category found for deletion: ", ['id' => $category->id]);
            
            // Check if category has posts
            $postsCount = $category->posts->count();
            if ($postsCount > 0) {
                \Log::info("Category has {$postsCount} posts, but proceeding with deletion");
            }
            
            // Delete the category and its translations (should cascade)
            $category->delete();
            \Log::info("Category deleted successfully", ['id' => $id]);

            return redirect()->route('insights.admin.categories')
                ->with('success', 'Category deleted successfully');
                
        } catch (\Exception $e) {
            \Log::error("Error deleting category: " . $e->getMessage(), [
                'category_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('insights.admin.categories')
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }

    // Comment management methods
    public function comments()
    {
        $comments = Comment::with(['post.translations', 'user'])->paginate(10);
        return view('insights.admin.comments.index', compact('comments'));
    }

    public function approveComment(Comment $comment)
    {
        $comment->update(['approved' => true]);

        return redirect()->back()->with('success', 'Comment approved successfully');
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}