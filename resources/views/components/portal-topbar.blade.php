@php 

$currentRoute = \Request::route()->getName(); // Get the current route name
$currentUrl = \Request::url(); // Get the current URL


@endphp 

<ul class="navbar-item topbar-navigation">
                
    <!--  BEGIN TOPBAR  -->
    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{url('/portal/dashboard')}}">
                        <img src="{{asset('assets/images/logo.png')}}" class="navbar-logo" alt="logo" style="width:100 !important; height:45 !important">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{url('/portal/dashboard')}}" class="nav-link"> Portal</a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories" id="topAccordion">

                <li class="menu single-menu {{ $currentUrl === url('portal/dashboard') ? 'active' : '' }}">
                    <a href="{{url('portal/dashboard')}}" >
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            
                            <span>Dashboard</span>
                        </div>
                    </a>
                    
                </li>

                @can('Admin')
                <li class="menu single-menu {{ $currentUrl === url('portal/settings') ? 'active' : '' }}">
                    <a href="{{url('/portal/settings')}}">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                            
                            <span>Settings</span>
                        </div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg> --}}
                    </a>
                   
                </li>
                @endcan
                
                
                <li class="menu single-menu {{ $currentUrl === url('portal/affiliates') ? 'active' : '' }}">
                    <a href="{{url('/portal/affiliates')}}">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            
                            <span>Referrals</span>
                        </div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg> --}}
                    </a>
                    
                </li>

              
                @can("Admin")
                    <li class="menu single-menu">
                        <a href="#managecontent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                
                                <span>Manage Content</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        
                        <ul class="collapse submenu list-unstyled animated fadeInUp" id="managecontent"  data-parent="#topAccordion">
                            <li>
                                <a href="{{url('portal/properties')}}"> Properties </a>
                            </li>
                            <li>
                                <a href="{{url('portal/locations')}}"> Property Locations </a>
                            </li>

                            <li>
                                <a href="{{url("portal/testimonials")}}"> Testimonials </a>
                            </li>
                            
                            <li>
                                <a href="{{url('manage-insights')}}"> Insights </a>
                            </li>

                            <li>
                                <a href="{{url('portal/partners')}}"> Partners </a>
                            </li>
                        </ul>
                        
                    </li>
                @endcan
                

                {{-- <li class="menu single-menu menu-extras">
                    <a href="#more" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> <span class="d-xl-none">More</span></span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                   
                </li> --}}
            </ul>
        </nav>
    </div>
    <!--  END TOPBAR  -->

</ul>