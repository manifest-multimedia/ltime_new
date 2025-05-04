<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Content Block') }}: {{ $contentBlock->title ?: 'Block '.$contentBlock->id }}
            </h2>
            <div>
                <a href="{{ route('admin.sections.edit', $contentBlock->section) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Section
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.content-blocks.update', $contentBlock) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-label for="type" value="{{ __('Block Type') }}" />
                            <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="type" required>
                                @foreach($blockTypes as $value => $name)
                                    <option value="{{ $value }}" {{ old('type', $contentBlock->type) == $value ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="title" value="{{ __('Title') }} (Optional)" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $contentBlock->title)" />
                            @error('title')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="subtitle" value="{{ __('Subtitle') }} (Optional)" />
                            <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle', $contentBlock->subtitle)" />
                            @error('subtitle')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="content" value="{{ __('Content') }} (Optional)" />
                            <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="content" rows="5">{{ old('content', $contentBlock->content) }}</textarea>
                            <span class="text-gray-500 text-sm">Can contain HTML for formatting</span>
                            @error('content')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="image" value="{{ __('Image') }} (Optional)" />
                            
                            @if($contentBlock->image)
                                <div class="mb-2">
                                    <p class="text-sm text-gray-600 mb-1">Current image:</p>
                                    <img src="{{ asset('storage/' . $contentBlock->image) }}" alt="{{ $contentBlock->title }}" class="max-w-xs h-auto rounded">
                                </div>
                            @endif
                            
                            <input id="image" type="file" name="image" class="mt-1 block w-full" accept="image/*" />
                            <span class="text-gray-500 text-sm">Maximum size: 2MB. Leave empty to keep current image.</span>
                            @error('image')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-label for="link_text" value="{{ __('Link Text') }} (Optional)" />
                                <x-input id="link_text" class="block mt-1 w-full" type="text" name="link_text" :value="old('link_text', $contentBlock->link_text)" />
                                @error('link_text')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-label for="link_url" value="{{ __('Link URL') }} (Optional)" />
                                <x-input id="link_url" class="block mt-1 w-full" type="text" name="link_url" :value="old('link_url', $contentBlock->link_url)" />
                                @error('link_url')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <x-label for="settings" value="{{ __('Additional Settings') }} (Optional)" />
                            <textarea id="settings" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm font-mono" name="settings" rows="4">{{ old('settings', is_array($contentBlock->settings) ? json_encode($contentBlock->settings, JSON_PRETTY_PRINT) : $contentBlock->settings) }}</textarea>
                            <span class="text-gray-500 text-sm">JSON format. Leave empty if not needed</span>
                            @error('settings')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.sections.edit', $contentBlock->section) }}" class="text-gray-500 mr-4">Cancel</a>
                            <x-button>
                                {{ __('Update Content Block') }}
                            </x-button>
                        </div>
                    </form>
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
                // Add dynamic behavior if needed
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