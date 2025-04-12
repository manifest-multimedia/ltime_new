<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class InsightsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/insights.php', 'insights'
        );
    }

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(base_path('routes/insights.php'));

        // Register migrations
        $this->loadMigrationsFrom([
            __DIR__.'/../../database/migrations'
        ]);

        // Register observers
        \App\Models\Insights\Post::observe(\App\Observers\Insights\PostObserver::class);
        \App\Models\Insights\Category::observe(\App\Observers\Insights\CategoryObserver::class);
        \App\Models\Insights\Comment::observe(\App\Observers\Insights\CommentObserver::class);

        // Register Blade components if needed
        // $this->loadViewComponentsAs('insights', [
        //     // Register any custom components here
        // ]);

        // Publish configuration
        $this->publishes([
            __DIR__.'/../../config/insights.php' => config_path('insights.php'),
        ], 'insights-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'insights-migrations');

        // Publish views
        $this->publishes([
            __DIR__.'/../../resources/views/insights' => resource_path('views/insights'),
        ], 'insights-views');

        // Set up any global middleware or other boot-time configurations
        Route::bind('post', function ($value) {
            return \App\Models\Insights\Post::findOrFail($value);
        });

        Route::bind('category', function ($value) {
            return \App\Models\Insights\Category::findOrFail($value);
        });

        Route::bind('comment', function ($value) {
            return \App\Models\Insights\Comment::findOrFail($value);
        });
    }
}