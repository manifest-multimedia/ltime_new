<x-backend-layout>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
    
            <div class="page-header">
                <div class="page-title">
                    <h3>Profile</h3>
                </div>
                
                <div class="toggle-switch">
                    <a href="{{url('/portal/profile')}}">You're logged in as {{ ucfirst(Auth::user()->role) }} </a>
                    <label class="switch s-icons s-outline  s-outline-secondary">
                     
                    </label>
                </div>
            </div>
    
            <div class="pt-2 pb-5">
                @livewire('user-profile-component')
            </div>
 

</x-backend-layout>