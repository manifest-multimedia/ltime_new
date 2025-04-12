<!-- Public Navigation -->
<x-nav-link :href="route('insights.index')" :active="request()->routeIs('insights.*')">
    {{ __('Insights') }}
</x-nav-link>

<!-- Admin Navigation -->
@auth
    <x-nav-link :href="route('insights.admin.index')" :active="request()->routeIs('insights.admin.*')">
        {{ __('Manage Insights') }}
    </x-nav-link>
@endauth