<section class="py-12 {{ $section->background_color ? 'bg-'.$section->background_color : 'bg-gray-50' }}"
         style="{{ $section->text_color ? 'color: '.$section->text_color : '' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                {{ $section->title ?: 'What our clients say' }}
            </h2>
            @if($section->contentBlocks->first() && $section->contentBlocks->first()->subtitle)
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    {{ $section->contentBlocks->first()->subtitle }}
                </p>
            @endif
        </div>
        
        <div class="mt-12 space-y-8 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-8">
            @foreach($section->contentBlocks as $block)
                <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="text-yellow-400 flex">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="mt-3 text-base text-gray-600">
                                {!! $block->content !!}
                            </p>
                        </div>
                        <div class="mt-6 flex items-center">
                            @if($block->image)
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/'.$block->image) }}" alt="{{ $block->title }}">
                                </div>
                            @endif
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $block->title }}</p>
                                <p class="text-xs text-gray-500">{{ $block->subtitle }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>