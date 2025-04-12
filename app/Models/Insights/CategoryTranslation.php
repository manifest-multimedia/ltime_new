<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'insights_category_translations';
    
    protected $fillable = [
        'category_id',
        'category_name',
        'slug',
        'category_description',
        'lang_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function language()
    {
        return $this->belongsTo(\BinshopsBlog\Models\BinshopsLanguage::class, 'lang_id');
    }
}