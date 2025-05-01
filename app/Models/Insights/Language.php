<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'insights_languages';
    
    protected $fillable = [
        'name',
        'locale',
        'iso_code',
        'language_code',
        'active',
        'is_default'
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'is_default' => 'boolean',
    ];
    
    /**
     * Get all post translations for this language
     */
    public function postTranslations()
    {
        return $this->hasMany(PostTranslation::class, 'lang_id');
    }
    
    /**
     * Get all category translations for this language
     */
    public function categoryTranslations()
    {
        return $this->hasMany(CategoryTranslation::class, 'lang_id');
    }
    
    /**
     * Get the default language
     */
    public static function getDefault()
    {
        return self::where('is_default', true)->first();
    }
}