<x-page-layout>
    <x-slot name="title">Welcome to Our Site</x-slot>
    <x-slot name="meta_description">Welcome to our website. Browse our content and services.</x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <h1 class="display-4 mb-4">Welcome to Our Website</h1>
                        <p class="lead mb-4">This is the default welcome page. To replace this page, create a CMS page with the slug 'home'.</p>
                        <hr class="my-4">
                        <p>If you're an administrator, you can create and manage content through the CMS.</p>
                        <a href="{{ route('cms-pages.index') }}" class="btn btn-primary mt-3">Manage CMS Pages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-page-layout>