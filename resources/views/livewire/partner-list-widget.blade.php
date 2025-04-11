<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="row">
        @foreach (App\Models\Partner::all() as $partner)
        <div class="col-md-4">
    
            <div class="card h-100">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <img src="{{ Storage::url($partner->logo) }}" alt="logo">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">{{ $partner->company }}</h4>
                            <p>{{ $partner->website }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <button class="btn btn-primary" wire:click="edit({{ $partner->id }})">Edit</button> --}}
                    <button class="btn btn-danger" wire:click="delete({{ $partner->id }})">Delete</button>
                </div>
             </div>
    
        </div>
        @endforeach
    </div>
</div>
