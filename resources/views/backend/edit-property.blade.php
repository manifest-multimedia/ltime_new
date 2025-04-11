<x-backend-layout> 

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3 class="float-left">Properties</h3>
                    <a href="/portal/properties" class="ml-5 btn btn-danger float-left">< Cancel Editing</a>
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
                      <div class="col-md-12">

                          <livewire:edit-propertywidget :property_id="$property_id" />
                      </div>

                    </div>
                </div>
            </div>
            
            
    
                
    
            </div>

        
           
       

    </x-backend-layout>