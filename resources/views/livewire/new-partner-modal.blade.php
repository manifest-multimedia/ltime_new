<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
 

    <div wire:ignore.self class="modal fade" id="newPartnerModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPartnerModalLabel">Add a Partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        
                        @csrf

                        <div class="form-group">
                          
                            <input type="text" placeholder="Company Name" class="form-control" id="company_name" wire:model="company_name" required>
                            @error('company_name') <span class="text-danger">{{ $message  }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Comapny Website" class="form-control" id="company_website" wire:model="company_website" required>
                            @error('company_website') <span class="text-danger">{{ $message  }}</span> @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="company_logo">Company Logo</label>
                            <input type="file" placeholder="Company Logo" class="form-control dropify" id="company_logo" wire:model="company_logo" required>
                            @error('company_logo') <span class="text-danger">{{ $message  }}</span> @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" wire:click="save">Add Partner</button>
                        </div>
                </form> 
                </div>

                

                    
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
   
        window.livewire.on('newPartnerAdded', function () {
            $('#newPartnerModal').modal('hide');
        });
    
</script>
    @endpush

</div>
