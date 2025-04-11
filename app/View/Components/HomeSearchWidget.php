<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Property;

class HomeSearchWidget extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $properties; 

    public $locations; 

    public $propertyTypes;

    public function __construct($properties, $locations)
    {
        $this->properties=$properties;
        $this->locations=$locations; 

        $this->propertyTypes= Property::distinct('type')->pluck('type');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home-search-widget');
    }
}
