<form action="{{ route('insights.search') }}" method="GET" class="w-full">
    <div class="flex">
        <div class="relative flex-1">
            <input type="text" 
                   name="q" 
                   value="{{ request('q') }}"
                   placeholder="Search insights..."
                   class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <button type="submit" 
                class="flex items-center justify-center px-4 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 hover:bg-gray-100">
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</form>