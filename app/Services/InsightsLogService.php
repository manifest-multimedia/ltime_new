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
        $this->log('info', "Post created: {$post->translations->first()->title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostUpdated(Post $post, User $user)
    {
        $this->log('info', "Post updated: {$post->translations->first()->title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostDeleted(Post $post, User $user)
    {
        $this->log('info', "Post deleted: {$post->translations->first()->title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logPostPublished(Post $post, User $user)
    {
        $this->log('info', "Post published: {$post->translations->first()->title}", [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCommentCreated(Comment $comment)
    {
        $this->log('info', "New comment on post: {$comment->post->translations->first()->title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'author_name' => $comment->author_name,
            'user_id' => $comment->user_id,
        ]);
    }

    public function logCommentApproved(Comment $comment, User $moderator)
    {
        $this->log('info', "Comment approved on post: {$comment->post->translations->first()->title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'moderator_id' => $moderator->id,
            'moderator_name' => $moderator->name,
        ]);
    }

    public function logCommentDeleted(Comment $comment, User $moderator)
    {
        $this->log('info', "Comment deleted from post: {$comment->post->translations->first()->title}", [
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'moderator_id' => $moderator->id,
            'moderator_name' => $moderator->name,
        ]);
    }

    public function logCategoryCreated(Category $category, User $user)
    {
        $this->log('info', "Category created: {$category->translations->first()->category_name}", [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCategoryUpdated(Category $category, User $user)
    {
        $this->log('info', "Category updated: {$category->translations->first()->category_name}", [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    public function logCategoryDeleted(Category $category, User $user)
    {
        $this->log('info', "Category deleted: {$category->translations->first()->category_name}", [
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