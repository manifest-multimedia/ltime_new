@extends('insights.admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="widget">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Edit Category</h4>
                        <a href="{{ route('insights.admin.categories') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left mr-2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <form action="{{ route('insights.admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                @include('insights.admin.categories._form')

                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('insights.admin.categories') }}" class="btn btn-outline-secondary mr-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save mr-2">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                        Update Category
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection