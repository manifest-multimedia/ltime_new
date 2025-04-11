@props(['title', 'pagetitle', 'coverphoto'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="csrf_token" value="{{ csrf_token() }}"/>

<title>{{$title}}</title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ6XVIfxzm9hPsDg6KLL5_WwePVassgOw"></script>

<!-- Fav Icon -->
<link rel="icon" href="{{asset("assets/images/favicon.png")}}" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" type="text/css">

<!-- Stylesheets -->
<link href="{{asset("assets/css/font-awesome-all.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/flaticon.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/owl.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/jquery.fancybox.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/animate.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/jquery-ui.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/nice-select.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/color/theme-color.css")}}" id="jssDefault" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/switcher-style.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/style.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/responsive.css")}}" rel="stylesheet" type="text/css">
<livewire:styles />
</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close"><i class="far fa-times"></i></div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <img src="{{asset("assets/images/footer-logo.png")}}" alt="logo">
                        
                        <div class="txt-loading">
                            <span data-text-preloader="l" class="letters-loading">
                                l
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                            <span data-text-preloader="a" class="letters-loading">
                                a
                            </span>
                            <span data-text-preloader="d" class="letters-loading">
                                d
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                            <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                            <span data-text-preloader="g" class="letters-loading">
                                g
                            </span>
                            
                        </div>
                    </div>  
                </div>
            </div>
        </div>


        <!-- main header -->
        <header class="main-header">
            <!-- header-top -->
            <div class="header-top">
                <div class="top-inner clearfix">
                    <div class="left-column pull-left">
                        <ul class="info clearfix">
                            <li><i class="far fa-map-marker-alt"></i>Near GreenVille Hospital, Community 26, Tema</li>
                            <li><i class="far fa-clock"></i>Mon - Sat  9:00AM - 5:00PM</li>
                            <li><i class="far fa-phone"></i><a href="tel:+233243407156">+233 (0)243407156</a></li>
                            <li><i class="far fa-phone"></i><a href="tel:+233206958652">+233 (0)206958652</a></li>
                        </ul>
                    </div>
                    <div class="right-column pull-right">
                        {{-- <ul class="social-links clearfix">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                        </ul> --}}
                        <div class="sign-box">
                            @auth
                            
                            <a href="{{url('/portal/dashboard')}}"><i class="fas fa-user"></i>My Account</a>
                            @else

                            <a href="{{url('login')}}"><i class="fas fa-user"></i>Sign In</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="{{url('/')}}"><img src="assets/images/logo.png" alt=""></a></figure>
                        </div>
                        <x-navigation /> 
                       
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="#"><img src="assets/images/logo.png" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="btn-box">
                            <a href="#affiliate" class="theme-btn btn-one"><span>+</span>Become an Affiliate</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <x-mobile-menu />
        <!-- End Mobile Menu -->
   @if(isset($coverphoto))
        @if(isset($pagetitle))
            <x-page-title :pagetitle="$pagetitle" :coverphoto="$coverphoto"/>

            @endif
            
    @else 
            
            @isset($pagetitle)
                <x-page-title :pagetitle="$pagetitle" coverphoto='Not Available'/>
            @endisset
   @endif
       {{$slot}}
        <!-- subscribe-section -->
            <x-sitewide-cta />
        <!-- subscribe-section end -->

        <!-- main-footer -->
        <x-footer /> 