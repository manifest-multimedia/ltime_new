<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InsightsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function guest_can_view_blog_posts()
    {
        $post = Post::factory()->create([
            'is_published' => true,
            'posted_at' => now(),
        ]);

        $response = $this->get(route('insights.index'));
        $response->assertStatus(200);
        $response->assertSee($post->translations->first()->title);
    }

    /** @test */
    public function guest_cannot_access_admin_area()
    {
        $response = $this->get(route('insights.admin.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_access_admin_area()
    {
        $response = $this->actingAs($this->user)
            ->get(route('insights.admin.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_post()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)
            ->post(route('insights.admin.store'), [
                'title' => 'Test Post',
                'slug' => 'test-post',
                'post_body' => 'Test content',
                'lang_id' => 1,
                'is_published' => true,
                'categories' => [$category->id],
                'image' => $image,
            ]);

        $response->assertRedirect(route('insights.admin.index'));
        $this->assertDatabaseHas('insights_posts', [
            'is_published' => true,
        ]);
        $this->assertDatabaseHas('insights_post_translations', [
            'title' => 'Test Post',
            'slug' => 'test-post',
        ]);

        Storage::disk('public')->assertExists(
            config('insights.blog_upload_dir') . '/image_medium/' . $image->hashName()
        );
    }

    /** @test */
    public function user_can_manage_categories()
    {
        $response = $this->actingAs($this->user)
            ->post(route('insights.admin.categories.store'), [
                'category_name' => 'Test Category',
                'slug' => 'test-category',
                'lang_id' => 1,
            ]);

        $response->assertRedirect(route('insights.admin.categories'));
        $this->assertDatabaseHas('insights_category_translations', [
            'category_name' => 'Test Category',
            'slug' => 'test-category',
        ]);
    }

    /** @test */
    public function guest_can_submit_comment()
    {
        $post = Post::factory()->create(['is_published' => true]);

        $response = $this->post(route('insights.comments.store', $post->translations->first()->slug), [
            'author_name' => 'John Doe',
            'author_email' => 'john@example.com',
            'comment' => 'Test comment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_comments', [
            'author_name' => 'John Doe',
            'comment' => 'Test comment',
        ]);
    }

    /** @test */
    public function search_returns_relevant_posts()
    {
        $post = Post::factory()->create([
            'is_published' => true,
            'posted_at' => now(),
        ]);
        $post->translations()->create([
            'title' => 'Searchable Post Title',
            'post_body' => 'Searchable content',
            'slug' => 'searchable-post',
            'lang_id' => 1,
        ]);

        $response = $this->get(route('insights.search', ['q' => 'Searchable']));
        $response->assertStatus(200);
        $response->assertSee('Searchable Post Title');
    }

    /** @test */
    public function user_can_manage_comments()
    {
        $comment = Comment::factory()->create(['approved' => false]);

        $response = $this->actingAs($this->user)
            ->patch(route('insights.admin.comments.approve', $comment->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_comments', [
            'id' => $comment->id,
            'approved' => true,
        ]);
    }
}