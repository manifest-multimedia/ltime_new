@extends('insights.admin.layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-primary-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark">Create New Post</h5>
                            <div>
                                <button type="button" onclick="document.getElementById('post-create-form').submit();" class="btn btn-sm btn-primary mr-2">
                                    <i class="fas fa-save mr-1"></i> Publish Post
                                </button>
                                <a href="{{ route('insights.admin.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to Posts
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('insights.admin.store') }}" method="POST" enctype="multipart/form-data" id="post-create-form">
                            @csrf
                            
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

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Create Post
                                </button>
                            </div>
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
    const form = document.getElementById('post-create-form');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Creating...';
    });
});
</script>
@endpush