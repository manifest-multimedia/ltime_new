<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">{{ __('Add New Section to') }}: {{ $page->title }}</h2>
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('cms-pages.sections.store', $page) }}">
                            @csrf

                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Section Type') }}</label>
                                <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                                    <option value="">Select a section type</option>
                                    @foreach($sectionTypes as $value => $name)
                                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">The section type determines the layout and appearance</div>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Section Title') }} (Optional)</label>
                                <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                                <div class="form-text">This may be displayed depending on the section type</div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="background_color" class="form-label">{{ __('Background Color') }} (Optional)</label>
                                    <input id="background_color" class="form-control @error('background_color') is-invalid @enderror" 
                                           type="text" name="background_color" value="{{ old('background_color') }}" 
                                           placeholder="E.g. bg-light, bg-primary, #f8f9fa">
                                    <div class="form-text">Use Bootstrap background classes or hex values</div>
                                    @error('background_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="text_color" class="form-label">{{ __('Text Color') }} (Optional)</label>
                                    <input id="text_color" class="form-control @error('text_color') is-invalid @enderror" 
                                           type="text" name="text_color" value="{{ old('text_color') }}" 
                                           placeholder="E.g. text-dark, text-primary, #212529">
                                    <div class="form-text">Use Bootstrap text classes or hex values</div>
                                    @error('text_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="settings" class="form-label">{{ __('Additional Settings') }} (Optional)</label>
                                <textarea id="settings" class="form-control font-monospace @error('settings') is-invalid @enderror" 
                                          name="settings" rows="4" 
                                          placeholder='{
  "key": "value"
}'>{{ old('settings') }}</textarea>
                                <div class="form-text">JSON format. Leave empty if not needed</div>
                                @error('settings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('cms-pages.edit', $page) }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create Section') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview color selections
        document.addEventListener('DOMContentLoaded', function() {
            const bgColorInput = document.getElementById('background_color');
            const textColorInput = document.getElementById('text_color');
            
            // Add preview functionality if needed
        });
    </script>
</x-app-layout>