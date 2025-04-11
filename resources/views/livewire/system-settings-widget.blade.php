<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label for="system-currency">System Currency </label>
                <select wire:model="new_currency" id="" class="custom-select">
                    <option value="{{ $default_currency }}">{{ $default_currency }}</option>
                    <option value="GHS">GHS</option>
                    <option value="USD">USD</option>
                </select>
                <button class="btn btn-primary float-right mt-3" wire:click="saveCurrency">Save</button>
        
               
            </div>
        </div>
        <div class="col-md-12">
            @if(session()->has('currency_saved'))
                @if(session('currency_saved')!='No changes were made!')
                    <div id="success-message" class="alert alert-success mt-3">
                        {{ session('currency_saved') }}
                    </div>
                @else 
                    <div id="success-message" class="alert alert-warning mt-3">
                        {{ session('currency_saved') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label for="system-language">System Language </label>
                <select wire:model="new_language" id="" class="custom-select">
                    <option value="{{ $default_language }}">{{ $default_language }}</option>
                    <option value="en">English</option>
                    {{-- <option value="fr">French</option> --}}
                </select>
                <button class="btn btn-primary float-right mt-3" wire:click="saveLanguage">Save</button>
        
               
            </div>
        </div>
        <div class="col-md-12">
            @if(session()->has('language_saved'))
                @if(session('language_saved')!='No changes were made!')
                    <div id="success-message" class="alert alert-success mt-3">
                        {{ session('language_saved') }}
                    </div>
                @else 
                    <div id="success-message" class="alert alert-warning mt-3">
                        {{ session('language_saved') }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Wait for the document to be ready
        document.addEventListener('livewire:load', function () {
            // Hide the success message after 3 seconds
            setTimeout(function () {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
        });
    </script>
    @endpush
    
</div>
