<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Contracts\View\View;

class PropertyController extends Controller
{
    public function index(): View
    {
        $query="all";
        return view('projects', compact('query'));
    }

    public function show(Request $request): View
    {
        $property=Property::where('id',$request->id)->first();
        return view('property-details', compact('property'));
    }

    public function admin(): View
    {
        $properties=Property::all();
        return view('backend.properties', compact('properties'));
    }

    public function edit($id): View
    {
        $property_id=$id; 
        return view('backend.edit-property', compact('property_id'));
    }

    public function locations(): View
    {
        return view('backend.locations');
    }
}
