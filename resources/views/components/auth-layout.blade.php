@props(['pagetitle', 'page'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ isset($pagetitle) ? $pagetitle : 'L-Time Properties' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}"/>
    <link href="{{asset("assets/backend/assets/css/loader.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{asset("assets/backend/assets/js/loader.js")}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/assets/css/forms/switches.css')}}">
</head>
<body class="form">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class=""> {{$page === "Login" ? "Log In" : "Create an account" }} <a href="{{url('login')}}">
                            {{-- <span class="brand-name">{{__('L-Time Properties')}}</span> --}}
                        </a></h1>
                        @if($page==="Login")
                            <p class="signup-link">New Here? <a href="{{url('register')}}">Create an account</a></p>
                        @else 
                        <p class="signup-link">Already have an account? <a href="{{url('login')}}">Login</a></p>
                        @endif
                        {{-- <form class="text-left"> --}}
                           {{$slot}}
                        {{-- </form>                         --}}
                        <p class="terms-conditions">© {{date('Y')}} All Rights Reserved. <a href="{{url('privacy')}}">Privacy</a> and <a href="{{url('terms')}}">Terms</a>.</p>

                    </div>                    
                </div>
            </div>
        </div>

        <style>
            .form-image .l-image{
                background:url({{asset("assets/images/about-thumb.jpg")}}) !important;
                object-fit:cover !important;
                background-size: 100% !important;
            }
        </style>
        <div class="form-image">
            
            <div class="l-image">

            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/backend/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/backend/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset("assets/backend/assets/js/authentication/form-1.js")}}"></script>
    <script>
        var loaderElement = document.querySelector('#load_screen');
        setTimeout( function() {
            loaderElement.style.display = "none";
        }, 3000);
    </script>
</body>
</html>