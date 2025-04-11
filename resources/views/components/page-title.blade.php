@props(['pagetitle', 'coverphoto'])
{{-- @dd($coverphoto) --}}
@if($coverphoto!='Not Available')

        @if(isset($pagetitle))
            <!--Page Title-->
                    <section class="page-title centred" style="background-image: url({{asset("storage/$coverphoto")}});">
                        <div class="auto-container">
                            <div class="content-box clearfix">
                                <h1>{{$pagetitle}}</h1>
                                <ul class="bread-crumb clearfix">
                                    <li><a href="/">Home</a></li>
                                    <li>{{$pagetitle}}</li>
                                </ul>
                            </div>
                        </div>
                    </section>
            <!--End Page Title-->
        @endif
   
@else 

@if(isset($pagetitle))

@php
    $image=strtolower(str_replace(" ", "-", $pagetitle)).'.jpg';
    $image_path=asset("assets/images/background/$image");
@endphp
<!--Page Title-->
        <section class="page-title centred" style="background-image: url({{$image_path}});">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{$pagetitle}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>{{$pagetitle}}</li>
                    </ul>
                </div>
            </div>
        </section>
<!--End Page Title-->
@endif

@endif 
