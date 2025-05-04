<section class="py-12 {{ $section->background_color ? 'bg-'.$section->background_color : 'bg-white' }}"
         style="{{ $section->text_color ? 'color: '.$section->text_color : '' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            @if($section->title)
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">{{ $section->title }}</h2>
            @endif
            
            @if($section->contentBlocks->first() && $section->contentBlocks->first()->title)
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    {{ $section->contentBlocks->first()->title }}
                </p>
            @endif
            
            @if($section->contentBlocks->first() && $section->contentBlocks->first()->content)
                <div class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                    {!! $section->contentBlocks->first()->content !!}
                </div>
            @endif
        </div>

        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                @foreach($section->contentBlocks->skip(1) as $block)
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/lightning-bolt -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">{{ $block->title }}</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-600">
                            {{ $block->content }}
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>