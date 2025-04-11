 <!-- testimonial-style-two -->
 <section class="testimonial-style-two" style="background-image: url({{asset("assets/images/background/testimonials-background-1920x645.jpg")}});">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-6 col-lg-12 col-md-12 offset-xl-6 inner-column">
                <div class="single-item-carousel owl-carousel owl-theme dots-style-one owl-nav-none">
                    @if(\App\Models\Testimonial::count()>0)
                        @foreach (\App\Models\Testimonial::get() as $testimonial)
                        <div class="testimonial-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-18"></i></div>
                                <div class="text">
                                    <h3>“{{$testimonial->body}}”</h3>
                                </div>
                                <div class="author-info">
                                    {{-- <figure class="author-thumb"><img src="{{asset($testimonial->photo)}}" alt="{{$testimonial->name}}"></figure> --}}
                                    <h4>{{$testimonial->name}}</h4>
                                    <span class="designation">Customer</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else    
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-18"></i></div>
                            <div class="text">
                                <h3>“L-Time Properties made our real estate transaction a breeze. Their expertise and attention to detail ensured that everything went smoothly, and we couldn't be happier with the outcome.”</h3>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb"><img src="{{asset("assets/images/resource/testimonial-1.jpg")}}" alt="Testimonial"></figure>
                                <h4>Rebeka Dawson</h4>
                                <span class="designation">Customer</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-18"></i></div>
                            <div class="text">
                                <h3>“We hired L-Time Properties for a construction project, and they exceeded our expectations. Their professionalism and commitment to quality were evident throughout the entire process.”</h3>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb"><img src="{{asset("assets/images/resource/testimonial-1.jpg")}}" alt="testimonial"></figure>
                                <h4>Marc Kenneth</h4>
                                <span class="designation">Customer</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-18"></i></div>
                            <div class="text">
                                <h3>“Working with L-Time Properties was a great experience. They were responsive, knowledgeable, and easy to work with, and they helped us find the perfect property for our needs.”</h3>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb"><img src="{{asset("assets/images/resource/testimonial-1.jpg")}}" alt="testimonial"></figure>
                                <h4>Owen Lester</h4>
                                <span class="designation">Manager</span>
                            </div>
                        </div>
                    </div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial-style-two end -->