<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;

class PropertyLocationsWidget extends Component
{

    public $mode='index';
    public $selectedID;

    public function render()
    {
        $locations=Location::all();
        return view('livewire.property-locations-widget', [
            'locations' => $locations
        ]);


    }



    public function edit($id){

        $this->mode='edit';
        $this->selectedID=$id;

    }


    public function delete($id){
       $delete=Location::find($id);
       $delete->delete();
       session()->flash('deleted', 'Location deleted successfully');
    }










}
