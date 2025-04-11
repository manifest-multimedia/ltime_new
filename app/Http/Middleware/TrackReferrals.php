<?php

namespace App\Http\Middleware;

use App\Helpers\helper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackReferrals
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->ref){

            $referred_by=$request->ref;

            $referred_by_user=DB::table('users')->where('affiliate_id', $referred_by)->first();
           
            //Store information in the session; 

            if(!session()->has('referred_by')){

                helper::InitiateReferralTracking($referred_by);

            }else {
                    helper::UpdateReferralCode($referred_by);
            }
            
            
           
        }

        

        


        return $next($request);

    }
}
