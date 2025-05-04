<section class="relative bg-gray-900 {{ $section->background_color ? 'bg-'.$section->background_color : '' }}">
    <div class="absolute inset-0">
        @if($section->contentBlocks->first() && $section->contentBlocks->first()->image)
            <img class="w-full h-full object-cover" src="{{ asset('storage/'.$section->contentBlocks->first()->image) }}" alt="{{ $section->title }}">
            <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
        @endif
    </div>
    
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            {{ $section->title ?: $section->contentBlocks->first()->title ?? '' }}
        </h1>
        
        @if($section->contentBlocks->first() && $section->contentBlocks->first()->subtitle)
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                {{ $section->contentBlocks->first()->subtitle }}
            </p>
        @endif
        
        @if($section->contentBlocks->first() && $section->contentBlocks->first()->content)
            <div class="mt-8 text-lg text-gray-200 max-w-3xl">
                {!! $section->contentBlocks->first()->content !!}
            </div>
        @endif
        
        @if($section->contentBlocks->first() && $section->contentBlocks->first()->link_url)
            <div class="mt-10">
                <a href="{{ $section->contentBlocks->first()->link_url }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-900 bg-white hover:bg-gray-50">
                    {{ $section->contentBlocks->first()->link_text ?: 'Learn more' }}
                </a>
            </div>
        @endif
    </div>
</section>