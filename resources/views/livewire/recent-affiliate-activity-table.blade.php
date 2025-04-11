<div>
    {{-- Do your work, then step back. --}}
    <div class="widget-heading">
        <h5 class="">Recent Activity</h5>
    </div>

    <div class="widget-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><div class="th-content">Customer</div></th>
                        <th><div class="th-content">Product</div></th>
                        <th><div class="th-content">Status</div></th>
                        <th><div class="th-content th-heading">Action</div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar"><span>{{$item->name}}</span></div></td>
                            <td><div class="td-content product-brand text-primary">{{$item->product}}</div></td>
                            <td><div class="td-content"><span class="badge badge-success">{{$item->status}}</span></div></td>
                            <td><div class="td-content pricing"><span class="">Details</span></div></td>
                        </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
