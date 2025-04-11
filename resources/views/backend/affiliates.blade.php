<x-backend-layout> 

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3>Referrals</h3>
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
    
                     
    
                    </div>
                </div>
                
    
                
    
              
    
                
                
    
    
           
    
                
    
            </div>
    
           
    
    </x-backend-layout>