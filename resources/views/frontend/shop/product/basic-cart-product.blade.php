<form id="cartsection-{{ $product->id }}">
    <input type="hidden" name="id" value="{{ $product->id }}" />
    <input type="hidden" name="name" value="{{ $product->product_name }}" />
    <input type="hidden" name="product_sku" value="{{ $product->product_sku }}" />
    <input type="hidden" name="image" value="{{ $product->image }}" />
    <input type="hidden" name="shop_id" value="{{ $product->shop_id }}" />
    <input type="hidden" name="product_quantity" value="1" />
    <div class="product-box">
        <div class="img-wrapper">
            <div class="lable-block">
                @php
                $offer_active = 0;
                @endphp
                <!--==================== 11 offer  start ==================-->
                @if ($today == $eleven && $product->offer == '11_offer' && $product->have_a_discount == '1')
                    @php$offer_active = 1;@endphp
                    <span class="lable3">11% off</span>
                <!--==================== 22 offer  start ==================-->
                @elseif($today == $twenty_two && $product->offer == '22_offer' && $product->have_a_discount == '1')
                    @php$offer_active = 1;@endphp
                    <span class="lable3">22% off</span>
                <!--==================== special offer  date wish (ok)==================-->
                @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->discount_condition == 'date')
                    @if(Carbon\Carbon::now()->gte($product->from_date) && Carbon\Carbon::now()->lte($product->to_date))
                    @php $offer_active=1; @endphp
                    <span class="lable3">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</span>
                    @else
                    @endif
                <!--====================special offer limit_qty==================-->
                @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'limit_qty' && $product->offer_qty > $product->checkout_offer_qty && $product->discount_condition == 'Stock')
                @php $offer_active=1; @endphp 
                <span class="lable3">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</span>
                <!--==================== special offer  all stock ==================-->
                @elseif($product->offer == 'special_offer' && $product->have_a_discount == '1' && $product->offer_stock_type == 'all_stock' && $product->discount_condition == 'Stock')
                @php $offer_active=1; @endphp 
                <span class="lable3">{{ $product->discount_price_type=='taka' ? $product->discount_price." ৳ off":($product->discount_price_type=='percent' ? $product->discount_percent ." % off" : "" )}}</span>
                <!--==================== special offer  end ==================-->
                @else
                @endif
                <span class="lable4">on sale</span>
            </div>
            <div class="front">
                <a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}"
                    class="bg-size blur-up lazyloaded"
                    style="background-image: url(&quot;{{ asset('uploads/products/' . $product->image) }}&quot;); background-size: cover; background-position: center center; display: block;">
                    <img class="lazy" src="{{asset('frontend')}}/assets/images/marketplace/pro/1.jpg"
                        class="img-fluid blur-up bg-img" alt="" style="display: none;" />
                      
                </a>
            </div>
            <div class="cart-box cart-box-bottom">
                <button id="{{ $product->id }}" type="button" onclick="addtocart(this)" title="Add to cart"><i
                        class="ti-shopping-cart"></i></button>

                <a id="{{ $product->id }}" href="javascript:void(0)" onclick="addtowishlist(this)"
                    title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                <a class="productdetails" onclick="quickViewProduct(this)" data-id="{{ $product->id }}"
                    data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i class="ti-search"
                        aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="product-detail">
            <div class="product-info">
                {{-- <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div> --}}
                <a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">
                    <h6>{{ $product->product_name }}</h6>
                </a>
                <!--======================= offer related codes ================== -->
                @if($product->have_a_discount == '1' && $offer_active==1)
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
                <!--======================= offer related codes end ================== -->
                <!-- ======================= check size and  weight =============================== -->
                @if ($product->product_size != null)
                @foreach (explode(',', $product->product_size) as $key => $size)
                <input class="form-check-input" type="radio" hidden name="attributes_data" value="{{ $size }}"
                    id="size{{ $key }}" {{ $key==0 ? 'checked' : '' }}>
                @endforeach
                @elseif($product->product_weight != null)
                @foreach (explode(',', $product->product_weight) as $key => $weight)
                <input class="form-check-input" type="radio" hidden name="attributes_data" value="{{ $weight }}"
                    id="weight{{ $key }}" {{ $key==0 ? 'checked' : '' }}>
                @endforeach
                @else
                @endif
            </div>
        </div>
    </div>
</form>