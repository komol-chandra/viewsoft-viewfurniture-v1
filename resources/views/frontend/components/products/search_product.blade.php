<div class="search-pro-items">
    <form id="cartsection-{{ $product->id }}">
        <div class="search-img">
            <a href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">
                <img data-original=" {{ asset('uploads/products/' . $product->image) }}" class="img-fluid img_laz"
                    alt="image">

            </a>
            <div class="pro-icn">
                <a id="{{ $product->id }}" href="javascript:void(0)" onclick="addtowishlist(this)"
                    title="Add to Wishlist" class="w-c-q-icn"><i class="icon-heart"></i></a>
                {{-- <a href="cart.html" class="w-c-q-icn cart"><i class="icon-handbag"></i></a> --}}
                @if(auth()->user())

                <a href="javascript:void(0)" onclick="customChooseProduct(this)" data-id="{{ $product->id }}"
                    class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                        class="fa fa-rocket"></i></a>
                @else


                <a href="{{ url('/login') }}" class="w-c-q-icn"><i class="fa fa-rocket"></i></a>
                @endif
                <a href="javascript:void(0)" onclick="quickViewProduct(this)" data-id="{{ $product->id }}"
                    class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-eye"></i></a>


            </div>
        </div>



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














        <div class="search-caption">
            <h4><a
                    href="{{ url('/products/' . $product->product_slug . '/' . $product->id) }}">{{ $product->product_name }}</a>
            </h4>
            <!--================= offer check start  ========================== -->
            @if($offerActive==1)
            <div class="pro-price">

                <span class="new-price chosen_price" id="chosen_price"> ৳
                    {{ $discounted_price }}
                </span>
                <input type="hidden" id="product_chosen_price" value="{{$discounted_price}}" name="price">

                <span class="old-price"><del> ৳ {{ $product_main_price }}</del></span>

            </div>
            @else
            <div class="pro-price">
                <span class="new-price chosen_price" id="chosen_price"> ৳ {{ $product->product_price }}
                </span>
                <input type="hidden" id="product_chosen_price" value="{{$product->product_price}}" name="price">
            </div>
            @endif
            <!--================= offer check end ========================== -->

        </div>
</div>

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
<script>
    $(document).ready(function () {
        $('#option-choice-form input').on('change', function () {
            getVariantPrice();
        });
    });

    function getVariantPrice() {
        //alert("success");
        if ($('#option-choice-form input[id=quantity]').val() > 0) {
            $.ajax({
                type: "GET",
                url: "{{ route('products.variant_price')}}",
                data: $('#option-choice-form').serializeArray(),
                success: function (data) {
                    //console.log(data);
                    $('#chosen_price').html('৳' + data.price);
                    $('#product_chosen_sku').val(data.sku);
                    $('#product_sku').val(data.sku);
                    $('#product_chosen_price').val(data.price);
                    $('.old-price').html('<del> ৳ ' + data.product_main_price + '</del>');
                }
            });
        }
    }

</script>
