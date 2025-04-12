<?php

namespace App\Observers\Insights;

use App\Models\Insights\Comment;
use App\Services\InsightsLogService;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    protected $logService;

    public function __construct(InsightsLogService $logService)
    {
        $this->logService = $logService;
    }

    public function created(Comment $comment)
    {
        $this->logService->logCommentCreated($comment);
    }

    public function updated(Comment $comment)
    {
        if ($comment->isDirty('approved') && $comment->approved) {
            $this->logService->logCommentApproved($comment, Auth::user());
        }
    }

    public function deleted(Comment $comment)
    {
        $this->logService->logCommentDeleted($comment, Auth::user());
    }
}