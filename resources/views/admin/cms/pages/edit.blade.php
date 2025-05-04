<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h2 class="h2">{{ __('Edit Page') }}: {{ $cmsPage->title }}</h2>
        <div>
            <a href="{{ url('/cms/' . $cmsPage->slug . ($cmsPage->status !== 'published' ? '?preview=1' : '')) }}" target="_blank" class="btn btn-secondary">
                View Page
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Page settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Page Settings</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('cms-pages.update', $cmsPage) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">{{ __('Title') }}</label>
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $cmsPage->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">{{ __('Slug (URL)') }}</label>
                                        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $cmsPage->slug) }}" required>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="meta_description" class="form-label">{{ __('Meta Description') }}</label>
                                        <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="3">{{ old('meta_description', $cmsPage->meta_description) }}</textarea>
                                        <small class="text-muted">Brief description for SEO purposes (recommended: 150-160 characters)</small>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="content" class="form-label">{{ __('Page Content') }}</label>
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="10">{{ old('content', $cmsPage->content) }}</textarea>
                                        <small class="text-muted">Main content for simple pages. For complex layouts, use Sections instead.</small>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="draft" {{ old('status', $cmsPage->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status', $cmsPage->status) == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ old('status', $cmsPage->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="layout" class="form-label">{{ __('Page Layout') }}</label>
                                        <select id="layout" class="form-select @error('layout') is-invalid @enderror" name="layout">
                                            <option value="default" {{ old('layout', $cmsPage->layout) == 'default' ? 'selected' : '' }}>Default</option>
                                            <option value="full-width" {{ old('layout', $cmsPage->layout) == 'full-width' ? 'selected' : '' }}>Full Width</option>
                                            <option value="sidebar" {{ old('layout', $cmsPage->layout) == 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                        </select>
                                        @error('layout')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('cms-pages.index') }}" class="btn btn-secondary me-2">Back to Pages</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update Page Settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Page sections -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Page Sections</h5>
                        <a href="{{ route('cms-pages.sections.create', $cmsPage) }}" class="btn btn-primary btn-sm">
                            Add New Section
                        </a>
                    </div>
                    <div class="card-body">
                        @if($cmsPage->sections->count() > 0)
                            <div id="sections-container" class="list-group mb-3">
                                @foreach($cmsPage->sections as $section)
                                    <div class="list-group-item section-item" data-id="{{ $section->id }}">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="cursor-move me-2 text-secondary" style="cursor: move;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-vertical" viewBox="0 0 16 16">
                                                        <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                </span>
                                                <h6 class="mb-0 fw-bold">
                                                    {{ $section->title ?: 'Section ' . ($loop->iteration) }}
                                                    <span class="ms-2 badge bg-secondary">{{ ucfirst($section->type) }}</span>
                                                </h6>
                                            </div>
                                            <div>
                                                <a href="{{ route('sections.edit', $section) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <form method="POST" action="{{ route('sections.destroy', $section) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this section?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <small class="text-muted">
                                            {{ $section->contentBlocks->count() }} content blocks
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light text-center">
                                <p class="mb-0">No sections added yet. <a href="{{ route('cms-pages.sections.create', $cmsPage) }}">Add your first section</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        // Initialize sortable sections and TinyMCE
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize TinyMCE
            tinymce.init({
                selector: '#content',
                height: 400,
                menubar: true,
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                relative_urls: false,
                remove_script_host: false,
                document_base_url: '{{ url('/') }}/'
            });
            
            const sectionsContainer = document.getElementById('sections-container');
            if (!sectionsContainer) return;
            
            new Sortable(sectionsContainer, {
                animation: 150,
                handle: '.cursor-move',
                onEnd: function(evt) {
                    const sections = Array.from(document.querySelectorAll('.section-item')).map((el, index) => {
                        return { id: el.dataset.id, order: index * 10 };
                    });
                    
                    fetch('{{ route('sections.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ sections: sections })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Sections reordered successfully');
                        }
                    }).catch(error => {
                        console.error('Error reordering sections:', error);
                    });
                }
            });
        });
    </script>
</x-app-layout>