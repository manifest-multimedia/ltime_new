@extends('insights.layouts.app')

@section('title', $category->translations->first()->category_name . ' - Insights')
@section('meta_desc', $category->translations->first()->category_description ?? 'Posts in the ' . $category->translations->first()->category_name . ' category')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Header -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8 md:p-12 text-center">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                        {{ $category->translations->first()->category_name }}
                    </h1>
                    
                    @if($category->translations->first()->category_description)
                        <div class="max-w-3xl mx-auto">
                            <p class="text-lg text-gray-600">
                                {{ $category->translations->first()->category_description }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            @if(count($posts) > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 md:p-8">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($posts as $post)
                                <article class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                    @if($post->translations->first()->image_medium)
                                        <a href="{{ route('insights.show', $post->translations->first()->slug) }}" class="block">
                                            <div class="aspect-w-16 aspect-h-9">
                                                <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $post->translations->first()->image_medium) }}"
                                                    alt="{{ $post->translations->first()->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                            </div>
                                        </a>
                                    @endif
                                    
                                    <div class="p-6">
                                        <div class="mb-3">
                                            @foreach($post->categories->take(3) as $postCategory)
                                                <a href="{{ route('insights.category', $postCategory->translations->first()->slug) }}"
                                                class="inline-block bg-gray-50 text-gray-600 text-xs px-2 py-1 rounded-full mr-2 mb-2 hover:bg-gray-100 
                                                    {{ $postCategory->id === $category->id ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                                    {{ $postCategory->translations->first()->category_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                        
                                        <h3 class="text-xl font-semibold mb-3">
                                            <a href="{{ route('insights.show', $post->translations->first()->slug) }}" 
                                            class="text-gray-900 hover:text-blue-600">
                                                {{ $post->translations->first()->title }}
                                            </a>
                                        </h3>
                                        
                                        @if($post->translations->first()->short_description)
                                            <p class="text-gray-600 mb-4 text-sm">
                                                {{ Str::limit($post->translations->first()->short_description, 120) }}
                                            </p>
                                        @endif
                                        
                                        <div class="flex items-center justify-between text-sm">
                                            <div class="text-gray-500">
                                                {{ $post->posted_at->format('M j, Y') }}
                                            </div>
                                            <a href="{{ route('insights.show', $post->translations->first()->slug) }}"
                                            class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                                Read More
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        
                        <div class="mt-10">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-8 text-center">
                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-lg">No posts found in this category.</p>
                            <p class="mt-2">Check back later for new content or explore other categories.</p>
                            <div class="mt-6">
                                <a href="{{ route('insights.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Back to Insights
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Other Categories Section -->
            @php
                $otherCategories = \App\Models\Insights\Category::with('translations')
                    ->where('id', '!=', $category->id)
                    ->whereHas('posts', function($query) {
                        $query->where('is_published', true)
                            ->where('posted_at', '<=', now());
                    })
                    ->limit(10)
                    ->get();
            @endphp
            
            @if($otherCategories->count() > 0)
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Explore Other Categories</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($otherCategories as $otherCategory)
                                <a href="{{ route('insights.category', $otherCategory->translations->first()->slug) }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                                    {{ $otherCategory->translations->first()->category_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection