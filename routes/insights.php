<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Insights\InsightsController;
use App\Http\Controllers\Insights\InsightsAdminController;

// Public routes
Route::middleware(['web'])->group(function () {
    Route::prefix(config('insights.blog_prefix', 'insights'))->group(function () {
        Route::get('/', [InsightsController::class, 'index'])->name('insights.index');
        Route::get('/search', [InsightsController::class, 'search'])->name('insights.search');
        Route::get('/category/{slug}', [InsightsController::class, 'category'])->name('insights.category');
        Route::get('/{slug}', [InsightsController::class, 'show'])->name('insights.show');

        // Comments
        Route::post('/{slug}/comments', [InsightsController::class, 'storeComment'])
            ->middleware(['throttle:60,1'])
            ->name('insights.comments.store');
    });
});

// Admin routes
Route::middleware(['web', 'auth', 'insights.admin'])->group(function () {
    Route::prefix(config('insights.admin_prefix', 'manage-insights'))->group(function () {
        // Posts management
        Route::get('/', [InsightsAdminController::class, 'index'])->name('insights.admin.index');
        Route::get('/create', [InsightsAdminController::class, 'create'])->name('insights.admin.create');
        Route::post('/', [InsightsAdminController::class, 'store'])->name('insights.admin.store');
        Route::get('/{post}/edit', [InsightsAdminController::class, 'edit'])->name('insights.admin.edit');
        Route::put('/{post}', [InsightsAdminController::class, 'update'])->name('insights.admin.update');
        Route::delete('/{post}', [InsightsAdminController::class, 'destroy'])->name('insights.admin.destroy');

        // Categories management
        Route::prefix('categories')->group(function () {
            Route::get('/', [InsightsAdminController::class, 'categories'])->name('insights.admin.categories');
            Route::get('/create', [InsightsAdminController::class, 'createCategory'])->name('insights.admin.categories.create');
            Route::post('/', [InsightsAdminController::class, 'storeCategory'])->name('insights.admin.categories.store');
            Route::get('/{category}/edit', [InsightsAdminController::class, 'editCategory'])->name('insights.admin.categories.edit');
            Route::put('/{category}', [InsightsAdminController::class, 'updateCategory'])->name('insights.admin.categories.update');
            Route::delete('/{category}', [InsightsAdminController::class, 'destroyCategory'])->name('insights.admin.categories.destroy');
        });

        // Comments management
        Route::prefix('comments')->group(function () {
            Route::get('/', [InsightsAdminController::class, 'comments'])->name('insights.admin.comments');
            Route::patch('/{comment}/approve', [InsightsAdminController::class, 'approveComment'])->name('insights.admin.comments.approve');
            Route::delete('/{comment}', [InsightsAdminController::class, 'deleteComment'])->name('insights.admin.comments.destroy');
        });
    });
});

