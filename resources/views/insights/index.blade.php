@extends('insights.layouts.app')

@section('title', 'Insights')
@section('meta_desc', 'Latest insights and articles about real estate')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-8">Latest Insights</h1>

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
                                    @if($post->categories->count())
                                        <div class="mb-2">
                                            @foreach($post->categories as $category)
                                                <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                                   class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full mr-2 mb-2">
                                                    {{ $category->translations->first()->category_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

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
                </div>
            </div>
        </div>
    </div>
@endsection