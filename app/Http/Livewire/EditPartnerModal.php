<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditPartnerModal extends Component
{
    protected $listeners = [
        'editPartner' => 'edit'
    ];

    public $partner_company;
    public $partner_website;
    public $partner_logo; 

    public function render()
    {
        return view('livewire.edit-partner-modal');
    }

    public function edit($partner_id){
        $partner=Partner::findorfail($partner_id);

        $this->partner_company=$partner->company;
        $this->partner_website=$partner->website;
        $this->partner_logo=$partner->logo;
        


    }
}
