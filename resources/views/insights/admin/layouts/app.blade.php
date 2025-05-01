<x-backend-layout>
    <!-- Admin Navigation -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="page-header">
                <div class="page-title">
                    <h3>@yield('title', 'Insights Management')</h3>
                </div>
            </div>

            <!-- Insights Admin Navigation -->
            <div class="row layout-top-spacing">
                <div class="col-12">
                    <div class="bg-white shadow-sm mb-4">
                        <div class="p-3">
                            <div class="d-flex">
                                <a href="{{ route('insights.admin.index') }}" 
                                class="mr-4 {{ request()->routeIs('insights.admin.index') || request()->routeIs('insights.admin.create') || request()->routeIs('insights.admin.edit') ? 'font-weight-bold text-primary' : 'text-dark' }}">
                                    Posts
                                </a>
                                <a href="{{ route('insights.admin.categories') }}"
                                class="mr-4 {{ request()->routeIs('insights.admin.categories*') ? 'font-weight-bold text-primary' : 'text-dark' }}">
                                    Categories
                                </a>
                                <a href="{{ route('insights.admin.comments') }}"
                                class="mr-4 {{ request()->routeIs('insights.admin.comments*') ? 'font-weight-bold text-primary' : 'text-dark' }}">
                                    Comments
                                </a>
                                <a href="{{ route('insights.index') }}" target="_blank"
                                class="ml-auto text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                        <polyline points="15 3 21 3 21 9"></polyline>
                                        <line x1="10" y1="14" x2="21" y2="3"></line>
                                    </svg>
                                    View Site
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            @if(session()->has('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        @stack('page-scripts')
    @endpush
</x-backend-layout>