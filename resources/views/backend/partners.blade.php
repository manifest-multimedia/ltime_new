<x-backend-layout> 

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3 class="float-left">Partners</h3>
                    <button class="ml-5 btn btn-primary float-left" data-toggle="modal" data-target="#newPartnerModal">+ Add New Partner</button>
                </div>
                
                <div class="toggle-switch">
                    <a href="{{url('/portal/profile')}}">You're logged in as {{ ucfirst(Auth::user()->role) }} </a>
                    <label class="switch s-icons s-outline  s-outline-secondary">
                     
                    </label>
                </div>
            </div>
    
            <div class="row layout-top-spacing">
    
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">
    
                        @livewire('partner-list-widget')
    
                    </div>
                </div>
                
    
                
    
              
    
                
                
    
    
           
    
                
    
            </div>
    
           @livewire('new-partner-modal')
    
    </x-backend-layout>