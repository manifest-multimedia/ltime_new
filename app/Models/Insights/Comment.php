<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'insights_comments';
    
    protected $fillable = [
        'post_id',
        'user_id',
        'ip',
        'author_name',
        'comment',
        'approved',
        'author_email',
        'author_website'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}