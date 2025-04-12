<?php

namespace Tests\Feature\Insights;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminInsightsTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create();
        // Note: Update this when implementing proper roles/permissions
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function non_admin_users_cannot_access_admin_area()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('insights.admin.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_posts_list()
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('insights.admin.index'));

        $response->assertStatus(200);
        $response->assertViewIs('insights.admin.posts.index');
        $posts->each(function ($post) use ($response) {
            $response->assertSee($post->translations->first()->title);
        });
    }

    /** @test */
    public function admin_can_create_new_post()
    {
        Storage::fake('public');
        $category = Category::factory()->create();
        
        $response = $this->actingAs($this->admin)->post(route('insights.admin.store'), [
            'title' => 'New Test Post',
            'subtitle' => 'Test Subtitle',
            'short_description' => 'A short description',
            'post_body' => 'The main content of the post',
            'slug' => 'new-test-post',
            'seo_title' => 'SEO Title',
            'meta_desc' => 'Meta description',
            'is_published' => true,
            'categories' => [$category->id],
            'image' => UploadedFile::fake()->image('post-image.jpg'),
            'lang_id' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_posts', ['user_id' => $this->admin->id]);
        $this->assertDatabaseHas('insights_post_translations', [
            'title' => 'New Test Post',
            'slug' => 'new-test-post',
        ]);
        Storage::disk('public')->assertExists('insights/posts/*');
    }

    /** @test */
    public function admin_can_edit_post()
    {
        $post = Post::factory()->create();
        $newCategory = Category::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('insights.admin.update', $post), [
            'title' => 'Updated Title',
            'subtitle' => 'Updated Subtitle',
            'short_description' => 'Updated description',
            'post_body' => 'Updated content',
            'slug' => 'updated-post',
            'seo_title' => 'Updated SEO Title',
            'meta_desc' => 'Updated meta description',
            'is_published' => true,
            'categories' => [$newCategory->id],
            'lang_id' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_post_translations', [
            'title' => 'Updated Title',
            'slug' => 'updated-post',
        ]);
    }

    /** @test */
    public function admin_can_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('insights.admin.destroy', $post));

        $response->assertRedirect();
        $this->assertDatabaseMissing('insights_posts', ['id' => $post->id]);
    }

    /** @test */
    public function admin_can_manage_categories()
    {
        // Create category
        $response = $this->actingAs($this->admin)->post(route('insights.admin.categories.store'), [
            'category_name' => 'New Category',
            'slug' => 'new-category',
            'category_description' => 'Description',
            'lang_id' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_categories', ['created_by' => $this->admin->id]);
        $this->assertDatabaseHas('insights_category_translations', [
            'category_name' => 'New Category',
            'slug' => 'new-category',
        ]);

        // Edit category
        $category = Category::first();
        $response = $this->actingAs($this->admin)
            ->put(route('insights.admin.categories.update', $category), [
                'category_name' => 'Updated Category',
                'slug' => 'updated-category',
                'category_description' => 'Updated description',
                'lang_id' => 1,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_category_translations', [
            'category_name' => 'Updated Category',
            'slug' => 'updated-category',
        ]);

        // Delete category
        $response = $this->actingAs($this->admin)
            ->delete(route('insights.admin.categories.destroy', $category));

        $response->assertRedirect();
        $this->assertDatabaseMissing('insights_categories', ['id' => $category->id]);
    }

    /** @test */
    public function admin_can_manage_comments()
    {
        $comment = Comment::factory()->create(['approved' => false]);

        // Approve comment
        $response = $this->actingAs($this->admin)
            ->patch(route('insights.admin.comments.approve', $comment));

        $response->assertRedirect();
        $this->assertTrue($comment->fresh()->approved);

        // Delete comment
        $response = $this->actingAs($this->admin)
            ->delete(route('insights.admin.comments.destroy', $comment));

        $response->assertRedirect();
        $this->assertDatabaseMissing('insights_comments', ['id' => $comment->id]);
    }
}