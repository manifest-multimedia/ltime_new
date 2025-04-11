<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
 

    <div wire:ignore.self class="modal fade" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimonialModalLabel">Leave a Review</h5>
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
                            <input type="text" placeholder="Company Name" class="form-control" id="testimonial_author" wire:model="testimonial_company" required>
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
                            <label for="testimonial_rating">How would you rate our service? (1-5)</label>
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
                                @if($testimonial_rating!=0)
                                <br>
                            {{ 'You have rated us ' . $testimonial_rating . ' stars' }}

                            @endif
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" wire:click="save">Save Testimonial</button>
                        </div>
                </form> 
                </div>

                

                    
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
   
        window.livewire.on('closeTestimonialModal', function () {
            $('#testimonialModal').modal('hide');
        });
    
</script>
    @endpush

</div>
