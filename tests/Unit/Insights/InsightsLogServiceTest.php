<?php

namespace Tests\Unit\Insights;

use Tests\TestCase;
use App\Services\InsightsLogService;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class InsightsLogServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $logService;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logService = new InsightsLogService();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_logs_post_creation()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Post created:') &&
                    isset($context['post_id']) &&
                    isset($context['user_id']) &&
                    isset($context['user_name']);
            });

        $post = Post::factory()->create();
        $this->logService->logPostCreated($post, $this->user);
    }

    /** @test */
    public function it_logs_post_updates()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Post updated:') &&
                    isset($context['post_id']) &&
                    isset($context['user_id']) &&
                    isset($context['user_name']);
            });

        $post = Post::factory()->create();
        $this->logService->logPostUpdated($post, $this->user);
    }

    /** @test */
    public function it_logs_post_deletion()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Post deleted:') &&
                    isset($context['post_id']) &&
                    isset($context['user_id']) &&
                    isset($context['user_name']);
            });

        $post = Post::factory()->create();
        $this->logService->logPostDeleted($post, $this->user);
    }

    /** @test */
    public function it_logs_comment_creation()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'New comment on post:') &&
                    isset($context['comment_id']) &&
                    isset($context['post_id']) &&
                    isset($context['author_name']);
            });

        $comment = Comment::factory()->create();
        $this->logService->logCommentCreated($comment);
    }

    /** @test */
    public function it_logs_comment_approval()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Comment approved on post:') &&
                    isset($context['comment_id']) &&
                    isset($context['post_id']) &&
                    isset($context['moderator_id']) &&
                    isset($context['moderator_name']);
            });

        $comment = Comment::factory()->create();
        $this->logService->logCommentApproved($comment, $this->user);
    }

    /** @test */
    public function it_logs_category_creation()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Category created:') &&
                    isset($context['category_id']) &&
                    isset($context['user_id']) &&
                    isset($context['user_name']);
            });

        $category = Category::factory()->create();
        $this->logService->logCategoryCreated($category, $this->user);
    }

    /** @test */
    public function it_logs_data_migration_process()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->twice()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->twice();

        $this->logService->logDataMigrationStarted();
        $this->logService->logDataMigrationCompleted([
            'posts' => 10,
            'categories' => 5,
            'comments' => 20,
        ]);
    }

    /** @test */
    public function it_logs_errors()
    {
        Log::shouldReceive('channel')
            ->with('insights')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('error')
            ->once()
            ->withArgs(function ($message, $context) {
                return $message === 'Test error message' &&
                    isset($context['timestamp']);
            });

        $this->logService->logError('Test error message');
    }
}