<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CmsPage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'meta_description',
        'content',
        'status',
        'layout',
    ];

    /**
     * Get all sections associated with this page
     *
     * @return HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(CmsSection::class)->orderBy('sort_order');
    }

    /**
     * Returns whether this page is published
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
