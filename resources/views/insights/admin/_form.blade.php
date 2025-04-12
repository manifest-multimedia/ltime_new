<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $post->translations->first()->title ?? '') }}"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
            <input type="text" name="slug" id="slug" 
                   value="{{ old('slug', $post->translations->first()->slug ?? '') }}"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" 
                   value="{{ old('subtitle', $post->translations->first()->subtitle ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
            <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
            <textarea name="short_description" id="short_description" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('short_description', $post->translations->first()->short_description ?? '') }}</textarea>
        </div>

        <div>
            <label for="post_body" class="block text-sm font-medium text-gray-700">Content *</label>
            <textarea name="post_body" id="post_body" rows="20" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('post_body', $post->translations->first()->post_body ?? '') }}</textarea>
        </div>

        <div>
            <label for="meta_desc" class="block text-sm font-medium text-gray-700">Meta Description</label>
            <textarea name="meta_desc" id="meta_desc" rows="2"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('meta_desc', $post->translations->first()->meta_desc ?? '') }}</textarea>
        </div>

        <div>
            <label for="seo_title" class="block text-sm font-medium text-gray-700">SEO Title</label>
            <input type="text" name="seo_title" id="seo_title" 
                   value="{{ old('seo_title', $post->translations->first()->seo_title ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
    </div>

    <div class="space-y-6">
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
            @if(isset($post) && $post->translations->first()->image_medium)
                <div class="mt-2 mb-4">
                    <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $post->translations->first()->image_medium) }}"
                         alt="Current featured image"
                         class="w-full rounded-lg">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*"
                   class="mt-1 block w-full">
        </div>

        <div>
            <label for="lang_id" class="block text-sm font-medium text-gray-700">Language *</label>
            <select name="lang_id" id="lang_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach(\BinshopsBlog\Models\BinshopsLanguage::all() as $language)
                    <option value="{{ $language->id }}" 
                            {{ old('lang_id', $post->translations->first()->lang_id ?? '') == $language->id ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
            <select name="categories[]" id="categories" multiple
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ (isset($post) && $post->categories->contains($category->id)) ? 'selected' : '' }}>
                        {{ $category->translations->first()->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="posted_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
            <input type="datetime-local" name="posted_at" id="posted_at" 
                   value="{{ old('posted_at', isset($post) && $post->posted_at ? $post->posted_at->format('Y-m-d\TH:i') : '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="relative flex items-start">
            <div class="flex h-5 items-center">
                <input type="checkbox" name="is_published" id="is_published"
                       {{ old('is_published', isset($post) && $post->is_published ? 'checked' : '') }}
                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            </div>
            <div class="ml-3 text-sm">
                <label for="is_published" class="font-medium text-gray-700">Published</label>
                <p class="text-gray-500">Make this post visible to the public</p>
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
        height: 500,
        branding: false
    });
</script>
@endpush