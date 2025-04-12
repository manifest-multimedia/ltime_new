// Simple JavaScript for handling image uploads and providing a better editing experience
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title if slug is empty
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    if (titleInput && slugInput) {
        titleInput.addEventListener('blur', function() {
            if (!slugInput.value) {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9-]/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
            }
        });
    }

    // Image preview when uploading
    const imageInput = document.getElementById('image');
    const imagePreview = document.createElement('div');
    
    if (imageInput) {
        imageInput.after(imagePreview);
        
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <div class="mt-2">
                            <img src="${e.target.result}" alt="Preview" class="max-w-xs rounded-lg">
                        </div>
                    `;
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '';
            }
        });
    }

    // Confirm deletes
    document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm(this.dataset.confirm || 'Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

    // Initialize text editor if available
    if (typeof tinymce !== 'undefined' && document.getElementById('post_body')) {
        tinymce.init({
            selector: '#post_body',
            plugins: 'advlist autolink lists link image charmap preview anchor',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            height: 400
        });
    }
});