@extends('insights.layouts.app')

@section('title', 'Insights')
@section('meta_desc', 'Latest insights and articles about real estate')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Featured Post Section -->
            @if($posts->count() > 0)
                @php
                    $featuredPost = $posts->first();
                    $featuredTranslation = $featuredPost->translations->first();
                @endphp
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                    <div class="md:flex">
                        @if($featuredTranslation && $featuredTranslation->image_large)
                            <div class="md:w-1/2">
                                <div class="h-full aspect-w-16 aspect-h-9">
                                    <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_large/' . $featuredTranslation->image_large) }}"
                                         alt="{{ $featuredTranslation->title }}"
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif
                        <div class="p-8 md:w-1/2 flex flex-col justify-center">
                            <div class="mb-2">
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-50 last:mr-0 mr-1">
                                    Featured
                                </span>
                                @if($featuredPost->categories->count())
                                    @foreach($featuredPost->categories->take(2) as $category)
                                        @if($category->translations->isNotEmpty() && $category->translations->first()->slug)
                                        <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                           class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-50 last:mr-0 mr-1">
                                            {{ $category->translations->first()->category_name ?? 'Category' }}
                                        </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @if($featuredTranslation)
                            <h1 class="text-3xl font-bold mb-4">
                                <a href="{{ route('insights.show', $featuredTranslation->slug) }}"
                                   class="text-gray-900 hover:text-blue-600">
                                    {{ $featuredTranslation->title }}
                                </a>
                            </h1>
                            @if($featuredTranslation->short_description)
                                <p class="text-lg text-gray-600 mb-6">
                                    {{ Str::limit($featuredTranslation->short_description, 200) }}
                                </p>
                            @endif
                            @endif
                            <div class="mt-auto flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    {{ $featuredPost->posted_at->format('F j, Y') }}
                                </div>
                                @if($featuredTranslation)
                                <a href="{{ route('insights.show', $featuredTranslation->slug) }}"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Read More
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold">Latest Insights</h2>
                        @if(count($posts) > 0)
                            <form action="{{ route('insights.search') }}" method="GET" class="flex">
                                <input type="text" name="q" placeholder="Search insights..." class="px-4 py-2 border rounded-l-md focus:ring-blue-500 focus:border-blue-500">
                                <button type="submit" class="bg-gray-100 px-4 py-2 border border-l-0 rounded-r-md hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(count($posts) > 1)
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($posts->skip(1) as $post)
                                @php $translation = $post->translations->first(); @endphp
                                @if($translation)
                                <article class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                    @if($translation->image_medium)
                                        <a href="{{ route('insights.show', $translation->slug) }}" class="block">
                                            <div class="aspect-w-16 aspect-h-9">
                                                <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $translation->image_medium) }}"
                                                    alt="{{ $translation->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                            </div>
                                        </a>
                                    @endif

                                    <div class="p-6">
                                        @if($post->categories->count())
                                            <div class="mb-3">
                                                @foreach($post->categories->take(3) as $category)
                                                    @if($category->translations->isNotEmpty() && $category->translations->first()->slug)
                                                    <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                                    class="inline-block bg-gray-50 text-gray-600 text-xs px-2 py-1 rounded-full mr-2 mb-2 hover:bg-gray-100">
                                                        {{ $category->translations->first()->category_name ?? 'Category' }}
                                                    </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <h3 class="text-xl font-semibold mb-3">
                                            <a href="{{ route('insights.show', $translation->slug) }}"
                                            class="text-gray-900 hover:text-blue-600">
                                                {{ $translation->title }}
                                            </a>
                                        </h3>

                                        @if($translation->short_description)
                                            <p class="text-gray-600 mb-4 text-sm">
                                                {{ Str::limit($translation->short_description, 120) }}
                                            </p>
                                        @endif

                                        <div class="flex items-center justify-between text-sm">
                                            <div class="text-gray-500">
                                                {{ $post->posted_at->format('M j, Y') }}
                                            </div>
                                            <a href="{{ route('insights.show', $translation->slug) }}"
                                            class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                                Read More
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                                @else
                                <!-- Skip posts without translations -->
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-10">
                            {{ $posts->links() }}
                        </div>
                    @elseif(count($posts) <= 1)
                        <div class="text-center py-12">
                            <p class="text-gray-500">No additional posts available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection