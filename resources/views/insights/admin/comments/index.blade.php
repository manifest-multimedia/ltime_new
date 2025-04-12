@extends('insights.admin.layouts.app')

@section('title', 'Manage Comments')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold">Manage Comments</h1>
                    </div>

                    @if($comments->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    {{ Str::limit($comment->comment, 100) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm">
                                                    <a href="{{ route('insights.show', $comment->post->translations->first()->slug) }}"
                                                       class="text-blue-600 hover:text-blue-900"
                                                       target="_blank">
                                                        {{ Str::limit($comment->post->translations->first()->title, 50) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm">
                                                    @if($comment->user)
                                                        <span class="font-medium">{{ $comment->user->name }}</span>
                                                    @else
                                                        <span>{{ $comment->author_name }}</span>
                                                        @if($comment->author_email)
                                                            <div class="text-gray-500 text-xs">{{ $comment->author_email }}</div>
                                                        @endif
                                                    @endif
                                                    @if($comment->author_website)
                                                        <div class="text-xs">
                                                            <a href="{{ $comment->author_website }}" 
                                                               class="text-blue-600 hover:text-blue-900"
                                                               target="_blank">
                                                                Website
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($comment->approved)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $comment->created_at->format('M j, Y g:i A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-3">
                                                    @if(!$comment->approved)
                                                        <form action="{{ route('insights.admin.comments.approve', $comment->id) }}" 
                                                              method="POST" 
                                                              class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                                Approve
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('insights.admin.comments.destroy', $comment->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this comment?');"
                                                          class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">No comments found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection