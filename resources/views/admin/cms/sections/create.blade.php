<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Section to') }}: {{ $page->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('cms-pages.sections.store', $page) }}">
                        @csrf

                        <div class="mb-6">
                            <x-label for="type" value="{{ __('Section Type') }}" />
                            <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="type" required>
                                <option value="">Select a section type</option>
                                @foreach($sectionTypes as $value => $name)
                                    <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <span class="text-gray-500 text-sm">The section type determines the layout and appearance</span>
                            @error('type')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-label for="title" value="{{ __('Section Title') }} (Optional)" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" />
                            <span class="text-gray-500 text-sm">This may be displayed depending on the section type</span>
                            @error('title')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-label for="background_color" value="{{ __('Background Color') }} (Optional)" />
                                <x-input id="background_color" class="block mt-1 w-full" type="text" name="background_color" :value="old('background_color')" placeholder="E.g. gray-100, white, blue-50" />
                                <span class="text-gray-500 text-sm">Use Tailwind CSS color classes</span>
                                @error('background_color')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-label for="text_color" value="{{ __('Text Color') }} (Optional)" />
                                <x-input id="text_color" class="block mt-1 w-full" type="text" name="text_color" :value="old('text_color')" placeholder="E.g. #333333 or rgb(51,51,51)" />
                                @error('text_color')
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
                            <a href="{{ route('cms-pages.edit', $page) }}" class="text-gray-500 mr-4">Cancel</a>
                            <x-button>
                                {{ __('Create Section') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview color selections
        document.addEventListener('DOMContentLoaded', function() {
            const bgColorInput = document.getElementById('background_color');
            const textColorInput = document.getElementById('text_color');
            
            // Add preview functionality if needed
        });
    </script>
</x-app-layout>