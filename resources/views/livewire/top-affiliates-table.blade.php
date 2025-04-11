<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="widget-heading">
        <h5 class="">Top Affiliates</h5>
    </div>

    <div class="widget-content">
        <div class="table-responsive">
            <table class="table table-scroll">
                <thead>
                    <tr>
                        <th><div class="th-content">Name</div></th>
                        <th><div class="th-content th-heading">Sales</div></th>
                        <th><div class="th-content th-heading">Referral Code</div></th>
                        {{-- <th><div class="th-content">Sold</div></th>--}}
                        <th><div class="th-content">Action</div></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliates as $item)
                    <tr>
                        <td><div class="td-content product-name"><img src="{{$item->profile_photo}}" alt="avatar"><div class="align-self-center"><p class="prd-name">{{$item->name}}</p>
                            <p class="prd-category text-primary">{{$item->refferal_link}}</p></div></div></td>
                        <td><div class="td-content"><span class="pricing">{{$item->sales->count()}}</span></div></td>
                        <td><div class="td-content"><span class="discount-pricing">{{$item->refferal_code}}</span></div></td>
                        <td><div class="td-content"><a href="{{url('#Details')}}" class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>Details</a></div></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
