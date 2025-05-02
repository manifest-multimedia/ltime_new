<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Post Content</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->title : '') }}"
                           required
                           class="form-control">
                </div>
                
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" 
                           value="{{ old('slug', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->slug : '') }}"
                           required
                           class="form-control">
                    <small class="form-text text-muted">The URL-friendly version of the title</small>
                </div>

                <div class="form-group mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" 
                           value="{{ old('subtitle', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->subtitle : '') }}"
                           class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="3"
                              class="form-control">{{ old('short_description', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->short_description : '') }}</textarea>
                    <small class="form-text text-muted">Appears in listings and search results</small>
                </div>

                <div class="form-group mb-3">
                    <label for="post_body" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea name="post_body" id="post_body" rows="15" required
                              class="form-control">{{ old('post_body', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->post_body : '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Options</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="meta_desc" class="form-label">Meta Description</label>
                    <textarea name="meta_desc" id="meta_desc" rows="2"
                              class="form-control">{{ old('meta_desc', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->meta_desc : '') }}</textarea>
                    <small class="form-text text-muted">Appears in search engine results</small>
                </div>

                <div class="form-group mb-3">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" 
                           value="{{ old('seo_title', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->seo_title : '') }}"
                           class="form-control">
                    <small class="form-text text-muted">Custom title tag for SEO purposes</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Publishing Options</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" 
                               {{ old('is_published', isset($post) && $post->is_published ? 'checked' : '') }}>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                    <small class="form-text text-muted">Make this post visible to the public</small>
                </div>

                <div class="form-group mb-3">
                    <label for="posted_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" name="posted_at" id="posted_at" 
                           value="{{ old('posted_at', isset($post) && $post->posted_at ? $post->posted_at->format('Y-m-d\TH:i') : '') }}"
                           class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Featured Image</h5>
            </div>
            <div class="card-body">
                @if(isset($post->translations) && $post->translations->isNotEmpty() && !empty($post->translations->first()->image_medium))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $post->translations->first()->image_medium) }}"
                             alt="Current featured image"
                             class="img-fluid rounded">
                    </div>
                @endif
                <div class="form-group mb-3">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Categories & Language</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="lang_id" class="form-label">Language <span class="text-danger">*</span></label>
                    <select name="lang_id" id="lang_id" required
                            class="form-select">
                        @foreach(\App\Models\Insights\Language::all() as $language)
                            <option value="{{ $language->id }}" 
                                    {{ old('lang_id', isset($post->translations) && $post->translations->isNotEmpty() ? $post->translations->first()->lang_id : '') == $language->id ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select name="categories[]" id="categories" multiple
                            class="form-select" size="5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ (isset($post) && $post->categories->contains($category->id)) ? 'selected' : '' }}>
                                {{ $category->translations && $category->translations->isNotEmpty() ? $category->translations->first()->category_name : 'Unnamed category' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple categories</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('title').addEventListener('blur', function() {
    if (!document.getElementById('slug').value) {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9-]/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        document.getElementById('slug').value = slug;
    }
});
</script>
<script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#post_body',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        height: 400,
        branding: false
    });
</script>
@endpush