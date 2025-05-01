@extends('insights.admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="widget widget-table-two">
                <div class="widget-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>All Categories</h4>
                        <a href="{{ route('insights.admin.categories.create') }}"
                           class="btn btn-primary">
                            Add New Category
                        </a>
                    </div>

                    @if($categories->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th>Posts</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="font-weight-bold">
                                                    {{ $category->translations->first() ? $category->translations->first()->category_name : 'No Translation' }}
                                                </div>
                                                @if($category->translations->first() && $category->translations->first()->category_description)
                                                <div class="text-muted small">
                                                    {{ Str::limit($category->translations->first()->category_description, 50) }}
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $category->translations->first() ? $category->translations->first()->slug : 'No Slug' }}
                                            </td>
                                            <td>
                                                <span class="badge badge-light">{{ $category->posts->count() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    @if($category->translations->first())
                                                    <a href="{{ route('insights.category', $category->translations->first()->slug) }}" 
                                                       target="_blank"
                                                       class="btn btn-sm btn-info mr-2">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('insights.admin.categories.edit', $category->id) }}" 
                                                       class="btn btn-sm btn-primary mr-2">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('insights.admin.categories.destroy', $category->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this category?');"
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
                            {{ $categories->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No categories found. Create your first category!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection