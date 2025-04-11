<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Testimonial;

class NewTestimonialModal extends Component
{
    public $testimonial_author; 
    public $testimonial_message;
    public $testimonial_rating; 
    public $testimonial_role;
    public $testimonial_photo;
    public $testimonial_company; 
    
    public function render()
    {
        return view('livewire.new-testimonial-modal');
    }

    public function save(){
        
        $this->validate([
            'testimonial_author'=>'required', 
            'testimonial_message'=>'required',
        ], [
            'testimonial_author.required'=>"Please provide a valid name", 
            'testimonial_message.required'=>"This field cannot be blank."
        ]);

     

        $save=New Testimonial;
        $save->name=$this->testimonial_author;
        $save->role=$this->testimonial_role;
        $save->body=$this->testimonial_message;
        $save->company=$this->testimonial_company;
        $save->rating=$this->testimonial_rating;
        $save->photo=$this->testimonial_photo;
        $save->save();

        $this->resetValues();

        $this->emit('closeTestimonialModal');
    }

    public function resetValues(){
        $this->testimonial_author = "";
        $this->testimonial_message = "";
    }
}
