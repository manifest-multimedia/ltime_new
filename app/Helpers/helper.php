<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class helper {

    public static function UpdateReferralCode($data) {


        $session_data=session()->get('referred_by');

        if($session_data!=$data){
            session()->put('referred_by', $data);
        }
        
    }

    public static function InitiateReferralTracking($data){

        session()->put('referred_by', $data);
        
    }

    public static function UserReferral(){
        if(session()->has('referred_by')){
            return session()->get('referred_by');
        } else {
            return 'System';
        }
    }

    public static function UserRole(){
        $role=Auth::user()->role;
        if($role === "admin" || $role === "affiliate"){

            return $role;
        } else {
            return "invalid";
        }
    }

    public static function getUserFirstName($name){
        $nameParts = explode(' ', $name);
        return $nameParts[0] ?? '';
    }

    public static function getUserLastName($name){
        $nameParts = explode(' ', $name);

        // dd("From $name, the users's last name is ".end($nameParts));
        return end($nameParts) ?? '';
    }

    public static function getUserOtherName($name){

        $nameParts = explode(' ', $name);
        $otherNames = '';
    
        if (count($nameParts) >= 3) {
            $otherNames = implode(' ', array_slice($nameParts, 1, -1)); // Return other names in full
        }
    
        return $otherNames;
    }

}