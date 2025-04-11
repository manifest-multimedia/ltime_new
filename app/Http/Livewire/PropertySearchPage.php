<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use App\Models\Property;

class PropertySearchPage extends Component
{
    public $properties; 
    public $locations;
    public $price_filter = [0, 5000];
    public $initializedSlider = false;
    public $highestprice; 
    public $query;
    public $results; 
    public $filter=[];

    protected $listeners = ['priceFilterChanged'];

    public function mount($query,$results=null){
        $this->query=$query;

        if (isset($results)) {
            $this->results = $results;
        }
        
        $this->highestprice=Property::max('price');
        $this->locations=Location::all();
       
    }
    public function render()
    {
        $propertyTypes= Property::distinct('type')->pluck('type');

        switch ($this->query) {
            case 'all':
                if($this->filter!=null){
                    $this->properties=$this->filter;
                }else {
                    $this->properties=Property::all();
                }
                break;
            case 'empty':
                $this->properties=[];
            default:
                $this->properties=$this->results;
                break;
        }
       
        return view('livewire.property-search-page', compact('propertyTypes'));
    }

    public function priceFilterChanged($value)
    {
        $this->price_filter = explode(" - ", $value);
   
        $minPrice=$this->price_filter[0];
        $maxPrice=$this->price_filter[1];
 
        $this->filter=Property::whereBetween('price', [$minPrice, $maxPrice])->get();
        
    }

   
}
