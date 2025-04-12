<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insights\Post as InsightsPost;

class BlogController extends Controller
{
   public function getPosts(){
        $articles = InsightsPost::where('is_published', true)->get();
   }
}
