<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewPropertyModal extends Component
{
    use WithFileUploads;

    public $property_title;
    public $property_type;
    public $property_description;
    public $property_location;
    public $property_price;
    public $featured;
    public $featured_image;
    public $cover_photo;
    public $short_description;
   

    public function mount(){
      
    }

    public function render()
    {
        $locations=Location::where('status', 'active')->get();
        
        return view('livewire.new-property-modal', [
            'locations' => $locations
        ]);
    }

    public function save(){

        if($this->short_description==null || $this->short_description==''){
            $this->short_description=mb_strimwidth($this->property_description, 0, 236, '...');
        }

        $this->validate([
            'property_title'=>'required', 
            'property_description'=>'required', 
            'property_location'=>'required', 
            'property_type'=>'required', 
            'property_price'=>'required', 
        ],[

            'property_title.required'=>"Please provide a title for the entry", 
            'property_description.required' => "Please provide a short description.", 
            'property_location.required'=>"Select a location",
            'property_type.required'=>"Please select a property type", 
            'property_price.required'=> "Please indicate the price for the entry",

        ]);

        if(isset($this->featured_image) && $this->featured_image!=null || $this->featured_image!=''){
            
            $featured_image_path=$this->featured_image->store('properties', 'public');
        }
      
       if(isset($this->cover_photo) && $this->cover_photo!=null || $this->cover_photo!=''){

           $cover_image_path=$this->cover_photo->store('cover_photos', 'public');
       }

       $store=new Property;
       $store->title=$this->property_title;
       $store->description=$this->property_description; 
       $store->short_description=$this->short_description; 
       $store->location=$this->property_location;
       $store->type=$this->property_type;
       $store->price=$this->property_price;

       if(isset($this->featured_image)){
           $store->featured_image=$featured_image_path;
       }
       if(isset($this->cover_photo))
            {$store->cover_image=$cover_image_path;
        }
        
        $store->featured=$this->featured;

       $store->save();

       session()->flash('Entry Saved', 'New Entry Saved Successfully');

       redirect("/portal/properties");

       $this->resetValues();

    }

    public function resetValues(){
        $this->property_title='';
        $this->property_type='';
        $this->property_description='';
        $this->property_location='';
        $this->property_price='';
        $this->featured='';
        $this->featured_image='';
        $this->cover_photo='';

    }

    public function delete($model,$id){
        
    }
}
