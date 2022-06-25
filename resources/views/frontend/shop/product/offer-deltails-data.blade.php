@php
$details_offer_active = 0;
@endphp
<!--==================== 11 offer  start ==================-->
@if ($today == $eleven && $product->offer == '11_offer' && $product->have_a_discount == '1')
    @php$details_offer_active = 1;@endphp
    <h6 class="badge badge-grey-color">11% off</h6>
<!--==================== 22 offer  start ==================-->
@elseif($today == $twenty_two && $product->offer == '22_offer' && $product->have_a_discount == '1')
    @php$details_offer_active = 1;@endphp
    <h6 class="badge badge-grey-color">22% off</h6>
<!--==================== special offer  date wish (ok)==================-->
@elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->discount_condition == 'date')
    @if(Carbon\Carbon::now()->gte($product->from_date) && Carbon\Carbon::now()->lte($product->to_date))
    @php $details_offer_active=1; @endphp
    <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
    @else
    @endif
<!--====================special offer limit_qty==================-->
@elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'limit_qty' && $product->offer_qty > $product->checkout_offer_qty && $product->discount_condition == 'Stock')
    @php $details_offer_active=1; @endphp 
    <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
<!--==================== special offer  all stock ==================-->
@elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'all_stock' && $product->discount_condition == 'Stock')
    @php $details_offer_active=1; @endphp 
    <h6 class="badge badge-grey-color">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</h6>
<!--==================== special offer  end ==================-->
@else
@endif
 <!--======================= offer related codes ================== -->
 @if($product->have_a_discount == '1' && $details_offer_active == 1)
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

 <div id="selectSize" class="addeffect-section product-description border-product">
    <!-- ======================= check size and  weight =============================== -->
    @if($product->product_size !=NULL)
    <h6 class="error-message">please select size</h6>
    <div class="size-box">
        <label for="">Size:</label>
        <select name="attributes_data" class="form-control" id="">
            @foreach(explode(',',$product->product_size) as $key => $size)
            <option value="{{ $size }}" { $key==0 ? 'selected' :'' }}>{{ $size }}</option>
            @endforeach
        </select>
    </div>
    @elseif($product->product_weight!=null)
    <h6 class="error-message">please select weight</h6>
    <div class="size-box" style="margin-left: ">
        <label for="">Weight:</label>
        <select name="attributes_data" class="form-control">
            @foreach(explode(',',$product->product_weight) as $key => $weight)
            <option value=""{ $key==0 ? 'selected' :'' }}>{{ $weight }}</option>
            @endforeach
        </select>
    </div>
    @else
    @endif
    <h6 class="product-title">quantity</h6>
    <div class="qty-box">
        <div class="input-group"><span class="input-group-prepend"><button type="button"
                    class="btn quantity-left-minus" data-type="minus" data-field=""><i
                        class="ti-angle-left"></i></button> </span>
            <input class="form-control input-number" type="number" name="product_quantity" value="1">
            <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus"
                    data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span>
        </div>
    </div>
</div>