<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RecentAffiliateActivityTable extends Component
{
    public $orders=[];
    
    public function render()
    {
        return view('livewire.recent-affiliate-activity-table');
    }
}
