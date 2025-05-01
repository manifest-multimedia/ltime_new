@extends('insights.layouts.app')

@section('title', $post->translations->first()->seo_title ?? $post->translations->first()->title)
@section('meta_desc', $post->translations->first()->meta_desc ?? $post->translations->first()->short_description)

@section('content')
    <article class="py-8 lg:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header & Feature Image -->
            <div class="max-w-5xl mx-auto mb-10">
                <header class="text-center mb-8">
                    @if($post->categories->count())
                        <div class="mb-4">
                            @foreach($post->categories as $category)
                                <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                   class="inline-block bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full mr-2 transition-colors hover:bg-gray-200">
                                    {{ $category->translations->first()->category_name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $post->translations->first()->title }}
                    </h1>

                    @if($post->translations->first()->subtitle)
                        <p class="text-xl text-gray-600 mb-4 max-w-4xl mx-auto">
                            {{ $post->translations->first()->subtitle }}
                        </p>
                    @endif

                    <div class="flex items-center justify-center text-sm text-gray-500 space-x-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $post->posted_at->format('F j, Y') }}
                        </div>
                        @if($post->user)
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $post->user->name }}
                            </div>
                        @endif
                    </div>
                </header>

                @if($post->translations->first()->image_large)
                    <div class="w-full aspect-w-16 aspect-h-9 mb-8 overflow-hidden rounded-lg shadow-lg">
                        <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_large/' . $post->translations->first()->image_large) }}"
                             alt="{{ $post->translations->first()->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div class="flex flex-col lg:flex-row max-w-6xl mx-auto">
                <!-- Main Content -->
                <div class="lg:w-2/3 lg:pr-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 md:p-8">
                            <div class="prose lg:prose-lg max-w-none">
                                {!! $post->translations->first()->post_body !!}
                            </div>

                            <!-- Social Share -->
                            <div class="mt-10 pt-6 border-t border-gray-100">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700 mr-4">Share this post:</span>
                                    <div class="flex space-x-2">
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->translations->first()->title) }}" 
                                           target="_blank" 
                                           class="text-gray-500 hover:text-blue-400 transition-colors">
                                            <span class="sr-only">Twitter</span>
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                            </svg>
                                        </a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                           target="_blank" 
                                           class="text-gray-500 hover:text-blue-600 transition-colors">
                                            <span class="sr-only">Facebook</span>
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                           target="_blank" 
                                           class="text-gray-500 hover:text-blue-700 transition-colors">
                                            <span class="sr-only">LinkedIn</span>
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M19.7,3H4.3C3.582,3,3,3.582,3,4.3v15.4C3,20.418,3.582,21,4.3,21h15.4c0.718,0,1.3-0.582,1.3-1.3V4.3 C21,3.582,20.418,3,19.7,3z M8.339,18.338H5.667v-8.59h2.672V18.338z M7.004,8.574c-0.857,0-1.549-0.694-1.549-1.548 c0-0.855,0.691-1.548,1.549-1.548c0.854,0,1.547,0.694,1.547,1.548C8.551,7.881,7.858,8.574,7.004,8.574z M18.339,18.338h-2.669 v-4.177c0-0.996-0.017-2.278-1.387-2.278c-1.389,0-1.601,1.086-1.601,2.206v4.249h-2.667v-8.59h2.559v1.174h0.037 c0.356-0.675,1.227-1.387,2.526-1.387c2.703,0,3.203,1.779,3.203,4.092V18.338z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(config('insights.comments.type_of_comments_to_show') === 'built_in')
                        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 md:p-8">
                                <h2 class="text-2xl font-bold mb-6">Comments</h2>

                                @if($post->comments->count())
                                    <div class="space-y-6">
                                        @foreach($post->comments as $comment)
                                            <div class="bg-gray-50 p-4 md:p-6 rounded-lg">
                                                <div class="flex items-start">
                                                    <div class="mr-4 flex-shrink-0">
                                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                                            <span class="font-medium text-lg">{{ substr($comment->author_name, 0, 1) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3 class="font-medium text-gray-900">
                                                            {{ $comment->author_name }}
                                                            @if($comment->author_website)
                                                                <a href="{{ $comment->author_website }}" 
                                                                target="_blank" 
                                                                class="text-blue-600 hover:text-blue-800 text-sm ml-2">
                                                                    (website)
                                                                </a>
                                                            @endif
                                                        </h3>
                                                        <div class="text-sm text-gray-500 mb-2">
                                                            {{ $comment->created_at->format('M j, Y \a\t g:i a') }}
                                                        </div>
                                                        <div class="text-gray-700">
                                                            {{ $comment->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                                        <p class="text-gray-600">No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endif

                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold mb-4">Leave a Comment</h3>
                                    <form action="{{ route('insights.comments.store', $post->translations->first()->slug) }}" method="POST" class="space-y-4">
                                        @csrf
                                        
                                        @guest
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="author_name" class="block text-sm font-medium text-gray-700">Name *</label>
                                                    <input type="text" name="author_name" id="author_name" required
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                @if(config('insights.comments.ask_for_author_email'))
                                                    <div>
                                                        <label for="author_email" class="block text-sm font-medium text-gray-700">
                                                            Email {{ config('insights.comments.require_author_email') ? '*' : '' }}
                                                        </label>
                                                        <input type="email" name="author_email" id="author_email" 
                                                            {{ config('insights.comments.require_author_email') ? 'required' : '' }}
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    </div>
                                                @endif
                                            </div>

                                            @if(config('insights.comments.ask_for_author_website'))
                                                <div>
                                                    <label for="author_website" class="block text-sm font-medium text-gray-700">Website</label>
                                                    <input type="url" name="author_website" id="author_website"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>
                                            @endif
                                        @endguest

                                        <div>
                                            <label for="comment" class="block text-sm font-medium text-gray-700">Comment *</label>
                                            <textarea name="comment" id="comment" rows="4" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                        </div>

                                        @if(config('insights.captcha.captcha_enabled'))
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    {{ config('insights.captcha.basic_question') }}
                                                </label>
                                                <input type="text" name="captcha" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            </div>
                                        @endif

                                        <button type="submit" 
                                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Submit Comment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Sidebar -->
                <div class="lg:w-1/3 mt-8 lg:mt-0">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-8">
                        <div class="p-6">
                            <!-- Author Bio -->
                            @if($post->user)
                                <div class="mb-8">
                                    <h3 class="text-lg font-semibold mb-3 border-b pb-2">About the Author</h3>
                                    <div class="flex items-center mb-4">
                                        <div class="mr-3 flex-shrink-0">
                                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                                <span class="font-bold text-lg">{{ substr($post->user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="font-medium">{{ $post->user->name }}</h4>
                                            <p class="text-sm text-gray-500">Real Estate Expert</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Categories -->
                            @if($post->categories->count())
                                <div class="mb-8">
                                    <h3 class="text-lg font-semibold mb-3 border-b pb-2">Categories</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($post->categories as $category)
                                            <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1.5 rounded-full mr-2 mb-2 transition-colors">
                                                {{ $category->translations->first()->category_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Related Posts -->
                            @php
                                $categoryIds = $post->categories->pluck('id');
                                $relatedPosts = \App\Models\Insights\Post::whereHas('categories', function($query) use ($categoryIds) {
                                    $query->whereIn('category_id', $categoryIds);
                                })
                                ->where('id', '!=', $post->id)
                                ->where('is_published', true)
                                ->where('posted_at', '<=', now())
                                ->with('translations')
                                ->orderBy('posted_at', 'desc')
                                ->limit(3)
                                ->get();
                            @endphp
                            
                            @if($relatedPosts->count())
                                <div>
                                    <h3 class="text-lg font-semibold mb-3 border-b pb-2">Related Posts</h3>
                                    <div class="space-y-4">
                                        @foreach($relatedPosts as $relatedPost)
                                            <div class="flex">
                                                @if($relatedPost->translations->first()->image_thumbnail)
                                                    <a href="{{ route('insights.show', $relatedPost->translations->first()->slug) }}" class="flex-shrink-0 mr-3">
                                                        <div class="w-16 h-16 rounded overflow-hidden">
                                                            <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_thumbnail/' . $relatedPost->translations->first()->image_thumbnail) }}"
                                                                alt="{{ $relatedPost->translations->first()->title }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    </a>
                                                @endif
                                                <div>
                                                    <h4 class="font-medium text-sm">
                                                        <a href="{{ route('insights.show', $relatedPost->translations->first()->slug) }}" 
                                                           class="text-gray-900 hover:text-blue-600">
                                                            {{ $relatedPost->translations->first()->title }}
                                                        </a>
                                                    </h4>
                                                    <span class="text-xs text-gray-500">{{ $relatedPost->posted_at->format('M j, Y') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection