<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    {{-- Create a Bootstrap Modal --}}
    <div class="modal fade" id="newLocation" tabindex="-1" role="dialog" aria-labelledby="newLocationModalLabel" data-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLocationModalLabel">New Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location_name">Location Name</label> <input type="text" class="form-control" id="location_name" wire:model.lazy="location_name">
                                @error('location_name') <span class="text-danger">{{ $message  }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location_country">Country</label> 
                                
                                <select name="location_country" id="location_country" class="custom-select" wire:model="location_country">
                                    <option value="">Choose Country</option>
                                    <option value="Ghana">Ghana</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                @error('location_country') <span class="text-danger">{{ $message  }}</span> @enderror
                            </div>
                        </div>
                   
                    
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="location_longitude">Longitude</label> <input type="text" class="form-control" id="location_longitude" wire:model.lazy="location_longitude">
                          @error('location_longitude') <span class="text-danger">{{ $message  }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="location_latitude">Latitude</label> <input type="text" class="form-control" id="location_latitude" wire:model.lazy="location_latitude">
                          @error('location_latitude') <span class="text-danger">{{ $message  }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">

                      <div class="form-group">
                          <label for="location_city">City</label> <input type="text" class="form-control" id="location_city" wire:model.lazy="location_city">
                          @error('location_city') <span class="text-danger">{{ $message  }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">

                      <div class="form-group">
                          <label for="location_region">Region</label> <input type="text" class="form-control" id="location_region" wire:model.lazy="location_region">
                          @error('location_region') <span class="text-danger">{{ $message  }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="location_continent">Continent</label> <input type="text" class="form-control" id="location_continent" wire:model.lazy="location_continent">
                        @error('location_continent') <span class="text-danger">{{ $message  }}</span> @enderror
                    </div>
                  </div>

                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
