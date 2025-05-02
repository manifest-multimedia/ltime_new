<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;

class InsightsLogService
{
    const CHANNEL = 'insights';

    public function logPostCreated(Post $post, User $user)
    {
        $title = $post->translations->first() ? $post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Post created: {$title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostUpdated(Post $post, User $user)
    {
        $title = $post->translations->first() ? $post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Post updated: {$title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostDeleted(Post $post, User $user)
    {
        $title = $post->translations && $post->translations->first() ? $post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Post deleted: {$title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostPublished(Post $post, User $user)
    {
        $title = $post->translations->first() ? $post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Post published: {$title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCommentCreated(Comment $comment)
    {
        $title = $comment->post && $comment->post->translations->first() ? $comment->post->translations->first()->title : 'Untitled Post';
        $this->log('info', "New comment on post: {$title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'author_name' => $comment->author_name,
            'user_id' => $comment->user_id,
        ]);
    }

    public function logCommentApproved(Comment $comment, User $moderator)
    {
        $title = $comment->post && $comment->post->translations->first() ? $comment->post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Comment approved on post: {$title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'moderator_id' => $moderator->id,
            'moderator_name' => $moderator->name,
        ]);
    }

    public function logCommentDeleted(Comment $comment, User $moderator)
    {
        $title = $comment->post && $comment->post->translations->first() ? $comment->post->translations->first()->title : 'Untitled Post';
        $this->log('info', "Comment deleted from post: {$title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'moderator_id' => $moderator->id,
            'moderator_name' => $moderator->name,
        ]);
    }

    public function logCategoryCreated(Category $category, User $user)
    {
        $categoryName = $category->translations->first() ? $category->translations->first()->category_name : 'Unnamed Category';
        $this->log('info', "Category created: {$categoryName}", [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCategoryUpdated(Category $category, User $user)
    {
        $categoryName = $category->translations->first() ? $category->translations->first()->category_name : 'Unnamed Category';
        $this->log('info', "Category updated: {$categoryName}", [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCategoryDeleted(Category $category, User $user)
    {
        $categoryName = $category->translations->first() ? $category->translations->first()->category_name : 'Unnamed Category';
        $this->log('info', "Category deleted: {$categoryName}", [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logDataMigrationStarted()
    {
        $this->log('info', "Starting Insights data migration from Binshops blog");
    }

    public function logDataMigrationCompleted($stats)
    {
        $this->log('info', "Insights data migration completed", $stats);
    }

    public function logError($message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    protected function log($level, $message, array $context = [])
    {
        $context['timestamp'] = now()->toDateTimeString();
        Log::channel(self::CHANNEL)->$level($message, $context);
    }
}