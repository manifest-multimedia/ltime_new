{{-- @props(['locations']) --}}

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="default-sidebar property-sidebar">
        <div class="filter-widget sidebar-widget">
            <div class="widget-title">
                <h5>Property</h5>
            </div>
            <div class="widget-content" wire:ignore>
                <div class="select-box">
                    <select class="wide">
                       <option data-display="Property Type">Select Property Type</option>
                       @foreach ($propertyTypes as $item)
                            <option value="{{$item}}">{{$item}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="select-box">
                    <select class="wide">
                        @isset($locations)
                       <option data-display="Select Location">Select A Location</option>
                        @foreach ($locations as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                
                <div class="filter-btn">
                    <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                </div>
            </div>
        </div>
        <div class="price-filter sidebar-widget">
            <div class="widget-title">
                <h5>Filter by Price</h5>
            </div>
            <div class="range-slider clearfix" wire:ignore>
                <div class="clearfix">
                    <div class="input">
                        <input type="text"  class="property-amount">
                    </div>
                </div>
                <div class="price-range-slider"></div>
            </div>
        </div>
        
    </div>
</div>