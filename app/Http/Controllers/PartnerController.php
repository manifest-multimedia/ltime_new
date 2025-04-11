<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function signup(Request $request)
    {
        $email = $request->email;

        return redirect('register')->withInput(['email'=>$email]);
        
    }

    public function index(){
        return view('backend.partners');
    }

    public function edit(){
        return view('backend.edit-partner');
    }

}
