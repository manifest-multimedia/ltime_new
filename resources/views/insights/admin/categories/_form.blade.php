<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="category_name">Category Name *</label>
        <input type="text" name="category_name" id="category_name" 
               value="{{ old('category_name', $category->translations->first()->category_name ?? '') }}"
               required
               class="form-control">
    </div>

    <div class="col-md-6 mb-4">
        <label for="slug">Slug *</label>
        <input type="text" name="slug" id="slug" 
               value="{{ old('slug', $category->translations->first()->slug ?? '') }}"
               required
               class="form-control">
        <small class="form-text text-muted">The URL-friendly version of the name. Auto-generated from the category name.</small>
    </div>
</div>

<div class="form-row">
    <div class="col-md-12 mb-4">
        <label for="category_description">Description</label>
        <textarea name="category_description" id="category_description" rows="3"
                  class="form-control">{{ old('category_description', $category->translations->first()->category_description ?? '') }}</textarea>
        <small class="form-text text-muted">A short description of what this category contains.</small>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="lang_id">Language *</label>
        <select name="lang_id" id="lang_id" required
                class="form-control">
            @foreach(\App\Models\Insights\Language::all() as $language)
                <option value="{{ $language->id }}" 
                        {{ old('lang_id', $category->translations->first()->lang_id ?? '') == $language->id ? 'selected' : '' }}>
                    {{ $language->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-4">
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" id="parent_id"
                class="form-control">
            <option value="">None (Top Level Category)</option>
            @foreach($categories ?? [] as $parentCategory)
                @if(!isset($category) || $parentCategory->id !== $category->id)
                    <option value="{{ $parentCategory->id }}"
                            {{ old('parent_id', $category->parent_id ?? '') == $parentCategory->id ? 'selected' : '' }}>
                        {{ $parentCategory->translations->first()->category_name }}
                    </option>
                @endif
            @endforeach
        </select>
        <small class="form-text text-muted">Optional. Select a parent category if this is a subcategory.</small>
    </div>
</div>

@push('page-scripts')
<script>
document.getElementById('category_name').addEventListener('blur', function() {
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
@endpush