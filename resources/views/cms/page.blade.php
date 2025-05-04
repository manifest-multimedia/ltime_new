<x-page-layout>
    <x-slot name="title">{{ $page->title }}</x-slot>
    <x-slot name="meta_description">{{ $page->meta_description }}</x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="row">
            <div class="col-12">
                <header class="mb-5">
                    <h1 class="text-3xl font-bold">{{ $page->title }}</h1>
                </header>

                @if($page->content)
                    <div class="cms-content mb-8">
                        {!! $page->content !!}
                    </div>
                @endif

                @if($page->sections->count() > 0)
                    @foreach($page->sections as $section)
                        <section 
                            id="section-{{ $section->id }}" 
                            class="mb-8 section-{{ $section->type }} p-4"
                            @if($section->background_color) style="background-color: {{ $section->background_color }};" @endif
                        >
                            @if($section->title)
                                <h2 class="text-2xl font-semibold mb-4" 
                                    @if($section->text_color) style="color: {{ $section->text_color }};" @endif>
                                    {{ $section->title }}
                                </h2>
                            @endif
                            
                            @if($section->contentBlocks->count() > 0)
                                <div class="row">
                                    @foreach($section->contentBlocks as $block)
                                        <div class="col-md-{{ 12 / min($section->contentBlocks->count(), 3) }} mb-4">
                                            <div class="content-block content-block-{{ $block->type }}">
                                                @if($block->title)
                                                    <h3 class="text-xl font-medium mb-2"
                                                        @if($section->text_color) style="color: {{ $section->text_color }};" @endif>
                                                        {{ $block->title }}
                                                    </h3>
                                                @endif
                                                
                                                @if($block->subtitle)
                                                    <h4 class="text-lg text-gray-600 mb-3"
                                                        @if($section->text_color) style="color: {{ $section->text_color }};" @endif>
                                                        {{ $block->subtitle }}
                                                    </h4>
                                                @endif
                                                
                                                @if($block->image)
                                                    <div class="mb-4">
                                                        <img src="{{ asset('storage/' . $block->image) }}" 
                                                            alt="{{ $block->title ?: 'Content image' }}"
                                                            class="img-fluid rounded">
                                                    </div>
                                                @endif
                                                
                                                @if($block->content)
                                                    <div class="content mb-4"
                                                         @if($section->text_color) style="color: {{ $section->text_color }};" @endif>
                                                        {!! $block->content !!}
                                                    </div>
                                                @endif
                                                
                                                @if($block->link_url && $block->link_text)
                                                    <a href="{{ $block->link_url }}" 
                                                       class="btn btn-primary">
                                                        {{ $block->link_text }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </section>
                    @endforeach
                @endif

                @if(!$page->content && $page->sections->count() == 0)
                    <div class="alert alert-light text-center p-5">
                        <p class="text-muted mb-0">This page has no content yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-page-layout>