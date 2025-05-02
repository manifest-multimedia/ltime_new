<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'insights_posts';
    protected $fillable = ['user_id', 'posted_at', 'is_published'];
    
    protected $casts = [
        'posted_at' => 'datetime',
        'is_published' => 'boolean'
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
    
    /**
     * Get the first translation or null if no translations exist
     *
     * @return mixed
     */
    public function getFirstTranslationAttribute()
    {
        return $this->translations->first();
    }
    
    /**
     * Get the current translation based on the current locale or first available
     *
     * @return mixed
     */
    public function getCurrentTranslationAttribute()
    {
        $currentLang = \App\Models\Insights\Language::where('iso_code', app()->getLocale())->first();
        
        if ($currentLang) {
            $translation = $this->translations->where('lang_id', $currentLang->id)->first();
            if ($translation) {
                return $translation;
            }
        }
        
        return $this->first_translation;
    }
}