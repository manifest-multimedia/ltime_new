<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="page-title">

                        <h3 class="card-title">Property Locations</h3>
                        <div class="float-end" style="margin-top:-30px">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#newLocation">+ Add New Location</button>
                        </div>
                    
                    </div>
                </div>
                @if(session('deleted')) 
                <div class="alert alert-danger mx-5 mt-3">
                    {{session('deleted')}}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success mx-5 mt-3">
                    {{session('success')}}
                </div>
                @endif

                <div class="card-body">
                    <div class="responsive-table">
                        <table class="table table-bordered">
                            <thead>
                                <th>Location</th>
                                <th>Country</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>City</th>
                                <th>Region</th>
                                <th>Continent</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{$location->name}}</td>
                                        <td>{{$location->country}}</td>
                                        <td>{{$location->longitude}}</td>
                                        <td>{{$location->latitude}}</td>
                                        <td>{{$location->city}}</td>
                                        <td>{{$location->region}}</td>
                                        <td>{{$location->continent}}</td>
                                        <td>
                                            @if ($location->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <button class="btn btn-primary btn-sm" wire:click="edit({{$location->id}})">Edit</button> --}}
                                            <button class="btn btn-danger btn-sm" wire:click="delete({{$location->id}})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<livewire:property-locations-modal />

