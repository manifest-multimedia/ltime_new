<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(){
        $query="all";
        return view('projects', compact('query'));

    }

    public function show(Request $request){
        
         $property=Property::where('id',$request->id)->first();
        
        return view('property-details', compact('property'));

    }

    public function admin(){
        
        $properties=Property::all();

        return view('backend.properties', compact('properties'));
    }

    public function edit($id){
        
        $property_id=$id; 

        return view('backend.edit-property', compact('property_id'));

    }

    public function locations(){
        return view('backend.locations');
    }
}
