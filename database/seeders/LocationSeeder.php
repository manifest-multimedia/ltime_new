<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations=[
          '1'=> [
            'name'=>'Lagos',
            'description'=>'Lagos, Nigeria',
            'longitude'=>'6.524379',
            'latitude'=>'3.379205',
            'country'=>'Nigeria',
            'region'=>'Lagos',
            'city'=>'Lagos',
            'slug'=>'lagos',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '2'=> [
            'name'=>'Abuja',
            'description'=>'Abuja, Nigeria',
            'longitude'=>'7.496527',
            'latitude'=>'9.058084',
            'country'=>'Nigeria',
            'region'=>'Abuja',
            'city'=>'Abuja',
            'slug'=>'abuja',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '3'=> [
            'name'=>'Port Harcourt',
            'description'=>'Port Harcourt, Nigeria',
            'longitude'=>'4.777244',
            'latitude'=>'7.013833',
            'country'=>'Nigeria',
            'region'=>'Port Harcourt',
            'city'=>'Port Harcourt',
            'slug'=>'port-harcourt',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '3'=>[
            'name'=>'Accra',
            'description'=>'Accra, Ghana',
            'longitude'=>'-0.1975',
            'latitude'=>'5.55',
            'country'=>'Ghana',
            'region'=>'Greater Accra',
            'city'=>'Accra',
            'slug'=>'accra',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '4'=>[
            'name' => 'Tema',
            'description' => 'Tema, Ghana',
            'longitude' => '5.666667',
            'latitude' => '0.016667',
            'country' => 'Ghana',
            'region' => 'Greater Accra',
            'city' => 'Tema',
            'slug' => 'tema',
            'continent' => 'Africa',
            'status' => 'active',
        ], 
        '5'=>[
            'name' => 'Kumasi',
            'description' => 'Kumasi, Ghana',
            'longitude' => '-1.633333',
            'latitude' => '6.683333',
            'country' => 'Ghana',
            'region' => 'Greater Kumasi',
            'city' => 'Kumasi',
            'slug' => 'kumasi',
            'continent' => 'Africa',
            'status' => 'active',
        ],
        '6'=>[
            'name' => 'Cape Coast',
            'description' => 'Cape Coast, Ghana',
            'longitude' => '-1.25',
            'latitude' => '5.016667',
            'country' => 'Ghana',
            'region' => 'Central',
            'city' => 'Cape Coast',
            'slug' => 'cape-coast',
            'continent' => 'Africa',
            'status' => 'active',
        ],
        '7'=>[
            'name'=>'Tamale',
            'description'=>'Tamale, Ghana',
            'longitude'=>'-0.85',
            'latitude'=>'9.4',
            'country'=>'Ghana',
            'region'=>'Northern',
            'city'=>'Tamale',
            'slug'=>'tamale',
            'continent'=>'Africa',
            'status'=>'active',
        ], 
        '8'=>[
            'name'=>'Sekondi-Takoradi',
            'description'=>'Sekondi-Takoradi, Ghana',
            'longitude'=>'-1.716667',
            'latitude'=>'4.933333',
            'country'=>'Ghana',
            'region'=>'Western',
            'city'=>'Sekondi-Takoradi',
            'slug'=>'sekondi-takoradi',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '9'=>[
            'name'=>'Bolgatanga',
            'description'=>'Bolgatanga, Ghana',
            'longitude'=>'-0.65',
            'latitude'=>'10.95',
            'country'=>'Ghana',
            'region'=>'Upper East',
            'city'=>'Bolgatanga',
            'slug'=>'bolgatanga',
            'continent'=>'Africa',
            'status'=>'active',
        ],
        '10'=>[
            'name'=>'Dawa', 
            'description'=>'Dawa, Ghana', 
            'longitude'=>'0.2909600', 
            'latitude'=>'5.8637000', 
            'country'=>'Ghana', 
            'region'=>'Greater Accra', 
            'city'=>'Dawa', 
            'slug'=>'dawa', 
            'continent'=>'Africa', 
            'status'=>'active',
        ]
        ];

        foreach ($locations as $key => $value) {
            if(!Location::where('name',$value['name'])->exists()){
                Location::firstOrCreate($value);
            }
        }
    }
}
