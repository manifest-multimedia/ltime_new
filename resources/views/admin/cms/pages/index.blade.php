<x-app-layout>

    <h2 class="h2 mb-4 mt-3 mx-3"
    style="padding-top:50px">{{ __('CMS Pages') }}</h2>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Pages</h5>
                        <a href="{{ route('cms-pages.create') }}" class="btn btn-primary btn-sm">
                            Create New Page
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Last Updated</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pages as $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td>{{ $page->slug }}</td>
                                            <td>
                                                <span class="badge {{ $page->status === 'published' ? 'bg-success' : ($page->status === 'draft' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($page->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $page->updated_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('cms-pages.edit', $page) }}" class="btn btn-outline-primary">Edit</a>
                                                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-info">View</a>
                                                    <form method="POST" action="{{ route('cms-pages.destroy', $page) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No pages found. <a href="{{ route('cms-pages.create') }}">Create your first page</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>