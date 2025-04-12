<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'insights_categories';
    protected $fillable = ['created_by', 'parent_id', 'lft', 'rgt', 'depth'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'insights_post_categories', 'category_id', 'post_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}