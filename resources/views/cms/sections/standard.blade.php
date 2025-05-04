<section 
    class="py-12 {{ $section->background_color ? 'bg-'.$section->background_color : 'bg-white' }}"
    style="{{ $section->text_color ? 'color: '.$section->text_color : '' }}">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($section->title)
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                    {{ $section->title }}
                </h2>
            </div>
        @endif
        
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @foreach($section->contentBlocks as $block)
                <div class="group relative">
                    @if($block->image)
                        <div class="w-full min-h-80 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="{{ asset('storage/'.$block->image) }}" alt="{{ $block->title }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                    @endif
                    
                    <div class="mt-4 flex justify-between">
                        <div>
                            @if($block->title)
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $block->title }}
                                </h3>
                            @endif
                            
                            @if($block->subtitle)
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $block->subtitle }}</p>
                            @endif
                            
                            @if($block->content)
                                <div class="mt-3 text-base text-gray-900 dark:text-gray-300">
                                    {!! $block->content !!}
                                </div>
                            @endif
                            
                            @if($block->link_url)
                                <div class="mt-4">
                                    <a href="{{ $block->link_url }}" class="text-base font-semibold text-indigo-600 hover:text-indigo-500">
                                        {{ $block->link_text ?: 'Learn more' }} <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>