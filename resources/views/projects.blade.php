<x-page-layout title="L-time Properties | Our Projects" pagetitle="Projects"> 

     @if(isset($results))
          @livewire('property-search-page', ['query' => $query, 'results'=>$results])
     @else
          @livewire('property-search-page', ['query' => $query])
     @endif
     
</x-page-layout>