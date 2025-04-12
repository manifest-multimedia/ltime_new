<?php

namespace App\Console\Commands;

use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateInsightsSampleContent extends Command
{
    protected $signature = 'insights:generate-sample-content {--posts=10} {--categories=5} {--comments=50}';
    protected $description = 'Generate sample content for the Insights blog system';

    public function handle()
    {
        $this->info('Generating sample content for Insights blog...');

        // Create admin user if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Generate categories
        $this->info('Generating categories...');
        $categoryCount = $this->option('categories');
        $categories = Category::factory()->count($categoryCount)->create([
            'created_by' => $admin->id,
        ]);
        $this->info("{$categoryCount} categories created.");

        // Generate posts
        $this->info('Generating posts...');
        $postCount = $this->option('posts');
        $posts = Post::factory()->count($postCount)
            ->create(['user_id' => $admin->id])
            ->each(function ($post) use ($categories) {
                // Attach 1-3 random categories to each post
                $post->categories()->attach(
                    $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->toArray()
                );
            });
        $this->info("{$postCount} posts created.");

        // Generate comments
        $this->info('Generating comments...');
        $commentCount = $this->option('comments');
        $comments = Comment::factory()->count($commentCount)
            ->create([
                'post_id' => fn() => $posts->random()->id,
            ]);
        $this->info("{$commentCount} comments created.");

        $this->info('Sample content generation completed successfully!');
        return 0;
    }
}