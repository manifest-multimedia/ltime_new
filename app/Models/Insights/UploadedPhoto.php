<?php

namespace App\Models\Insights;

use Illuminate\Database\Eloquent\Model;

class UploadedPhoto extends Model
{
    protected $table = 'insights_uploaded_photos';
    
    protected $fillable = [
        'uploaded_images',
        'image_title',
        'source',
        'uploader_id'
    ];

    protected $casts = [
        'uploaded_images' => 'array'
    ];

    public function uploader()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploader_id');
    }
}