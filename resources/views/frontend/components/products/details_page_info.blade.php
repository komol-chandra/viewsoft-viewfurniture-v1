<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<form id="option-choice-form" class="option-choice-form">
    <h4>{{ $product->product_name }}</h4>
    <div class="rating">
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <div class="pro-availabale">
        <span class="available">Availability:</span>
        <span class="pro-instock">{{ $product->product_qty > 0 ? "In stock" : "out of stock" }}
        </span>
    </div>
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <!--================= offer check start  ========================== -->
    @if($isOfferActive==1)
    <div class="pro-price">

        <span class="new-price chosen_price" id="chosen_price"> ৳
            {{ $discounted_price }}
        </span>
        <input type="hidden" id="product_chosen_price" value="{{$discounted_price}}" name="price">

        <span class="old-price"><del> ৳ {{ $product_main_price }}</del></span>
        <div class="Pro-lable">
            <span class="p-discount"> - {{ $product_discount_name }}</span>
        </div>
    </div>
    @else
    <div class="pro-price">
        <span class="new-price chosen_price" id="chosen_price"> ৳ {{ $product->product_price }}
        </span>
        <input type="hidden" id="product_chosen_price" value="{{$product->product_price}}" name="price">
    </div>
    @endif
    <!--================= offer check end ========================== -->


    @if($product->product_qty > 0)
    <span class="pro-details">Hurry up! only <span class="pro-number">{{ $product->product_qty }}</span> products left
        in
        stock!</span>
    @endif

    <!--======================== variation selector start ================-->
    @if(count(json_decode($product->colors)) > 0)
    <div class="product-color">
        <span class="color-label" style="margin-top: 20px">
            <h4>Color:</h4>
        </span>
        <span class="color">
            <div class="row mt-4 product-color-custom" style="display: flex">
                @if (count(json_decode($product->colors)) > 0)
                <input type="hidden" name="id" value="188">
                @foreach (json_decode($product->colors) as $key => $color)
                <label class="custom_color_radio" style="background: {{ $color }};border-color: black;">
                    <input type="radio" class="" id="{{ $product->id }}-color-{{ $key }}" name="color"
                        value="{{ $color }}" @if($key==0) checked @endif>
                </label>
                @endforeach
                @endif
            </div>
        </span>
    </div>
    @endif


    @foreach (json_decode($product->choice_options) as $key => $choice)
    <div class=" radio-toolbar">
        <span class="pro-size" style="font-size: 14px; font-weight: 600;">{{ $choice->title }}:</span>
        @foreach ($choice->options as $key => $option)
        <label for="{{ $choice->name }}-{{ $option }}">
            <input type="radio" id="{{ $choice->name }}-{{ $option }}" name="{{$choice->name}}" value="{{$option}}"
                @if($key==0) checked @endif>{{$option}}
        </label>
        @endforeach
    </div>
    @endforeach

    <!-- add to cart data -->
    <input type="hidden" name="id" value="{{$product->id}}">
    <input type="hidden" name="name" value="{{$product->product_name}}">
    <input type="hidden" name="image" value="{{$product->image}}">
    <input type="hidden" name="shop_id" value="{{$product->shop_id}}">
    <input type="hidden" name="product_sku" id="product_sku" value="{{$product->product_sku}}">
    <input type="hidden" name="user_id" value="{{ Request::ip() }}">
    <input type="hidden" name="vendor_id" value="{{ $product->user_id }}" />
    @if($product->have_a_discount == '1' && $isOfferActive == 1)
    <input type="hidden" name="offer_name" value="{{ $product->offer_stock_type }}" />
    <input type="hidden" name="product_main_price" value="{{ $product->product_price }}" />
    @else

    @endif

    <div class="pro-qty">
        <span class="qty">Quantity:</span>
        <div class="plus-minus">
            <span>
                <a href="javascript:void(0)" class="minus-btn text-black">-</a>

                <input name="product_quantity" id="quantity" class="form-control" type="number" value="1">
                <a href="javascript:void(0)" class="plus-btn text-black">+</a>
            </span>
        </div>
    </div>
    <div class="pro-btn">
        <a class="btn btn-style1 wishlist"><i class="fa fa-heart"></i></a>
        <a onclick="detailsToCart()" class="btn btn-style1"><i class="fa fa-shopping-bag"></i>
            Add
            to
            cart</a>
        {{-- <a href="checkout-1.html" class="btn btn-style1">Buy now</a> --}}
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#option-choice-form input').on('change', function () {
            getVariantPrice();
        });
    });

    function getVariantPrice() {
        alert("success");
        if ($('#option-choice-form input[id=quantity]').val() > 0) {
            $.ajax({
                type: "GET",
                url: "{{ route('products.variant_price')}}",
                data: $('#option-choice-form').serializeArray(),
                success: function (data) {
                    console.log(data);

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
