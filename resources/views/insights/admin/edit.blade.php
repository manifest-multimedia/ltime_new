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
                                <button type="button" onclick="document.getElementById('post-edit-form').submit();" class="btn btn-sm btn-primary mr-2">
                                    <i class="fas fa-save mr-1"></i> Save Changes
                                </button>
                                <a href="{{ route('insights.admin.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to Posts
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        <!-- Debug info to help identify what's being sent -->
                        <div class="d-none">Post ID: {{ $post->id }}</div>

                        <form action="{{ route('insights.admin.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="post-edit-form">
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

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add form submission handling
    const form = document.getElementById('post-edit-form');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Updating...';
    });
});
</script>
@endpush