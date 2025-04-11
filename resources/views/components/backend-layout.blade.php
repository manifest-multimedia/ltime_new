@props(['pagetitle'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Dashboard | L-Time Properties </title>
    <meta name="description" content="{{$description ?? 'Your partner in Land Acquisition, Real Estate & Construction.'}}">
    <meta name="keywords" content="land, real esatate, construction, property, lands, land acquisition">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}"/>

    <link href="{{ asset('assets/backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/backend/assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('assets/backend/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/backend/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <style class="dark-theme">
        #chart-2 path {
            stroke: #0e1726;
        }
    </style>

    @livewireStyles

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="nav-logo align-self-center">
                <a class="navbar-brand" href="{{url('/portal/dashboard')}}"><img alt="logo" src="{{asset('assets/images/logo.png')}}" style="width:100px"> <span class="navbar-brand-name">{{__("Portal")}}</span></a>
            </div>

            <x-portal-topbar />
           
            <ul class="navbar-item flex-row ml-auto">
                <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        </div>
                    </form>
                </li>
            </ul>

            <ul class="navbar-item flex-row nav-dropdowns">
               

                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            @if (Auth::check())
                                @if(Auth::user()->profile_photo_path)
                                    <img style="object-fit:cover; " src="{{ (Auth::user()->profile_photo_path) ? asset('storage/'.Auth::user()->profile_photo_path) : '' }}" alt="{{ Auth::user()->name }}" >
                                @else 
                            <div class="d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 35px; height: 35px; font-size: 13px; background-color: #bfc9d4;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            
                            @endif 
                        @endif
                        
                        </div>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="media-body">
                                    <h5>{{ Str::limit(Auth::user()->name, 15, '...') }}</h5>
                                    <p>Affiliate ID: {{Auth::user()->affiliate_id}}</p>

                                   
                                   {{-- Referral Link: <a href="{{Auth::user()->getReferralLink()}}">{{Auth::user()->getReferralLink()}}</a>  --}}

                                    @isset(Auth::user()->role)
                                        <p>{{ucfirst(Auth::user()->role)}}</p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{url('portal/profile')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Profile</span>
                            </a>
                        </div>
                    
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                        </div> 
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        
        <!--  BEGIN CONTENT PART  -->
       {{$slot}}
        <!--  END CONTENT PART  -->

        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © {{date('Y')}} <a target="_blank" href="url('/')">L-Time Properties</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Built with 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                by <a href="https://manifestghana.com"> Manifest Mutlimedia </a></p>
            </div>
        </div>

    </div>
</div>

    </div>
    <!-- END MAIN CONTAINER -->

    @livewireScripts

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/backend/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/backend/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/backend/assets/js/app.js')}}"></script>
 
    <script src="{{asset('assets/backend/assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('assets/backend/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/backend/assets/js/dashboard/dash_1.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/backend/plugins/dropify/dropify.min.js') }}"></script> 
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            App.init();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js" defer></script>

    @stack('scripts')
    
</body>
</html>