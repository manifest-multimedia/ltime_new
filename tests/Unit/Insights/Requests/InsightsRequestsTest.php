<?php

namespace Tests\Unit\Insights\Requests;

use Tests\TestCase;
use App\Http\Requests\Insights\PostRequest;
use App\Http\Requests\Insights\CategoryRequest;
use App\Http\Requests\Insights\CommentRequest;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;

class InsightsRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_request_validates_required_fields()
    {
        $request = new PostRequest();
        $validator = Validator::make([], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('title', $validator->errors()->messages());
        $this->assertArrayHasKey('post_body', $validator->errors()->messages());
        $this->assertArrayHasKey('slug', $validator->errors()->messages());
        $this->assertArrayHasKey('lang_id', $validator->errors()->messages());
    }

    /** @test */
    public function post_request_validates_slug_uniqueness()
    {
        $existingPost = Post::factory()->create();
        $existingSlug = $existingPost->translations->first()->slug;

        $request = new PostRequest();
        $validator = Validator::make([
            'title' => 'Test Post',
            'post_body' => 'Test content',
            'slug' => $existingSlug,
            'lang_id' => 1,
        ], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('slug', $validator->errors()->messages());
    }

    /** @test */
    public function post_request_allows_same_slug_for_different_languages()
    {
        $existingPost = Post::factory()->create();
        $existingSlug = $existingPost->translations->first()->slug;

        $request = new PostRequest();
        $validator = Validator::make([
            'title' => 'Test Post',
            'post_body' => 'Test content',
            'slug' => $existingSlug,
            'lang_id' => 2, // Different language
        ], $request->rules());

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function category_request_validates_required_fields()
    {
        $request = new CategoryRequest();
        $validator = Validator::make([], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('category_name', $validator->errors()->messages());
        $this->assertArrayHasKey('slug', $validator->errors()->messages());
        $this->assertArrayHasKey('lang_id', $validator->errors()->messages());
    }

    /** @test */
    public function category_request_validates_slug_uniqueness()
    {
        $existingCategory = Category::factory()->create();
        $existingSlug = $existingCategory->translations->first()->slug;

        $request = new CategoryRequest();
        $validator = Validator::make([
            'category_name' => 'Test Category',
            'slug' => $existingSlug,
            'lang_id' => 1,
        ], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('slug', $validator->errors()->messages());
    }

    /** @test */
    public function category_request_validates_parent_id()
    {
        $request = new CategoryRequest();
        $validator = Validator::make([
            'category_name' => 'Test Category',
            'slug' => 'test-category',
            'lang_id' => 1,
            'parent_id' => 999, // Non-existent ID
        ], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('parent_id', $validator->errors()->messages());
    }

    /** @test */
    public function comment_request_validates_required_fields_for_guests()
    {
        $request = new CommentRequest();
        $validator = Validator::make([], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('comment', $validator->errors()->messages());
        $this->assertArrayHasKey('author_name', $validator->errors()->messages());
        $this->assertArrayHasKey('author_email', $validator->errors()->messages());
    }

    /** @test */
    public function comment_request_validates_email_format()
    {
        $request = new CommentRequest();
        $validator = Validator::make([
            'comment' => 'Test comment',
            'author_name' => 'John Doe',
            'author_email' => 'invalid-email',
        ], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('author_email', $validator->errors()->messages());
    }

    /** @test */
    public function comment_request_only_requires_comment_for_authenticated_users()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = new CommentRequest();
        $validator = Validator::make([
            'comment' => 'Test comment',
        ], $request->rules());

        $this->assertTrue($validator->passes());
    }
}