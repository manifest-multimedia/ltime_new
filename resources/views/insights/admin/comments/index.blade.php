@extends('insights.admin.layouts.app')

@section('title', 'Manage Comments')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="widget widget-table-two">
                <div class="widget-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>All Comments</h4>
                    </div>

                    @if($comments->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Comment</th>
                                        <th>Author</th>
                                        <th>Post</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td style="max-width: 300px;">
                                                <div class="text-wrap">
                                                    {{ Str::limit($comment->comment, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-weight-bold">
                                                    {{ $comment->author_name }}
                                                </div>
                                                @if($comment->author_email)
                                                <div class="text-muted small">
                                                    {{ $comment->author_email }}
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('insights.show', $comment->post->translations->first()->slug) }}#comments" target="_blank">
                                                    {{ Str::limit($comment->post->translations->first()->title, 30) }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($comment->approved)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $comment->created_at->format('M j, Y') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    @if(!$comment->approved)
                                                        <form action="{{ route('insights.admin.comments.approve', $comment->id) }}" 
                                                            method="POST" 
                                                            class="d-inline mr-2">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('insights.admin.comments.destroy', $comment->id) }}" 
                                                            method="POST" 
                                                            onsubmit="return confirm('Are you sure you want to delete this comment?');"
                                                            class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1-2-2h4a2 2 0 0 1-2 2v2"></path>
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
                            {{ $comments->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No comments found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection