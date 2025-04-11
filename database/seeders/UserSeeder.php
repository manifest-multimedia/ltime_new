<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Helpers\helper;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referred_by=helper::UserReferral();

      if(!User::where('email','johnson@manifestghana.com')->exists()){
        User::firstOrCreate ([
            'name' => 'Johnson Sebire', 
            'email' => 'johnson@manifestghana.com',
            'password' => Hash::make('p@$$wordGH13'), 
            'role'=>'admin',
            'referred_by'=>$referred_by,
        ]);
      }

       if(!User::where('email','apostleraylive@gmail.com')->exists()){
        User::firstOrCreate ([
            'name' => 'Emmanuel Ray', 
            'email' => 'apostleraylive@gmail.com',
            'password' => Hash::make('Ray@LTime233'), 
            'role'=>'admin',
            'referred_by'=>$referred_by,
        ]);
       }

        if(!User::where('email','francis@ltimepropertiesltd.com')->exists()){
            User::firstOrCreate ([
                'name' => 'Francis Agbeko', 
                'email' => 'francis@ltimepropertiesltd.com',
                'password' => Hash::make('Francis@LTime233'), 
                'role'=>'admin',
                'referred_by'=>$referred_by,
            ]);
        }
    }
}
