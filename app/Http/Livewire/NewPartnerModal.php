<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Partner;
use Livewire\WithFileUploads;

class NewPartnerModal extends Component
{
    use WithFileUploads; 
    
    public $company_name; 
    public $company_logo;
    public $company_website;
    public function render()
    {
        return view('livewire.new-partner-modal');
    }

    public function save(){
        $this->validate([
            'company_name' => 'required',
            'company_website' => 'required',
            'company_logo' => 'required|image|max:2048', // Maximum file size of 2MB

        ]);

        $logoPath = $this->company_logo->store('public/images/partner-logos');
        // Remove the "public/" prefix from the file path
        $logoPath = str_replace('public/', '', $logoPath);

        $store=new Partner;
        $store->company=$this->company_name;
        $store->website=$this->company_website;
        $store->logo=$logoPath;
        $store->save();

        $this->resetValues();

        $this->emit('newPartnerAdded');

        

    }

    public function resetValues(){
        $this->company_name='';
        $this->company_website='';
        $this->company_logo='';
    }

    

}
