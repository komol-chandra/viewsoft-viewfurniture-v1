<script src="{{ asset('frontend') }}/js/jquery-3.6.0.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.lazyload.js"></script>
<script>
    $(document).ready(function () {
        $(".img_laz").lazyload({
            effect: "fadeIn"
        });
    })

</script>
<form id="cartsection-{{ $product->id }}">
    <div class="tred-pro">
        <div class="tr-pro-img">
            <a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">
                <img class="img-fluid img_laz" data-original="{{ asset('uploads/products/' . $product->image) }}"
                    alt="pro-img1" style="max-height: 275px">
            </a>
        </div>
        <div class="Pro-lable">
            <span class="p-text">{{ $product->product_condition }}</span>
        </div>
        <div class="pro-icn">
            <a id="{{ $product->id }}" href="javascript:void(0)" onclick="addtowishlist(this)" title="Add to Wishlist"
                class="w-c-q-icn"><i class="fa fa-heart"></i></a>
            {{-- <a id="{{ $product->id }}" href="javascript:void(0)" onclick="addtocart(this)" title="Add to cart"
            class="w-c-q-icn"><i class="fa fa-shopping-bag"></i></a> --}}
            <a href="javascript:void(0)" onclick="quickViewProduct(this)" data-id="{{ $product->id }}" class="w-c-q-icn"
                data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-eye"></i></a>
        </div>
    </div>
    <div class="caption">
        <h3><a
                href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">{{ $product->product_name }}</a>
        </h3>
        {{-- <div class="rating">
            <i class="fa fa-star c-star"></i>
            <i class="fa fa-star c-star"></i>
            <i class="fa fa-star c-star"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
        </div> --}}












        @php
        $todayDate = Carbon\Carbon::now();
        $today = $todayDate->format('d');
        $eleven = '11';
        $twenty_two = '22';
        $discounted_price = 0;
        $product_main_price = 0;
        $discount_price = 0;
        $product_discount_name = 0;
        $offerActive = 0;
        if ($product->have_a_discount == 1) {
        // special_offer
        if ($product->offer == 'special_offer') {
        if ($product->discount_condition == 'date' && ($todayDate->gte($product->from_date) &&
        $todayDate->lte($product->to_date))) {
        $offerActive = 1;
        } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "limit_qty" &&
        $product->product_qty >= $product->offer_qty) {
        $offerActive = 1;
        } elseif ($product->discount_condition == 'Stock' && $product->offer_stock_type == "all_stock" &&
        $product->product_qty != '0') {
        $offerActive = 1;
        } else {}

        if ($product->discount_price_type == "percent") {
        $product_main_price = $product->product_price;
        $product_discount_percent = $product->discount_price;
        $discount_price = $product->product_price * ($product->discount_price / 100);
        $discounted_price = $product->product_price - $discount_price;
        $product_discount_name = $product->discount_price . "%";
        }
        if ($product->discount_price_type == "taka") {
        $product_main_price = $product->product_price;
        $discount_percent = ($product->discount_price * 100) / $product->product_price;
        $discount_price = $product->discount_price;
        $discounted_price = $product->product_price - $discount_price;
        $product_discount_name = $product->discount_price . " taka";
        }
        // 22 offer
        } elseif ($product->offer == '22_offer') {
        if ($today == $twenty_two) {
        $offerActive = 1;
        $product_main_price = $product->product_price;
        $product_discount_name = "22%";
        $discount_price = $product->product_price * (22 / 100);
        $discounted_price = $product->product_price - $discount_price;
        }
        // 11 offer
        } else {
        if ($today == $eleven) {
        $offerActive = 1;
        $product_main_price = $product->product_price;
        $product_discount_name = "11 %";
        $discount_price = $product->product_price * (11 / 100);
        $discounted_price = $product->product_price - $discount_price;
        }
        }
        }
        @endphp


        <!--================= offer check start  ========================== -->
        @if($offerActive==1)
        <div class="pro-price">

            <span class="new-price "> ৳
                {{ $discounted_price }}
            </span>
            <input type="hidden" id="" value="{{$discounted_price}}" name="price">

            <span class="old-price"><del> ৳ {{ $product_main_price }}</del></span>
            <div class="Pro-lable">
                <span class="p-discount"> - {{ $product_discount_name }}</span>
            </div>
        </div>
        @else
        <div class="pro-price">
            <span class="new-price " id=""> ৳ {{ $product->product_price }}
            </span>
            <input type="hidden" id="" value="{{$product->product_price}}" name="price">
        </div>
        @endif
        <!--================= offer check end ========================== -->

    </div>

    <!-- add to cart data -->

    <input type="hidden" name="id" value="{{ $product->id }}" />
    <input type="hidden" name="name" value="{{ $product->product_name }}" />
    <input type="hidden" name="product_sku" id="product_sku" value="{{ $product->product_sku }}" />
    <input type="hidden" name="image" value="{{ $product->image }}" />
    <input type="hidden" name="shop_id" value="{{ $product->shop_id }}" />
    <input type="hidden" name="vendor_id" value="{{ $product->user_id }}" />
    <input type="hidden" name="product_quantity" value="1" />
    @if($product->have_a_discount == '1' && $offerActive==1)
    <input type="hidden" name="offer_name" value="{{ $product->offer_stock_type }}" />
    <input type="hidden" name="product_main_price" value="{{ $product->product_price }}" />
    @else
    <input type="hidden" name="price" value="{{ $product->product_price }}" />
    @endif
</form>

<!--============== to select defult checkbox ====================  -->
