<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Property;
// use with file uploads
use Livewire\WithFileUploads;

class EditPropertywidget extends Component
{
    use WithFileUploads;

    public $property_id;
    public $property_type;
    public $property_title;
    public $property_description;
    public $property_location;
    public $featured; 
    public $property_price;
    public $old_featured_image;
    public $new_featured_image;
    public $old_cover_image; 
    public $new_cover_image;

    public $locations; 

    public function mount(){
        
        if($property=Property::where('id', $this->property_id)->first()){
            $this->property_type=$property->type;
            $this->property_title=$property->title;
            $this->property_description=$property->description;
            $this->property_location=$property->location;
            $this->featured=$property->featured;
            $this->property_price=$property->price;
            $this->old_featured_image=$property->featured_image;
            $this->old_cover_image=$property->cover_image;
        };



        $this->locations=Location::all();



    }

    public function render()
    {
        return view('livewire.edit-propertywidget');
    }



    public function save(){

        $featured_image='';
        $cover_image='';

        if(isset($this->new_featured_image) && $this->new_featured_image!='' || $this->new_featured_image!=null){

            if($this->old_featured_image!=$this->new_featured_image) 
            {
                $featured_image=$this->new_featured_image->store('properties', 'public');

            }

        }else {
            $featured_image=$this->old_featured_image;
        }

        // Update Cover Image 

        if(isset($this->new_cover_image) && $this->new_cover_image!='' || $this->new_cover_image!=null){

            if($this->old_cover_image!=$this->new_cover_image) 
            {
                $cover_image=$this->new_cover_image->store('cover_photos', 'public');

            }

        }else {
            $cover_image=$this->old_cover_image;
        }
        
        Property::where('id',$this->property_id)->update([
            'title'=>$this->property_title, 
            'description'=>$this->property_description, 
            'featured'=>$this->featured, 
            'beds'=>'', 
            'baths'=>'', 
            'squareft'=>'', 
            'price'=>$this->property_price, 
            'featured_image'=>$featured_image, 
            'cover_image'=>$cover_image,
            'type'=>$this->property_type, 
            'location'=>$this->property_location, 
            'status'=>'', 
            'year_built'=>null, 
            'rooms'=>'',
            'garage'=>'', 
        ]);


        session()->flash('property_updated','Successfully updated property information!');

        return redirect('/portal/properties');









    }



}
