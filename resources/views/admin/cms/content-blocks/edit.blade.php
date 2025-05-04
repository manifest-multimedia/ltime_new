<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ __('Edit Content Block') }}: {{ $contentBlock->title ?: 'Block '.$contentBlock->id }}</h2>
            <a href="{{ route('sections.edit', $contentBlock->section) }}" class="btn btn-secondary">
                Back to Section
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('content-blocks.update', $contentBlock) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Block Type') }}</label>
                                <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                                    @foreach($blockTypes as $value => $name)
                                        <option value="{{ $value }}" {{ old('type', $contentBlock->type) == $value ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Title') }} (Optional)</label>
                                <input id="title" class="form-control @error('title') is-invalid @enderror" 
                                       type="text" name="title" value="{{ old('title', $contentBlock->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subtitle" class="form-label">{{ __('Subtitle') }} (Optional)</label>
                                <input id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" 
                                       type="text" name="subtitle" value="{{ old('subtitle', $contentBlock->subtitle) }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">{{ __('Content') }} (Optional)</label>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror"
                                          name="content" rows="5">{{ old('content', $contentBlock->content) }}</textarea>
                                <div class="form-text">Can contain HTML for formatting</div>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Image') }} (Optional)</label>
                                
                                @if($contentBlock->image)
                                    <div class="mb-3">
                                        <p class="form-text mb-2">Current image:</p>
                                        <img src="{{ asset('storage/' . $contentBlock->image) }}" 
                                             alt="{{ $contentBlock->title }}" 
                                             class="img-thumbnail" style="max-width: 250px;">
                                    </div>
                                @endif
                                
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                       name="image" accept="image/*">
                                <div class="form-text">Maximum size: 2MB. Leave empty to keep current image.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="link_text" class="form-label">{{ __('Link Text') }} (Optional)</label>
                                    <input id="link_text" class="form-control @error('link_text') is-invalid @enderror"
                                           type="text" name="link_text" value="{{ old('link_text', $contentBlock->link_text) }}">
                                    @error('link_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="link_url" class="form-label">{{ __('Link URL') }} (Optional)</label>
                                    <input id="link_url" class="form-control @error('link_url') is-invalid @enderror"
                                           type="text" name="link_url" value="{{ old('link_url', $contentBlock->link_url) }}">
                                    @error('link_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="settings" class="form-label">{{ __('Additional Settings') }} (Optional)</label>
                                <textarea id="settings" class="form-control font-monospace @error('settings') is-invalid @enderror"
                                          name="settings" rows="4">{{ old('settings', is_array($contentBlock->settings) ? json_encode($contentBlock->settings, JSON_PRETTY_PRINT) : $contentBlock->settings) }}</textarea>
                                <div class="form-text">JSON format. Leave empty if not needed</div>
                                @error('settings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('sections.edit', $contentBlock->section) }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update Content Block') }}</button>
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
                // Add dynamic behavior if needed using Bootstrap classes
            });
            
            // Initialize WYSIWYG editor for content if needed
            // For example, using TinyMCE:
            // if (typeof tinymce !== 'undefined') {
            //     tinymce.init({
            //         selector: '#content',
            //         height: 300,
            //         menubar: false,
            //         plugins: [
            //             'advlist autolink lists link image charmap print preview anchor',
            //             'searchreplace visualblocks code fullscreen',
            //             'insertdatetime media table paste code help wordcount'
            //         ],
            //         toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
            //     });
            // }
        });
    </script>
</x-app-layout>