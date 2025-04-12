<?php

namespace App\Services;

use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\Insights\UploadedPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InsightsDataMigrationService
{
    public function migrateAll()
    {
        DB::beginTransaction();

        try {
            $this->migrateCategories();
            $this->migratePosts();
            $this->migrateComments();
            $this->migrateUploadedPhotos();
            $this->migrateImages();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to migrate Binshops data: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function migrateCategories()
    {
        $categories = DB::table('binshops_categories')->get();
        
        foreach ($categories as $category) {
            $newCategory = Category::create([
                'id' => $category->id,
                'created_by' => $category->created_by,
                'parent_id' => $category->parent_id,
                'lft' => $category->lft,
                'rgt' => $category->rgt,
                'depth' => $category->depth,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ]);

            // Migrate category translations
            $translations = DB::table('binshops_category_translations')
                ->where('category_id', $category->id)
                ->get();

            foreach ($translations as $translation) {
                $newCategory->translations()->create([
                    'category_name' => $translation->category_name,
                    'slug' => $translation->slug,
                    'category_description' => $translation->category_description,
                    'lang_id' => $translation->lang_id,
                    'created_at' => $translation->created_at,
                    'updated_at' => $translation->updated_at,
                ]);
            }
        }
    }

    protected function migratePosts()
    {
        $posts = DB::table('binshops_posts')->get();
        
        foreach ($posts as $post) {
            $newPost = Post::create([
                'id' => $post->id,
                'user_id' => $post->user_id,
                'posted_at' => $post->posted_at,
                'is_published' => $post->is_published,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ]);

            // Migrate post translations
            $translations = DB::table('binshops_post_translations')
                ->where('post_id', $post->id)
                ->get();

            foreach ($translations as $translation) {
                $newPost->translations()->create([
                    'slug' => $translation->slug,
                    'title' => $translation->title,
                    'subtitle' => $translation->subtitle,
                    'meta_desc' => $translation->meta_desc,
                    'seo_title' => $translation->seo_title,
                    'post_body' => $translation->post_body,
                    'short_description' => $translation->short_description,
                    'use_view_file' => $translation->use_view_file,
                    'image_large' => $translation->image_large,
                    'image_medium' => $translation->image_medium,
                    'image_thumbnail' => $translation->image_thumbnail,
                    'lang_id' => $translation->lang_id,
                    'created_at' => $translation->created_at,
                    'updated_at' => $translation->updated_at,
                ]);
            }

            // Migrate post categories
            $categories = DB::table('binshops_post_categories')
                ->where('post_id', $post->id)
                ->pluck('category_id');

            $newPost->categories()->sync($categories);
        }
    }

    protected function migrateComments()
    {
        $comments = DB::table('binshops_comments')->get();
        
        foreach ($comments as $comment) {
            Comment::create([
                'id' => $comment->id,
                'post_id' => $comment->post_id,
                'user_id' => $comment->user_id,
                'ip' => $comment->ip,
                'author_name' => $comment->author_name,
                'comment' => $comment->comment,
                'approved' => $comment->approved,
                'author_email' => $comment->author_email,
                'author_website' => $comment->author_website,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
            ]);
        }
    }

    protected function migrateUploadedPhotos()
    {
        $photos = DB::table('binshops_uploaded_photos')->get();
        
        foreach ($photos as $photo) {
            UploadedPhoto::create([
                'id' => $photo->id,
                'uploaded_images' => $photo->uploaded_images,
                'image_title' => $photo->image_title,
                'source' => $photo->source,
                'uploader_id' => $photo->uploader_id,
                'created_at' => $photo->created_at,
                'updated_at' => $photo->updated_at,
            ]);
        }
    }

    protected function migrateImages()
    {
        $binshopsPath = Storage::disk('public')->path('blog_images');
        $insightsPath = Storage::disk('public')->path(config('insights.blog_upload_dir'));

        if (!file_exists($insightsPath)) {
            mkdir($insightsPath, 0755, true);
        }

        // Copy all image sizes
        foreach (['image_large', 'image_medium', 'image_thumbnail'] as $size) {
            $sourcePath = $binshopsPath . '/' . $size;
            $destPath = $insightsPath . '/' . $size;

            if (file_exists($sourcePath)) {
                if (!file_exists($destPath)) {
                    mkdir($destPath, 0755, true);
                }

                $files = glob($sourcePath . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        copy($file, $destPath . '/' . basename($file));
                    }
                }
            }
        }
    }
}