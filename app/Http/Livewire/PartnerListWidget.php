<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Partner; 

class PartnerListWidget extends Component
{
    protected $listeners = [
       'newPartnerAdded' =>'render'
    ];

    public function render()
    {
        return view('livewire.partner-list-widget');
    }

    public function delete($id){
       $delete=Partner::find($id);
       $delete->delete();
    }

    public function edit($partner_id){
        $this->emit('editPartner', $partner_id);
    }
}
