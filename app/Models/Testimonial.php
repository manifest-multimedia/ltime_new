<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'testimonial_author',
        'testimonial_message',
        'testimonial_image',
        'testimonial_company'
    ];
}
