<?php

namespace Tests\Unit\Insights\Policies;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use App\Policies\Insights\PostPolicy;
use App\Policies\Insights\CategoryPolicy;
use App\Policies\Insights\CommentPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InsightsPoliciesTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $editor;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create users with different roles
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
        
        $this->editor = User::factory()->create();
        $this->editor->assignRole('editor');
        
        $this->user = User::factory()->create();
    }

    /** @test */
    public function admin_can_manage_all_posts()
    {
        $post = Post::factory()->create();
        $policy = new PostPolicy();

        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertTrue($policy->create($this->admin));
        $this->assertTrue($policy->update($this->admin, $post));
        $this->assertTrue($policy->delete($this->admin, $post));
    }

    /** @test */
    public function editor_can_manage_own_posts()
    {
        $ownPost = Post::factory()->create(['user_id' => $this->editor->id]);
        $otherPost = Post::factory()->create();
        $policy = new PostPolicy();

        $this->assertTrue($policy->viewAny($this->editor));
        $this->assertTrue($policy->create($this->editor));
        $this->assertTrue($policy->update($this->editor, $ownPost));
        $this->assertTrue($policy->delete($this->editor, $ownPost));
        
        $this->assertFalse($policy->update($this->editor, $otherPost));
        $this->assertFalse($policy->delete($this->editor, $otherPost));
    }

    /** @test */
    public function regular_user_cannot_manage_posts()
    {
        $post = Post::factory()->create();
        $policy = new PostPolicy();

        $this->assertFalse($policy->viewAny($this->user));
        $this->assertFalse($policy->create($this->user));
        $this->assertFalse($policy->update($this->user, $post));
        $this->assertFalse($policy->delete($this->user, $post));
    }

    /** @test */
    public function admin_can_manage_all_categories()
    {
        $category = Category::factory()->create();
        $policy = new CategoryPolicy();

        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertTrue($policy->create($this->admin));
        $this->assertTrue($policy->update($this->admin, $category));
        $this->assertTrue($policy->delete($this->admin, $category));
    }

    /** @test */
    public function editor_can_view_but_not_manage_categories()
    {
        $category = Category::factory()->create();
        $policy = new CategoryPolicy();

        $this->assertTrue($policy->viewAny($this->editor));
        $this->assertFalse($policy->create($this->editor));
        $this->assertFalse($policy->update($this->editor, $category));
        $this->assertFalse($policy->delete($this->editor, $category));
    }

    /** @test */
    public function admin_can_manage_all_comments()
    {
        $comment = Comment::factory()->create();
        $policy = new CommentPolicy();

        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertTrue($policy->approve($this->admin, $comment));
        $this->assertTrue($policy->delete($this->admin, $comment));
    }

    /** @test */
    public function editor_can_manage_comments_on_own_posts()
    {
        $ownPost = Post::factory()->create(['user_id' => $this->editor->id]);
        $commentOnOwnPost = Comment::factory()->create(['post_id' => $ownPost->id]);
        
        $otherPost = Post::factory()->create();
        $commentOnOtherPost = Comment::factory()->create(['post_id' => $otherPost->id]);
        
        $policy = new CommentPolicy();

        $this->assertTrue($policy->viewAny($this->editor));
        $this->assertTrue($policy->approve($this->editor, $commentOnOwnPost));
        $this->assertTrue($policy->delete($this->editor, $commentOnOwnPost));
        
        $this->assertFalse($policy->approve($this->editor, $commentOnOtherPost));
        $this->assertFalse($policy->delete($this->editor, $commentOnOtherPost));
    }

    /** @test */
    public function user_can_manage_own_comments()
    {
        $ownComment = Comment::factory()->create(['user_id' => $this->user->id]);
        $otherComment = Comment::factory()->create();
        $policy = new CommentPolicy();

        $this->assertFalse($policy->viewAny($this->user));
        $this->assertFalse($policy->approve($this->user, $ownComment));
        $this->assertTrue($policy->delete($this->user, $ownComment));
        $this->assertFalse($policy->delete($this->user, $otherComment));
    }

    /** @test */
    public function user_cannot_delete_approved_comments()
    {
        $ownComment = Comment::factory()->approved()->create(['user_id' => $this->user->id]);
        $policy = new CommentPolicy();

        $this->assertFalse($policy->delete($this->user, $ownComment));
    }
}