<x-backend-layout> 

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3 class="float-left">Properties</h3>
                    <button class="ml-5 btn btn-primary float-left" data-toggle="modal" data-target="#newProperty">+ Add New Property</button>
                </div>
                
                <div class="toggle-switch">
                    <a href="{{url('/portal/profile')}}">You're logged in as {{ ucfirst(Auth::user()->role) }} </a>
                    <label class="switch s-icons s-outline  s-outline-secondary">
                     
                    </label>
                </div>
            </div>
  
            <div class="card">
                <div class="card-body">
                    <div class="row mx-auto">
                      
                        <livewire:edit-partner-widget :testimonial_id="$testimonial_id" />

                    </div>
                </div>
            </div>
            
            
            </div>


    </x-backend-layout>