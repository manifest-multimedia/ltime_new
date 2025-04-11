<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(Request $request){
        
        return view('backend.profile', [
            'request' => $request,
            'user' => $request->user(),
        ]);

    }
}
