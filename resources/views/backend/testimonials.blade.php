<x-backend-layout> 

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3 class="float-left">Testimonials</h3>
                    <button class="ml-5 btn btn-primary float-left" data-toggle="modal" data-target="#testimonialModal">+ Add New Testimonial</button>
                </div>
                
                <div class="toggle-switch">
                    <a href="{{url('/portal/profile')}}">You're logged in as {{ ucfirst(Auth::user()->role) }} </a>
                    <label class="switch s-icons s-outline  s-outline-secondary">
                     
                    </label>
                </div>
            </div>
    
      
        {{-- Load Testimonials Widget --}}
            @livewire('testimonials-list-widget')
                         
                        
   
           @livewire('new-testimonial-modal')

            @livewire('edit-modal')
    
    </x-backend-layout>