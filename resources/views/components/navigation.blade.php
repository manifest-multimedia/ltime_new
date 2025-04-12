<div class="menu-area clearfix">
    <!--Mobile Navigation Toggler-->
    <div class="mobile-nav-toggler">
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
    </div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">
                <li class="{{ url()->current() === url('/') ? 'current' : ''}}"><a href="/"><span>Home</span></a>
                   
                </li>
                <li class="{{ url()->current() === url('/our-company') ? 'current' : ''}}"><a href="/our-company"><span>About Us</span></a>
                   
                </li> 
                <li class="{{ url()->current() === url('/our-services') ? 'current' : ''}}"><a href="/our-services"><span>Services</span></a> </li> 
                    
                
                <li class="{{ url()->current() === url('/properties') ? 'current' : ''}}"><a href="/properties"><span>Properties</span></a>
                    
                </li> 
                <li class="{{ url()->current() === url('/en/insights') ? 'current' : ''}}"><a href="/insights"><span>Insights</span></a></li>
                
                <li class="{{ url()->current() === url('/contact-us') ? 'current' : ''}}"><a href="/contact-us"><span>Contact Us</span></a></li>   
            </ul>
        </div>
    </nav>
</div>


<div class="menu-right-content clearfix d-none d-sm-flex">
    @if (\Request::route()->getName()==="home")

        <div class="sign-box ">
            @auth
                <a href="{{url('portal/dashboard')}}"><i class="fas fa-user"></i>My Account</a>

            @else 

                <a href="{{url('login')}}"><i class="fas fa-user"></i>Sign In</a>
            @endauth

        </div>

    @endif
    <div class="sign-box mr-2 ml-3">
        <a href="{{url('register')}}" class="theme-btn btn-one"><span>+</span>Become an Affiliate</a>
    </div>
</div>
<div class="menu-right-content clearfix d-block d-sm-none">
    
    <div class="sign-box mr-2 ml-3">
        <a href="{{url('properties')}}" class="theme-btn btn-one" style="top:4px !important;padding:8px 25px 8px 20px !important"><span></span>Our Properties</a>
    </div>

</div>