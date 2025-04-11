<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <section class="property-page-section property-grid">
        <div class="auto-container">
            <div class="row clearfix">
    
                <x-sidebar :propertyTypes="$propertyTypes" :locations="$locations" />

                @if($properties==null)
                    No Results
                @else  
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-content-side">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left">
                                <h5>Search Lands & Properties:  
                                    {{-- <span>Showing 1-5 of 20 Properties</span> --}}
                                </h5>
                            </div>
                            <div class="right-column pull-right clearfix">
                                <div class="short-box clearfix">
                                    <div class="select-box" wire:ignore>
                                        <select class="wide">
                                           <option data-display="Sort by: Newest">Sort by: Newest</option>
                                           <option value="1">High to Low</option>
                                           <option value="2">Low to High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="short-menu clearfix">
                                    <button class="list-view"><i class="icon-35"></i></button>
                                    <button class="grid-view on"><i class="icon-36"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper grid">
                            <x-property-listview :properties="$properties" />
                            <x-property-gridview :properties="$properties" />
                        </div>
                      
                    </div>
                </div>
                @endif 
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Price Range Slider
        if ($('.price-range-slider').length) {
            $(".price-range-slider").slider({
                range: true,
                min: 0,
                max: {{$highestprice}},
                values: [{{ $price_filter[0] }}, {{ $price_filter[1] }}],
                slide: function(event, ui) {
                    $("input.property-amount").val(ui.values[0] + " - " + ui.values[1]);
                },
                stop: function(event, ui) {
                    Livewire.emit('priceFilterChanged', ui.values[0] + " - " + ui.values[1]);
                }
            });

            $("input.property-amount").val($(".price-range-slider").slider("values", 0) + " - GH₵" + $(".price-range-slider").slider("values", 1));
        }
    </script>
@endpush

   
    
    
   

    
</div>
