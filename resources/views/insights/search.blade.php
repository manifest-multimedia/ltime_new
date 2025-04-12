@extends('insights.layouts.app')

@section('title', 'Search Results for "' . $query . '" - Insights')
@section('meta_desc', 'Search results for "' . $query . '" in our insights and articles')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <header class="mb-8">
                        <h1 class="text-3xl font-bold mb-2">Search Results</h1>
                        <p class="text-gray-600">Found {{ $posts->total() }} results for "{{ $query }}"</p>
                    </header>

                    @if($posts->count())
                        <div class="space-y-8">
                            @foreach($posts as $post)
                                <article class="border-b pb-8 last:border-b-0 last:pb-0">
                                    <div class="md:flex md:items-start">
                                        @if($post->translations->first()->image_medium)
                                            <div class="md:w-1/3 md:flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                                <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $post->translations->first()->image_medium) }}"
                                                     alt="{{ $post->translations->first()->title }}"
                                                     class="w-full h-48 object-cover rounded-lg">
                                            </div>
                                        @endif

                                        <div class="md:flex-1">
                                            @if($post->categories->count())
                                                <div class="mb-2">
                                                    @foreach($post->categories as $category)
                                                        <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                                           class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full mr-2">
                                                            {{ $category->translations->first()->category_name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <h2 class="text-2xl font-semibold mb-2">
                                                <a href="{{ route('insights.show', $post->translations->first()->slug) }}"
                                                   class="text-gray-900 hover:text-gray-600">
                                                    {{ $post->translations->first()->title }}
                                                </a>
                                            </h2>

                                            @if($post->translations->first()->short_description)
                                                <p class="text-gray-600 mb-4">
                                                    {{ $post->translations->first()->short_description }}
                                                </p>
                                            @endif

                                            <div class="flex items-center justify-between text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <span>{{ $post->posted_at->format('M j, Y') }}</span>
                                                    @if($post->user)
                                                        <span class="mx-2">•</span>
                                                        <span>By {{ $post->user->name }}</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('insights.show', $post->translations->first()->slug) }}"
                                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                                    Read More →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $posts->appends(['q' => $query])->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">No posts found matching your search query.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection