<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'insights_post_translations';
    
    protected $fillable = [
        'post_id',
        'slug',
        'title',
        'subtitle',
        'meta_desc',
        'seo_title',
        'post_body',
        'short_description',
        'use_view_file',
        'image_large',
        'image_medium',
        'image_thumbnail',
        'lang_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function language()
    {
        return $this->belongsTo(\BinshopsBlog\Models\BinshopsLanguage::class, 'lang_id');
    }
}