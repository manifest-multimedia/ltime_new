<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

    }

    public function dashboard(){
        $role=helper::UserRole();

       if($role != "invalid" || $role != "" || $role != NULL){
            switch ($role) {
                case 'admin':

                    return view('backend.admin-dashboard');

                    break;
                case 'affiliate':
                
                    return view('backend.dashboard');
                    
                    break;
                default:
                   return redirect(404);
                    break;
            }
           
       }
       
    }
}
