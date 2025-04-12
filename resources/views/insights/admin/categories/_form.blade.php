<div class="space-y-6">
    <div>
        <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name *</label>
        <input type="text" name="category_name" id="category_name" 
               value="{{ old('category_name', $category->translations->first()->category_name ?? '') }}"
               required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
        <input type="text" name="slug" id="slug" 
               value="{{ old('slug', $category->translations->first()->slug ?? '') }}"
               required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div>
        <label for="category_description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="category_description" id="category_description" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('category_description', $category->translations->first()->category_description ?? '') }}</textarea>
    </div>

    <div>
        <label for="lang_id" class="block text-sm font-medium text-gray-700">Language *</label>
        <select name="lang_id" id="lang_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @foreach(\BinshopsBlog\Models\BinshopsLanguage::all() as $language)
                <option value="{{ $language->id }}" 
                        {{ old('lang_id', $category->translations->first()->lang_id ?? '') == $language->id ? 'selected' : '' }}>
                    {{ $language->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category</label>
        <select name="parent_id" id="parent_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
    </div>
</div>

@push('scripts')
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