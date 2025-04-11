<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Testimonial;

class TestimonialsListWidget extends Component
{
    protected $listeners = [
        'closeTestimonialModal' => 'render',
        'testimonialUpdated' => 'render'
    ];

    public function render()
    {
        return view('livewire.testimonials-list-widget');
    }


    public function edit($testimonial_id){
       
        $this->emit('editModal', $testimonial_id);
    }

    public function delete($id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
    }


}
