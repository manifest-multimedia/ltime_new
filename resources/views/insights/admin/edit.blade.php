@extends('insights.admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-primary-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark">Edit Post</h5>
                            <div>
                                <a href="{{ route('insights.admin.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to Posts
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('insights.admin.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @include('insights.admin._form')

                            <div class="d-flex justify-content-between mt-4">
                                <a href="#" onclick="if(confirm('Are you sure you want to delete this post? This action cannot be undone.')) { document.getElementById('delete-form').submit(); } return false;" 
                                   class="btn btn-danger">
                                    <i class="fas fa-trash mr-1"></i> Delete Post
                                </a>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update Post
                                </button>
                            </div>
                        </form>

                        <form id="delete-form" action="{{ route('insights.admin.destroy', $post->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection