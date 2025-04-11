<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimonialModalLabel">Edit Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            {{-- <label for="testimonial_author">Author *</label> --}}
                            <input type="text" placeholder="Full Name" class="form-control" id="testimonial_author" wire:model="testimonial_author" required>
                            @error('testimonial_author') <span class="text-danger">{{ $message  }}</span> @enderror
                        </div>
                        <div class="form-group">
                            {{-- <label for="testimonial_company">Company</label> --}}
                            <input type="text" placeholder="Company Name" class="form-control" id="testimonial_company" wire:model="testimonial_company" required>
                            {{-- @error('testimonial_company') <span class="text-danger">{{ $message  }}</span> @enderror --}}
                        </div>
                        <div class="form-group">
                            {{-- <label for="testimonial_role">Role </label> --}}
                            <input type="text" placeholder="Role in Company" class="form-control" id="testimonial_role" wire:model="testimonial_role" required>
                            {{-- @error('testimonial_author') <span class="text-danger">{{ $message  }}</span> @enderror --}}
                        </div>
                        <div class="form-group">
                            {{-- <label for="testimonial_message">Message *</label> --}}
                            <textarea class="form-control" placeholder="Message" id="testimonial_message" wire:model="testimonial_message" required></textarea>
                            @error('testimonial_message') <span class="text-danger">{{ $message  }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="testimonial_rating">Rating</label>
                            <div class="rating">
                                <input type="radio" id="star1" name="rating" value="1" wire:model="testimonial_rating">
                                <label for="star1">1</label>
                                <input type="radio" id="star2" name="rating" value="2" wire:model="testimonial_rating">
                                <label for="star2">2</label>
                                <input type="radio" id="star3" name="rating" value="3" wire:model="testimonial_rating">
                                <label for="star3">3</label>
                                <input type="radio" id="star4" name="rating" value="4" wire:model="testimonial_rating">
                                <label for="star4">4</label>
                                <input type="radio" id="star5" name="rating" value="5" wire:model="testimonial_rating" required>
                                <label for="star5">5</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" wire:click='update'>Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
   
        window.livewire.on('testimonialUpdated', function () {
            $('#editModal').modal('hide');
        });
    
    </script>
    @endpush
    
</div>
