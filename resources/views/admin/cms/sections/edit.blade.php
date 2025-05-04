<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Section') }}: {{ $section->title ?: 'Section '.$section->id }}
            </h2>
            <div>
                <a href="{{ route('cms-pages.edit', $section->cms_page_id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Page
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Section settings -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Section Settings</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('sections.update', $section) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="title" value="{{ __('Section Title') }} (Optional)" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $section->title)" />
                                @error('title')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <x-label for="type" value="{{ __('Section Type') }}" />
                                <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="type" required>
                                    @foreach($sectionTypes as $value => $name)
                                        <option value="{{ $value }}" {{ old('type', $section->type) == $value ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <x-label for="background_color" value="{{ __('Background Color') }} (Optional)" />
                                <x-input id="background_color" class="block mt-1 w-full" type="text" name="background_color" :value="old('background_color', $section->background_color)" placeholder="E.g. gray-100, white, blue-50" />
                                <span class="text-gray-500 text-sm">Use Tailwind CSS color classes</span>
                                @error('background_color')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <x-label for="text_color" value="{{ __('Text Color') }} (Optional)" />
                                <x-input id="text_color" class="block mt-1 w-full" type="text" name="text_color" :value="old('text_color', $section->text_color)" placeholder="E.g. #333333 or rgb(51,51,51)" />
                                @error('text_color')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="settings" value="{{ __('Additional Settings') }} (Optional)" />
                            <textarea id="settings" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm font-mono" name="settings" rows="4">{{ old('settings', is_array($section->settings) ? json_encode($section->settings, JSON_PRETTY_PRINT) : $section->settings) }}</textarea>
                            <span class="text-gray-500 text-sm">JSON format. Leave empty if not needed</span>
                            @error('settings')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <x-button>
                                {{ __('Update Section') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Content Blocks -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Content Blocks</h3>
                        <a href="{{ route('sections.content-blocks.create', $section) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add New Block
                        </a>
                    </div>
                    
                    @if($section->contentBlocks->count() > 0)
                        <div id="blocks-container" class="space-y-4">
                            @foreach($section->contentBlocks as $block)
                                <div class="border rounded-lg p-4 block-item bg-gray-50" data-id="{{ $block->id }}">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <span class="cursor-move mr-2 text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            <h4 class="text-md font-semibold">
                                                {{ $block->title ?: 'Block ' . ($loop->iteration) }}
                                                <span class="ml-2 text-sm text-gray-500">({{ ucfirst($block->type) }})</span>
                                            </h4>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('content-blocks.edit', $block) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form method="POST" action="{{ route('content-blocks.destroy', $block) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this content block?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-wrap gap-4 mt-2">
                                        @if($block->image)
                                            <div class="w-16 h-16 relative">
                                                <img src="{{ asset('storage/'.$block->image) }}" alt="{{ $block->title }}" class="object-cover w-full h-full rounded">
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            @if($block->subtitle)
                                                <p class="text-sm text-gray-500">{{ $block->subtitle }}</p>
                                            @endif
                                            
                                            @if($block->content)
                                                <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit(strip_tags($block->content), 100) }}</p>
                                            @endif
                                            
                                            @if($block->link_url)
                                                <p class="text-sm text-blue-600 mt-1">
                                                    <span class="font-medium">{{ $block->link_text ?: 'Link' }}:</span> {{ $block->link_url }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 text-center rounded-lg">
                            <p class="text-gray-500">No content blocks added yet. <a href="{{ route('sections.content-blocks.create', $section) }}" class="text-indigo-600 hover:text-indigo-900">Add your first content block</a></p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Preview Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Section Preview</h3>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-500 text-center">To see how this section looks, view the complete page: <a href="{{ url('/cms/' . $section->page->slug) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View Page</a></p>
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
                    const blocks = Array.from(document.querySelectorAll('.block-item')).map((el, index) => {
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