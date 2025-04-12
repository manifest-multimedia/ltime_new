@extends('insights.layouts.app')

@section('title', $category->translations->first()->category_name . ' - Insights')
@section('meta_desc', $category->translations->first()->category_description)

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <header class="mb-8">
                        <h1 class="text-3xl font-bold mb-2">{{ $category->translations->first()->category_name }}</h1>
                        @if($category->translations->first()->category_description)
                            <p class="text-gray-600">{{ $category->translations->first()->category_description }}</p>
                        @endif
                    </header>

                    @if($posts->count())
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($posts as $post)
                                <article class="bg-white rounded-lg shadow overflow-hidden">
                                    @if($post->translations->first()->image_medium)
                                        <div class="aspect-w-16 aspect-h-9">
                                            <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_medium/' . $post->translations->first()->image_medium) }}"
                                                 alt="{{ $post->translations->first()->title }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        <h2 class="text-xl font-semibold mb-2">
                                            <a href="{{ route('insights.show', $post->translations->first()->slug) }}"
                                               class="text-gray-900 hover:text-gray-600">
                                                {{ $post->translations->first()->title }}
                                            </a>
                                        </h2>

                                        @if($post->translations->first()->short_description)
                                            <p class="text-gray-600 mb-4">
                                                {{ Str::limit($post->translations->first()->short_description, 150) }}
                                            </p>
                                        @endif

                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <div>
                                                {{ $post->posted_at->format('M j, Y') }}
                                            </div>
                                            <a href="{{ route('insights.show', $post->translations->first()->slug) }}"
                                               class="text-blue-600 hover:text-blue-800 font-medium">
                                                Read More →
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">No posts found in this category.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection