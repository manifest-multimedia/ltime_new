<?php

namespace App\Observers\Insights;

use App\Models\Insights\Post;
use App\Services\InsightsLogService;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    protected $logService;

    public function __construct(InsightsLogService $logService)
    {
        $this->logService = $logService;
    }

    public function created(Post $post)
    {
        $this->logService->logPostCreated($post, Auth::user());
    }

    public function updated(Post $post)
    {
        if ($post->isDirty('is_published') && $post->is_published) {
            $this->logService->logPostPublished($post, Auth::user());
        } else {
            $this->logService->logPostUpdated($post, Auth::user());
        }
    }

    public function deleted(Post $post)
    {
        $this->logService->logPostDeleted($post, Auth::user());
    }
}