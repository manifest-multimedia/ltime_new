<x-app-layout>
    <h2 class="h2 mb-4 mt-3 mx-3"
    style="padding-top:50px">
    {{ __('Create CMS Page') }}</h2>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Page Details</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cms-pages.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="slug" class="form-label">{{ __('Slug (URL)') }}</label>
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}">
                                <small class="text-muted">Leave blank to auto-generate from title</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_description" class="form-label">{{ __('Meta Description') }}</label>
                                <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                                <small class="text-muted">Brief description for SEO purposes</small>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="content" class="form-label">{{ __('Page Content') }}</label>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="10">{{ old('content') }}</textarea>
                                <small class="text-muted">Main content for simple pages. For complex layouts, use Sections instead.</small>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
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
                                            <option value="default" {{ old('layout') == 'default' ? 'selected' : '' }}>Default</option>
                                            <option value="full-width" {{ old('layout') == 'full-width' ? 'selected' : '' }}>Full Width</option>
                                            <option value="sidebar" {{ old('layout') == 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                        </select>
                                        @error('layout')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('cms-pages.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create Page') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            
            titleInput.addEventListener('blur', function() {
                if (slugInput.value === '') {
                    // Simple slug generator
                    const slug = titleInput.value
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')  // Remove special chars
                        .replace(/\s+/g, '-')      // Replace spaces with -
                        .replace(/--+/g, '-')      // Replace multiple - with single -
                        .trim();                   // Trim leading/trailing spaces
                    
                    slugInput.value = slug;
                }
            });

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
        });
    </script>
</x-app-layout>