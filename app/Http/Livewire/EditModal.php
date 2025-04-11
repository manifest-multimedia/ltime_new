<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Testimonial;

class EditModal extends Component
{
    protected $listeners = [
        'editModal' => 'edit',
    ]; 

    public $testimonial_id;
    public $testimonial_author;
    public $testimonial_role;
    public $testimonial_message;
    public $testimonial_photo;
    public $testimonial_company;
    public $testimonial_rating; 
   

    public function mount(){
        $this->testimonial_author='';
        $this->testimonial_message='';
        $this->testimonial_photo='';
        $this->testimonial_company='';
        $this->testimonial_rating='';
    }
    
    public function render()
    {
        return view('livewire.edit-modal');
    }

    public function edit($testimonial_id){
        $testimonial=Testimonial::findOrfail($testimonial_id);
        
        $this->testimonial_id=$testimonial->id ?? '';

        $this->testimonial_author=$testimonial->name ?? 'error';
        $this->testimonial_role=$testimonial->role ?? 'error';
        $this->testimonial_message=$testimonial->body ?? 'error';
        $this->testimonial_company=$testimonial->company ?? 'error';
        $this->testimonial_photo=$testimonial->photo ?? 'error';
        $this->testimonial_rating=$testimonial->rating ?? 'error';

       

    }

    public function update(){
        $update=Testimonial::where('id',$this->testimonial_id)->update([
            'name'=>$this->testimonial_author,
            'role'=>$this->testimonial_role,
            'body'=>$this->testimonial_message,
            'company'=>$this->testimonial_company,
            'photo'=>$this->testimonial_photo,
            'rating'=>$this->testimonial_rating,

        ]);

        $this->emit('testimonialUpdated');
    }
}
