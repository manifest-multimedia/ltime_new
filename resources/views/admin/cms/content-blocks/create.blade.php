<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">{{ __('Add New Content Block to Section') }}</h2>
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('sections.content-blocks.store', $section) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Block Type') }}</label>
                                <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                                    <option value="">Select a block type</option>
                                    @foreach($blockTypes as $value => $name)
                                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">The block type determines the available fields and appearance</div>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Title') }} (Optional)</label>
                                <input id="title" class="form-control @error('title') is-invalid @enderror" 
                                       type="text" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subtitle" class="form-label">{{ __('Subtitle') }} (Optional)</label>
                                <input id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" 
                                       type="text" name="subtitle" value="{{ old('subtitle') }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">{{ __('Content') }} (Optional)</label>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" 
                                          name="content" rows="5">{{ old('content') }}</textarea>
                                <div class="form-text">Can contain HTML for formatting</div>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Image') }} (Optional)</label>
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" 
                                       name="image" accept="image/*">
                                <div class="form-text">Maximum size: 2MB</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="link_text" class="form-label">{{ __('Link Text') }} (Optional)</label>
                                    <input id="link_text" class="form-control @error('link_text') is-invalid @enderror" 
                                           type="text" name="link_text" value="{{ old('link_text') }}" 
                                           placeholder="E.g. Learn More, Read More">
                                    @error('link_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="link_url" class="form-label">{{ __('Link URL') }} (Optional)</label>
                                    <input id="link_url" class="form-control @error('link_url') is-invalid @enderror" 
                                           type="text" name="link_url" value="{{ old('link_url') }}" 
                                           placeholder="E.g. /contact, https://example.com">
                                    @error('link_url')
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
                                <a href="{{ route('sections.edit', $section) }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create Content Block') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            
            // You can add JavaScript to conditionally show/hide fields based on block type
            typeSelect.addEventListener('change', function() {
                const blockType = this.value;
                
                // Example: Show/hide fields based on the selected block type using Bootstrap classes
                // if (blockType === 'text') {
                //     document.getElementById('content').closest('.mb-3').classList.remove('d-none');
                //     document.getElementById('image').closest('.mb-3').classList.add('d-none');
                // } else if (blockType === 'image') {
                //     document.getElementById('content').closest('.mb-3').classList.add('d-none');
                //     document.getElementById('image').closest('.mb-3').classList.remove('d-none');
                // }
            });
            
            // Trigger change event to set initial state
            typeSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>