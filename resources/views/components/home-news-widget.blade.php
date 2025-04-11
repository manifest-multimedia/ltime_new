@php 
use BinshopsBlog\Models\BinshopsPost;
$posts= BinshopsPost::where('is_published', true)->limit(3)->get();

@endphp


 <!-- news-section -->
 <section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Industry Insights</h5>
            <h2>Industry Insights</h2>
            {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p> --}}
        </div>
        <div class="row clearfix">
            @foreach ($posts as $item)

            @php
                // Get Post Info
                $post=\BinshopsBlog\Models\BinshopsPostTranslation::find($item->id);
            @endphp
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{$post->url('en')}}"><img src="{{asset("blog_images/$post->image_large")}}" alt="{{$post->title}}"></a></figure>
                                <span class="category">Insights</span>
                            </div>

                           

                            <div class="lower-content">
                                <h4><a href="{{$post->url('en')}}">{!!$post->title!!}</a></h4>
                                <ul class="post-info clearfix">
                                    {{-- <li class="author-box">
                                        <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt=""></figure>
                                        <h5><a href="#">Insights</a></h5>
                                    </li> --}}
                                    <li>{{$item->posted_at}}</li>
                                </ul>
                                {{-- <div class="text">
                                    <p>In this blog post, you could explore the advantages of investing in commercial real estate properties, such as office buildings, retail spaces, and industrial warehouses. You could discuss the potential for long-term rental income, tax benefits, and the potential for property appreciation. You could also provide tips for investors on how to identify lucrative commercial real estate opportunities and manage their properties effectively.</p>
                                </div> --}}
                                <div class="btn-box">
                                    <a href="{{$post->url('en')}}" class="theme-btn btn-two">Read Full Article</a>
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