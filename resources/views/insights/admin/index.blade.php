@extends('insights.admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="widget widget-table-two">
                <div class="widget-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>All Posts</h4>
                        <a href="{{ route('insights.admin.create') }}"
                           class="btn btn-primary">
                            Add New Post
                        </a>
                    </div>

                    @if($posts->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Status</th>
                                        <th>Posted At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                <div class="font-weight-bold">
                                                    {{ $post->translations->first()->title }}
                                                </div>
                                                <div class="text-muted small">
                                                    {{ Str::limit($post->translations->first()->short_description, 50) }}
                                                </div>
                                            </td>
                                            <td>
                                                @foreach($post->categories as $category)
                                                    <span class="badge badge-info">
                                                        {{ $category->translations->first()->category_name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($post->is_published)
                                                    <span class="badge badge-success">
                                                        Published
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">
                                                        Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $post->posted_at ? $post->posted_at->format('M j, Y') : 'Not scheduled' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('insights.show', $post->translations->first()->slug) }}" 
                                                       target="_blank"
                                                       class="btn btn-sm btn-info mr-2">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('insights.admin.edit', $post->id) }}" 
                                                       class="btn btn-sm btn-primary mr-2">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('insights.admin.destroy', $post->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this post?');"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
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
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No posts found. Create your first post!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection