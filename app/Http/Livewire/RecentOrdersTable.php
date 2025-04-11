<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RecentOrdersTable extends Component
{
    public $orders=[];
    public function render()
    {
        return view('livewire.recent-orders-table');
    }
}
