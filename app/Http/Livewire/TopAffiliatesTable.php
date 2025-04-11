<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TopAffiliatesTable extends Component
{
    public $affiliates=[];

    public function render()
    {
        return view('livewire.top-affiliates-table');
    }
}
