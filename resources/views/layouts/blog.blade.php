<x-page-layout title="L-Time Properties | Insights" pagetitle="Insights"> 
   
 <!-- sidebar-page-container -->
 <section class="sidebar-page-container blog-grid sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-grid-content">
                        <div class="row clearfix">

                            @forelse ($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <?=$post->image_tag("medium", true, ''); ?>
                                            </figure>
                                            <span class="category">Insights</span>
                                        </div>
                                        <div class="lower-content">
                                            <h4><a href="{{$post->url($locale, $routeWithoutLocale)}}">{{$post->title}}</a></h4>
                                            <h5><small> {{$post->subtitle}} </small></h5> 
                                            <ul class="post-info clearfix">
                                                {{-- <li class="author-box">
                                                    <figure class="author-thumb"><img src="<?=$post->image_tag("medium", true, ''); ?>" alt=""></figure>
                                                    <h5><a href="blog-details.html">Eva Green</a></h5>
                                                </li> --}}
                                                <li>{{date('d F Y ', strtotime($post->post->posted_at))}}</li>
                                            </ul>

                                            @php
                                                
                                                $content=
                                                strip_tags(substr($post->post_body,0,400), '<p>');
                                                

                                            @endphp

                                            <div class="text">
                                                 {!!mb_strimwidth($content, 0, 400, "...")!!} 
                                            </div>
                                            <div class="btn-box">
                                                <a href="{{$post->url($locale, $routeWithoutLocale)}}" class="theme-btn btn-two">See Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                                <p> No Insights</p>
                            </div>
                            @endforelse
                            

                            
                            {{-- @forelse($posts as $post)

                                <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><a href="blog-details.html"> <?=$post->image_tag("medium", true, ''); ?></a></figure>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <h4><a href='{{$post->url($locale, $routeWithoutLocale)}}'>{{$post->title}}</a></h4>
                                                <h5> {{$post->subtitle}} </h5>
                                                <ul class="post-info clearfix">
                                                    
                                                    <li>{{date('d M Y ', strtotime($post->post->posted_at))}}</li>
                                                </ul>
                                                <div class="text">
                                                    <p>{!! mb_strimwidth($post->post_body_output(), 0, 400, "...") !!}</p>
                                                </div>
                                                <div class="btn-box">
                                                    <a href="{{$post->url($locale, $routeWithoutLocale)}}" class="theme-btn btn-two">See Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                                    <div class='alert alert-danger'>No Insights!</div>
                                </div>
                            @endforelse --}}
                        </div>
                    </div>
                </div>
                <x-blog-sidebar-widget />
            </div>
                   
        </div>
        
</section>
<!-- sidebar-page-container -->
   
</x-page-layout> 