<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AffiliateReferralsTable extends Component
{
    public $affiliates=[];
    
    public function render()
    {
        return view('livewire.affiliate-referrals-table');
    }
}
