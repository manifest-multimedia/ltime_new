<x-page-layout title="L-Time Properties | Insights" pagetitle="Insights"> 
   

    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset("blog_images/$post->image_large")}}" alt="{{$post->title}}"></figure>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <h3>{{$post->title}}</h3>
                                    <ul class="post-info clearfix">
                                        {{-- <li class="author-box">
                                            <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt=""></figure>
                                            <h5><a href="blog-details.html">Eva Green</a></h5>
                                        </li> --}}
                                        <li>{{$post->posted_on}}</li>
                                    </ul>
                                    <div class="text">
                                        {!!$post->post_body_output()!!}
                                    </div>
                                    {{-- <div class="post-tags">
                                        <ul class="tags-list clearfix">
                                            <li><h5>Tags:</h5></li>
                                            <li><a href="#">Real Estate</a></li>
                                            <li><a href="#">Interior</a></li>
                                            <li><a href="#">Rent Home</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                       
                    </div>
                </div>

                <x-blog-sidebar-widget />
            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->
   
</x-page-layout> 