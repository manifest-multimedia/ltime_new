<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Property;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request) 
        {   
                      
            $posts= BinshopsPost::where('is_published', true)->limit(3)->get();

            $locations=Location::where('status', 'enabled')->get();
            $properties=Property::where('type', 'property')->orWhere('type', 'land')->where('featured', true)->get();
            $system_currency="GH₵";
            return view('home', compact(['locations', 'properties', 'system_currency', 'posts']));
        }
    
}
