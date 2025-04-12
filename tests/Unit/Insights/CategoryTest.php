<?php

namespace Tests\Unit\Insights;

use Tests\TestCase;
use App\Models\Insights\Category;
use App\Models\Insights\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_creator()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['created_by' => $user->id]);

        $this->assertInstanceOf(User::class, $category->creator);
        $this->assertEquals($user->id, $category->creator->id);
    }

    /** @test */
    public function it_can_have_translations()
    {
        $category = Category::factory()->create();

        $this->assertNotEmpty($category->translations);
        $this->assertEquals(1, $category->translations->count());
    }

    /** @test */
    public function it_can_have_multiple_posts()
    {
        $category = Category::factory()->create();
        $posts = Post::factory()->count(3)->create();

        $category->posts()->attach($posts->pluck('id'));

        $this->assertEquals(3, $category->posts->count());
        $this->assertInstanceOf(Post::class, $category->posts->first());
    }

    /** @test */
    public function it_can_have_a_parent_category()
    {
        $parentCategory = Category::factory()->create();
        $childCategory = Category::factory()->create(['parent_id' => $parentCategory->id]);

        $this->assertInstanceOf(Category::class, $childCategory->parent);
        $this->assertEquals($parentCategory->id, $childCategory->parent->id);
    }

    /** @test */
    public function it_can_have_child_categories()
    {
        $parentCategory = Category::factory()->create();
        $childCategories = Category::factory()->count(3)->create(['parent_id' => $parentCategory->id]);

        $this->assertEquals(3, $parentCategory->children->count());
        $this->assertInstanceOf(Category::class, $parentCategory->children->first());
    }

    /** @test */
    public function it_can_get_categories_without_parent()
    {
        Category::factory()->count(2)->create(['parent_id' => null]);
        Category::factory()->count(3)->create(['parent_id' => Category::factory()->create()->id]);

        $rootCategories = Category::root()->get();

        $this->assertEquals(2, $rootCategories->count());
    }

    /** @test */
    public function it_can_get_all_descendants()
    {
        $rootCategory = Category::factory()->create();
        $childCategory = Category::factory()->create(['parent_id' => $rootCategory->id]);
        $grandchildCategory = Category::factory()->create(['parent_id' => $childCategory->id]);

        $descendants = $rootCategory->descendants;

        $this->assertEquals(2, $descendants->count());
        $this->assertTrue($descendants->contains($childCategory));
        $this->assertTrue($descendants->contains($grandchildCategory));
    }

    /** @test */
    public function it_can_get_all_ancestors()
    {
        $rootCategory = Category::factory()->create();
        $childCategory = Category::factory()->create(['parent_id' => $rootCategory->id]);
        $grandchildCategory = Category::factory()->create(['parent_id' => $childCategory->id]);

        $ancestors = $grandchildCategory->ancestors;

        $this->assertEquals(2, $ancestors->count());
        $this->assertTrue($ancestors->contains($rootCategory));
        $this->assertTrue($ancestors->contains($childCategory));
    }
}