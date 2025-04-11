@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>{{$title}}</title>

<meta name="description" content="{{$description ?? 'Your partner in Land Acquisition, Real Estate & Construction.'}}">
<meta name="keywords" content="land, real esatate, construction, property, lands, land acquisition">
   
<!-- Fav Icon -->
<link rel="icon" href="{{asset("assets/images/favicon.png")}}" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset("assets/css/font-awesome-all.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/flaticon.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/owl.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" type="text/css" />
{{-- <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/4.4.1/css/bootstrap.min.css"> --}}
<link href="{{asset("assets/css/jquery.fancybox.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/jquery-ui.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/nice-select.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/style.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/responsive.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/color/theme-color.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/animate.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/css/switcher-style.css")}}" rel="stylesheet" type="text/css" />

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> --}}
@livewireStyles

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
                        {{-- <div class="spinner"></div> --}}
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
        <!-- preloader end -->


        {{-- <!-- switcher menu -->
        <div class="switcher">
            <div class="switch_btn">
                <button><i class="fas fa-palette"></i></button>
            </div>
            <div class="switch_menu">
                <!-- color changer -->
                <div class="switcher_container">
                    <ul id="styleOptions" title="switch styling">
                        <li>
                            <a href="javascript: void(0)" data-theme="green" class="green-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="pink" class="pink-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="violet" class="violet-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="crimson" class="crimson-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="orange" class="orange-color"></a>
                        </li>
                    </ul>
                </div> 
            </div>
        </div>
        <!-- end switcher menu --> --}}


        <!-- main header -->
        <header class="main-header header-style-two">
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="/"><img src="{{asset("assets/images/logo-light.png")}}" alt="logo"></a></figure>
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
                            <figure class="logo"><a href="/"><img src="{{asset("assets/images/logo.png")}}" alt="Logo"></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="btn-box">
                            <a href="{{url('register')}}" class="theme-btn btn-one"><span>+</span>Become an Affiliate</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <x-mobile-menu />

       {{$slot}}

        
            <x-sitewide-cta />
        

    <!-- main-footer -->
    <x-footer /> 
        