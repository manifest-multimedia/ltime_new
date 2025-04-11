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
                        @foreach ($properties as $property)
                            <div class="col-md-4 mt-5 mb-5">
                                <div class="card component-card_9">
                                    <img src="{{ ($property->featured_image) ? asset('storage/'.$property->featured_image) : asset('assets/backend/assets/img/400x300.jpg') }}" class="card-img-top" alt="{{ $property->title.' - featured_image' }}" style="height:300px; object-fit:cover">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $property->title }}</h5>
                                        <p class="card-text">{{ $property->description }}</p>
            
                                        <div class="meta-info">
                                            <div class="meta-user">
                                                <a href="/portal/properties/e/{{ $property->id }}" class="btn btn-primary mr-1 ml-1" >Edit Property</a>
                                                <a href="/p/{{ $property->id }}" class="btn btn-primary mr-1 ml-1">View on Website</a>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal-{{ $property->id }}">Delete Property</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                          <livewire:delete-confirmation-modal :itemID="$property->id" modelName="property" />
                        @endforeach
                    </div>
                </div>
            </div>
            
            
    
                
    
            </div>

         
           @livewire('new-property-modal')
           
       

    </x-backend-layout>