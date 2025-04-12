<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'insights_posts';
    protected $fillable = ['user_id', 'posted_at', 'is_published'];
    
    protected $casts = [
        'posted_at' => 'datetime'
    ];

    public function translations()
    {
        return $this->hasMany(PostTranslation::class, 'post_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'insights_post_categories', 'post_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}