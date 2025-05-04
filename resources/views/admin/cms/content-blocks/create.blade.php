<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Content Block to Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.sections.content-blocks.store', $section) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <x-label for="type" value="{{ __('Block Type') }}" />
                            <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="type" required>
                                <option value="">Select a block type</option>
                                @foreach($blockTypes as $value => $name)
                                    <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <span class="text-gray-500 text-sm">The block type determines the available fields and appearance</span>
                            @error('type')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="title" value="{{ __('Title') }} (Optional)" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" />
                            @error('title')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="subtitle" value="{{ __('Subtitle') }} (Optional)" />
                            <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle')" />
                            @error('subtitle')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="content" value="{{ __('Content') }} (Optional)" />
                            <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="content" rows="5">{{ old('content') }}</textarea>
                            <span class="text-gray-500 text-sm">Can contain HTML for formatting</span>
                            @error('content')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="image" value="{{ __('Image') }} (Optional)" />
                            <input id="image" type="file" name="image" class="mt-1 block w-full" accept="image/*" />
                            <span class="text-gray-500 text-sm">Maximum size: 2MB</span>
                            @error('image')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-label for="link_text" value="{{ __('Link Text') }} (Optional)" />
                                <x-input id="link_text" class="block mt-1 w-full" type="text" name="link_text" :value="old('link_text')" placeholder="E.g. Learn More, Read More" />
                                @error('link_text')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-label for="link_url" value="{{ __('Link URL') }} (Optional)" />
                                <x-input id="link_url" class="block mt-1 w-full" type="text" name="link_url" :value="old('link_url')" placeholder="E.g. /contact, https://example.com" />
                                @error('link_url')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <x-label for="settings" value="{{ __('Additional Settings') }} (Optional)" />
                            <textarea id="settings" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm font-mono" name="settings" rows="4" placeholder="{&#10;  &quot;key&quot;: &quot;value&quot;&#10;}">{{ old('settings') }}</textarea>
                            <span class="text-gray-500 text-sm">JSON format. Leave empty if not needed</span>
                            @error('settings')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.sections.edit', $section) }}" class="text-gray-500 mr-4">Cancel</a>
                            <x-button>
                                {{ __('Create Content Block') }}
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
                
                // Example: Show/hide fields based on the selected block type
                // if (blockType === 'text') {
                //     document.getElementById('content').closest('.mb-6').style.display = 'block';
                //     document.getElementById('image').closest('.mb-6').style.display = 'none';
                // } else if (blockType === 'image') {
                //     document.getElementById('content').closest('.mb-6').style.display = 'none';
                //     document.getElementById('image').closest('.mb-6').style.display = 'block';
                // }
            });
            
            // Trigger change event to set initial state
            typeSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>