@php 
    $posts = \App\Models\Insights\Post::where('is_published', true)
        ->orderBy('posted_at', 'desc')
        ->take(3)
        ->get();
@endphp

<!-- news-section -->
<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Industry Insights</h5>
            <h2>Industry Insights</h2>
        </div>
        <div class="row clearfix">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{ route('insights.show', $post->translations->first()->slug) }}"><img src="{{ asset('insights_images/' . ($post->translations->first()->image_large ?? 'default.jpg')) }}" alt="{{ $post->translations->first()->title ?? 'No Title' }}"></a></figure>
                                <span class="category">Insights</span>
                            </div>
                            <div class="lower-content">
                                <h4><a href="{{ route('insights.show', $post->translations->first()->slug) }}">{!! $post->translations->first()->title ?? 'No Title' !!}</a></h4>
                                <ul class="post-info clearfix">
                                    <li>{{ $post->posted_at->format('M j, Y') }}</li>
                                </ul>
                                <div class="btn-box">
                                    <a href="{{ route('insights.show', $post->translations->first()->slug) }}" class="theme-btn btn-two">Read Full Article</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- news-section end -->