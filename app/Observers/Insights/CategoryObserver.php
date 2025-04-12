<?php

namespace App\Observers\Insights;

use App\Models\Insights\Category;
use App\Services\InsightsLogService;
use Illuminate\Support\Facades\Auth;

class CategoryObserver
{
    protected $logService;

    public function __construct(InsightsLogService $logService)
    {
        $this->logService = $logService;
    }

    public function created(Category $category)
    {
        $this->logService->logCategoryCreated($category, Auth::user());
    }

    public function updated(Category $category)
    {
        $this->logService->logCategoryUpdated($category, Auth::user());
    }

    public function deleted(Category $category)
    {
        $this->logService->logCategoryDeleted($category, Auth::user());
    }
}