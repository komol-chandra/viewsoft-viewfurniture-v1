<div class="media">
    <a href="{{url('/products/'.$product->product_slug.'/'.$product->id)}}"><img class="img-fluid blur-up lazyload"
            src="{{ asset('uploads/products/'.$product->image) }}" alt="" style="height: 160px; width: 160px"></a>
    <div class="media-body align-self-center">
        {{-- <div class="rating">
            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
        </div> --}}
        <a href="{{url('/products/'.$product->product_slug.'/'.$product->id)}}">
            <h6>{{ $product->product_name }}</h6>
        </a>
        @php $all_offer_active = 0;@endphp
        
        <!--==================== 11 offer  start ==================-->
        @if ($today == $eleven && $product->offer == '11_offer' && $product->have_a_discount == '1')
            @php$all_offer_active = 1;@endphp
            <h6 class="badge badge-grey-color">11% off</h6>
        <!--==================== 22 offer  start ==================-->
        @elseif($today == $twenty_two && $product->offer == '22_offer' && $product->have_a_discount == '1')
            @php$all_offer_active = 1;@endphp
            <h6 class="badge badge-grey-color">22% off</h6>
        <!--==================== special offer  date wish (ok)==================-->
        @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->discount_condition == 'date')
            @if(Carbon\Carbon::now()->gte($product->from_date) && Carbon\Carbon::now()->lte($product->to_date))
            @php $all_offer_active=1; @endphp
            <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
            @else
            @endif
        <!--====================special offer limit_qty==================-->
        @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'limit_qty' && $product->offer_qty > $product->checkout_offer_qty && $product->discount_condition == 'Stock')
            @php $all_offer_active=1; @endphp 
            <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
        <!--==================== special offer  all stock ==================-->
        @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'all_stock' && $product->discount_condition == 'Stock')
            @php $all_offer_active=1; @endphp 
            <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
        <!--==================== special offer  end ==================-->
        @else
        @endif
        <!--======================= offer related codes ================== -->
        {{--{{dd($all_offer_active)}} --}}
        @if($product->have_a_discount == '1' && $all_offer_active==1)
        <input type="hidden" name="offer_name" value="{{ $product->offer_stock_type }}" />
        <input type="hidden" name="price" value="{{ $product->discounted_price }}" />
        <input type="hidden" name="product_main_price" value="{{ $product->product_price }}" />
        <h6>
            ৳ {{ $product->discounted_price }}
            <del>৳ {{ $product->product_price }}</del>
        </h6>
        @else
        <h6>৳ {{ $product->product_price }}</h6>
        <input type="hidden" name="price" value="{{ $product->product_price }}" />
        @endif
        <!-- <ul class="color-variant">
            <li class="bg-light0 active"></li>
            <li class="bg-light1"></li>
            <li class="bg-light2"></li>
        </ul> -->
        <!--======================= offer related codes end ================== -->


    </div>
</div>