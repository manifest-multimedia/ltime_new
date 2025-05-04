<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CmsSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cms_page_id',
        'title',
        'type',
        'sort_order',
        'background_color',
        'text_color',
        'settings',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'json',
    ];

    /**
     * Get the page that owns the section
     *
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(CmsPage::class, 'cms_page_id');
    }

    /**
     * Get content blocks for this section
     *
     * @return HasMany
     */
    public function contentBlocks(): HasMany
    {
        return $this->hasMany(CmsContentBlock::class)->orderBy('sort_order');
    }

    /**
     * Get the view template for this section type
     * 
     * @return string
     */
    public function getViewTemplate(): string
    {
        return 'cms.sections.' . ($this->type ?: 'standard');
    }
}
