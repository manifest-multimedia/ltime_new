<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BinshopsBlog\Models\Artticle;

class BlogController extends Controller
{
   public function getPosts(){
    
        $articles=Article::published()->get();

   }
}
