 <!-- our-partners-section -->
 <section class="clients-section bg-color-1">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-1.png);"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 title-column">
                <div class="sec-title">
                    <h5>Our Partners</h5>
                    <h2>We work with great partners.</h2>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                <div class="clients-logo">
                    
                    <ul class="logo-list clearfix">
                        @foreach (\App\Models\Partner::get() as $item)
                        <li>
                            <figure class="logo"><a href="{{$item->website}}"><img src="{{Storage::url($item->logo ?? '')}}" alt="{{$item->company}}"></a></figure>
                        </li>
                        @endforeach
                        
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- our-partners-section end -->