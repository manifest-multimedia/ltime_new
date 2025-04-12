@extends('insights.layouts.app')

@section('title', $post->translations->first()->seo_title ?? $post->translations->first()->title)
@section('meta_desc', $post->translations->first()->meta_desc ?? $post->translations->first()->short_description)

@section('content')
    <article class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if($post->translations->first()->image_large)
                        <div class="w-full aspect-w-16 aspect-h-9 mb-8">
                            <img src="{{ asset('storage/' . config('insights.blog_upload_dir') . '/image_large/' . $post->translations->first()->image_large) }}"
                                 alt="{{ $post->translations->first()->title }}"
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endif

                    <header class="mb-8">
                        @if($post->categories->count())
                            <div class="mb-4">
                                @foreach($post->categories as $category)
                                    <a href="{{ route('insights.category', $category->translations->first()->slug) }}"
                                       class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full mr-2">
                                        {{ $category->translations->first()->category_name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ $post->translations->first()->title }}
                        </h1>

                        @if($post->translations->first()->subtitle)
                            <p class="text-xl text-gray-600 mb-4">
                                {{ $post->translations->first()->subtitle }}
                            </p>
                        @endif

                        <div class="flex items-center text-sm text-gray-500">
                            <div>
                                {{ $post->posted_at->format('F j, Y') }}
                            </div>
                            @if($post->user)
                                <span class="mx-2">•</span>
                                <div>
                                    By {{ $post->user->name }}
                                </div>
                            @endif
                        </div>
                    </header>

                    <div class="prose max-w-none">
                        {!! $post->translations->first()->post_body !!}
                    </div>

                    @if(config('insights.comments.type_of_comments_to_show') === 'built_in')
                        <div class="mt-12 pt-8 border-t">
                            <h2 class="text-2xl font-bold mb-6">Comments</h2>

                            @if($post->comments->count())
                                <div class="space-y-6">
                                    @foreach($post->comments as $comment)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-start">
                                                <div class="flex-1">
                                                    <h3 class="font-medium">
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
                            @endif

                            <div class="mt-8">
                                <h3 class="text-xl font-semibold mb-4">Leave a Comment</h3>
                                <form action="{{ route('insights.comments.store', $post->translations->first()->slug) }}" method="POST">
                                    @csrf
                                    
                                    @guest
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
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
                                            <div class="mb-4">
                                                <label for="author_website" class="block text-sm font-medium text-gray-700">Website</label>
                                                <input type="url" name="author_website" id="author_website"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            </div>
                                        @endif
                                    @endguest

                                    <div class="mb-4">
                                        <label for="comment" class="block text-sm font-medium text-gray-700">Comment *</label>
                                        <textarea name="comment" id="comment" rows="4" required
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                    </div>

                                    @if(config('insights.captcha.captcha_enabled'))
                                        <div class="mb-4">
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
                    @endif
                </div>
            </div>
        </div>
    </article>
@endsection