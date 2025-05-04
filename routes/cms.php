<?php

use App\Http\Controllers\Admin\CmsContentBlockAdminController;
use App\Http\Controllers\Admin\CmsPageAdminController;
use App\Http\Controllers\Admin\CmsSectionAdminController;
use App\Http\Controllers\CmsPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register CMS-specific routes for your application.
| These routes are loaded by the RouteServiceProvider with a 'cms' prefix.
|
*/

// Public-facing CMS routes
Route::get('/', [CmsPageController::class, 'home'])->name('home');
Route::get('/{slug}', [CmsPageController::class, 'show'])->name('page.show');

// Admin CMS routes - protected by authentication
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // CMS Pages management
    Route::resource('cms-pages', CmsPageAdminController::class);
    
    // CMS Sections management
    Route::resource('cms-pages.sections', CmsSectionAdminController::class)->shallow();
    
    // CMS Content Blocks management
    Route::resource('sections.content-blocks', CmsContentBlockAdminController::class)->shallow();
    
    // Additional routes for reordering sections/blocks
    Route::post('sections/reorder', [CmsSectionAdminController::class, 'reorder'])->name('sections.reorder');
    Route::post('content-blocks/reorder', [CmsContentBlockAdminController::class, 'reorder'])->name('content-blocks.reorder');
});