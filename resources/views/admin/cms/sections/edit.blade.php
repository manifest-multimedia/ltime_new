<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ __('Edit Section') }}: {{ $section->title ?: 'Section '.$section->id }}</h2>
            <a href="{{ route('cms-pages.edit', $section->cms_page_id) }}" class="btn btn-secondary">
                Back to Page
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Section settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Section Settings</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('sections.update', $section) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">{{ __('Section Title') }} (Optional)</label>
                                    <input id="title" class="form-control @error('title') is-invalid @enderror" 
                                           type="text" name="title" value="{{ old('title', $section->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="type" class="form-label">{{ __('Section Type') }}</label>
                                    <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                                        @foreach($sectionTypes as $value => $name)
                                            <option value="{{ $value }}" {{ old('type', $section->type) == $value ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="background_color" class="form-label">{{ __('Background Color') }} (Optional)</label>
                                    <input id="background_color" class="form-control @error('background_color') is-invalid @enderror" 
                                           type="text" name="background_color" value="{{ old('background_color', $section->background_color) }}" 
                                           placeholder="E.g. bg-light, bg-primary, #f8f9fa">
                                    <div class="form-text">Use Bootstrap background classes or hex values</div>
                                    @error('background_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="text_color" class="form-label">{{ __('Text Color') }} (Optional)</label>
                                    <input id="text_color" class="form-control @error('text_color') is-invalid @enderror" 
                                           type="text" name="text_color" value="{{ old('text_color', $section->text_color) }}" 
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
                                          name="settings" rows="4">{{ old('settings', is_array($section->settings) ? json_encode($section->settings, JSON_PRETTY_PRINT) : $section->settings) }}</textarea>
                                <div class="form-text">JSON format. Leave empty if not needed</div>
                                @error('settings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update Section') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Content Blocks -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Content Blocks</h5>
                        <a href="{{ route('sections.content-blocks.create', $section) }}" class="btn btn-primary btn-sm">
                            Add New Block
                        </a>
                    </div>
                    <div class="card-body">
                        @if($section->contentBlocks->count() > 0)
                            <div id="blocks-container" class="list-group mb-3">
                                @foreach($section->contentBlocks as $block)
                                    <div class="list-group-item section-item" data-id="{{ $block->id }}">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="cursor-move me-2 text-secondary" style="cursor: move;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-vertical" viewBox="0 0 16 16">
                                                        <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                </span>
                                                <h6 class="mb-0 fw-bold">
                                                    {{ $block->title ?: 'Block ' . ($loop->iteration) }}
                                                    <span class="ms-2 badge bg-secondary">{{ ucfirst($block->type) }}</span>
                                                </h6>
                                            </div>
                                            <div>
                                                <a href="{{ route('content-blocks.edit', $block) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <form method="POST" action="{{ route('content-blocks.destroy', $block) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this content block?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            @if($block->image)
                                                <div style="width: 60px; height: 60px;" class="position-relative">
                                                    <img src="{{ asset('storage/'.$block->image) }}" alt="{{ $block->title }}" class="img-fluid rounded w-100 h-100 object-fit-cover">
                                                </div>
                                            @endif
                                            
                                            <div class="flex-fill">
                                                @if($block->subtitle)
                                                    <p class="small text-muted mb-1">{{ $block->subtitle }}</p>
                                                @endif
                                                
                                                @if($block->content)
                                                    <p class="small text-truncate mb-1">{{ Str::limit(strip_tags($block->content), 100) }}</p>
                                                @endif
                                                
                                                @if($block->link_url)
                                                    <p class="small text-primary mb-0">
                                                        <span class="fw-medium">{{ $block->link_text ?: 'Link' }}:</span> {{ $block->link_url }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light text-center">
                                <p class="mb-0">No content blocks added yet. <a href="{{ route('sections.content-blocks.create', $section) }}">Add your first content block</a></p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Preview Section -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Section Preview</h5>
                    </div>
                    <div class="card-body">
                        <div class="bg-light p-4 rounded text-center">
                            <p class="mb-0">To see how this section looks, view the complete page: 
                                <a href="{{ url('/cms/' . $section->page->slug) }}" target="_blank" class="text-primary">View Page</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize sortable content blocks
        document.addEventListener('DOMContentLoaded', function() {
            const blocksContainer = document.getElementById('blocks-container');
            if (!blocksContainer) return;
            
            new Sortable(blocksContainer, {
                animation: 150,
                handle: '.cursor-move',
                onEnd: function(evt) {
                    const blocks = Array.from(document.querySelectorAll('.section-item')).map((el, index) => {
                        return { id: el.dataset.id, order: index * 10 };
                    });
                    
                    fetch('{{ route('content-blocks.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ blocks: blocks })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Content blocks reordered successfully');
                        }
                    }).catch(error => {
                        console.error('Error reordering content blocks:', error);
                    });
                }
            });
        });
    </script>
</x-app-layout>