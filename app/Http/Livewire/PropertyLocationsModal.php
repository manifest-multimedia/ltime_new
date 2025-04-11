<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;

class PropertyLocationsModal extends Component
{
    public $location_name;
    public $location_country;
    public $location_longitude;
    public $location_latitude;
    public $location_city;
    public $location_region;
    public $location_continent;

    public function render()
    {
        $countries=\CountryState::getCountries();

     

        return view('livewire.property-locations-modal', 
        [
            'countries' => $countries
        ]);
    }

    public function store(){

        $this->validate([
            'location_name' => 'required',
            'location_country' => 'required',

        ]);

        $location=new Location;
        $location->name=$this->location_name;
        $location->country=$this->location_country;
        $location->longitude=$this->location_longitude;
        $location->latitude=$this->location_latitude;
        $location->city=$this->location_city;
        $location->region=$this->location_region;
        $location->continent=$this->location_continent;
        $location->status='active';
        $location->save();

        session()->flash('success', 'New location saved successfully');

        return redirect('/portal/locations');

    }
}
