<x-backend-layout>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3>Settings</h3>
                </div>
                
                <div class="toggle-switch">
                    <a href="{{url('/portal/profile')}}">You're logged in as {{ ucfirst(Auth::user()->role) }} </a>
                    <label class="switch s-icons s-outline  s-outline-secondary">
                     
                    </label>
                </div>
            </div>
    
            <div class="pt-2 pb-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">System Configuration</div>
                            <div class="card-body">
                                @livewire('system-settings-widget')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Important Information
                            </div>
                            <div class="card-body">
                                <h2 style="font-size:25px"> System Currency Configuration</h2> 

                                    <p> Please configure the Default System Currency for billing and payments related to products and services.</p> 
                                    
                                    <p> Please note that adjusting the Default System Currency will not automatically update the prices of existing products. However, the currency displayed for the indicated amounts will be updated to reflect this setting.</p> 
                                    <p> For further assistance/support please contact <a href="mailto:support@manifestghana.com">support@manifestghana.com</a> (<a href="https://support.manifestghana.com" target="_">https://support.manifestghana.com</a>)</p> 
                                    <p> Thank you for your attention.</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 

</x-backend-layout>