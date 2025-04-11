<div>
    {{-- Stop trying to control. --}}

    <style>
        .dropify-filename{
            display:none !important;
        }
        .dropify-wrapper {
            width: 200px;
            height: 200px;
        }

        .dropify-wrapper .dropify-preview .dropify-render img {
            object-fit: cover !important;
            /* Existing CSS properties */
        }
    </style>    

                    <div class="row">
                        
                        <div class="col-md-9">
                            <p class="modal-text">Edit Property </p>
                            
                                <div class="form-group">
                                    <label for="property_type">Property Type *</label>
                                    <select name="property_type" id="property_type" class="custom-select" wire:model="property_type">
                                        <option value="">Select Property Type</option>
                                        <option value="land">Land</option>
                                        <option value="property">Real Estate</option>
                                    </select>
                                    @error('property_type')
                                        <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Property Title *</label>
                                    <input type="text" placeholder="Property Title" class="form-control" wire:model="property_title">
                                    @error('property_title')
                                    <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description *</label>
                                    <textarea wire:model="property_description" class="form-control"
                                    name="description" id="description" cols="30" rows="3" placeholder="Description"></textarea>
                                    @error('property_description')
                                        <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="location">Location *</label>
                                    <select wire:model="property_location" name="location" id="location" class="custom-select">
                                        <option value="">Choose Property Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('property_location')
                                        <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="featured">Featured?</label>
                                    <input wire:model="featured" type="checkbox" name="featured" id="featured" class="">
        
                                </div>
                                <div class="form-group">
                                    <label for="price">Price *</label>
                                    <input wire:model="property_price" type="text" placeholder="Enter the Price for the Property" class="form-control">
                                    @error('property_price')
                                        <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                    @enderror
                                </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="featured_image">Featured Image *</label>
                               
            
                                <div class="featured-photo text-center"  wire:ignore>
                                   @if(isset($old_featured_image))
                                    <input wire:model="featured_image" type="file" id="photoInput" class="dropify"
                                        data-default-file="{{ Storage::url("public/$old_featured_image") }}" data-allowed-file-extensions="jpg JPG JPEG jpeg png gif">
                                    <!-- Show uploading message when photo is being uploaded -->
                                    <div wire:loading wire:target="featured_image" class="text-muted mt-3">Uploading...</div>
                                   @else 
                                   <input wire:model="featured_image" type="file" id="photoInput" class="dropify"
                                        data-default-file="" data-allowed-file-extensions="jpg JPG JPEG jpeg png gif">
                                    <!-- Show uploading message when photo is being uploaded -->
                                    <div wire:loading wire:target="featured_image" class="text-muted mt-3">Uploading...</div>
                                   @endif 
                                </div>
                                @error('featured_image')
                                    <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <div class="featured-photo text-center"  wire:ignore>
                                    @if(isset($old_cover_image))
                                    <input wire:model="cover_photo" type="file" id="photoInput" class="dropify"
                                        data-default-file="{{ Storage::url("public/$old_cover_image") }}" data-allowed-file-extensions="jpg JPG JPEG jpeg png gif">
                                    <!-- Show uploading message when photo is being uploaded -->
                                    <div wire:loading wire:target="photo" class="text-muted mt-3">Uploading...</div>
                                   @else 
                                   <input wire:model="cover_photo" type="file" id="photoInput" class="dropify"
                                        data-default-file="" data-allowed-file-extensions="jpg JPG JPEG jpeg png gif">
                                    <!-- Show uploading message when photo is being uploaded -->
                                    <div wire:loading wire:target="photo" class="text-muted mt-3">Uploading...</div>
                                    @endif
                                </div>
                                @error('cover_photo')
                                    <div class="alert alert-danger mt-3"> {{ $message }} </div>
                                @enderror
                                <div class="mt-2 pt-2">
                                    <button class="btn btn-primary" wire:click="save">Save Changes</button>
                                    <a href="/portal/properties" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                           
                            
                        </div>
                    
                </div>
                    </div>
                    
                



</div>
