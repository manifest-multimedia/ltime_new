<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PropertyListview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $properties;
    
    public function __construct($properties)
    {
        $this->properties=$properties;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property-listview');
    }
}
