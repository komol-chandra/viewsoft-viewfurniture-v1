<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $product->product_name }} quickview</h5>
    <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close"><i class="ion-close-round"></i></a>
</div>
<div class="quick-veiw-area">
    <div class="quick-image">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="image-1">
                <a href="javascript:void(0)" class="long-img">
                    <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-fluid" alt="image">
                </a>
            </div>
        </div>
    </div>
    <div class="quick-caption pro-info">
        <h4>product info</h4>
        <form id="option-choice-form-quick-view" class="option-choice-form-quick-view">
            <h6>{{ $product->product_name }}</h6>
            {{-- <div class="rating">
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star d-star"></i>
        <i class="fa fa-star-o"></i>
    </div> --}}
            <div class="pro-availabale">
                <span class="available">Availability:</span>
                <span class="pro-instock">{{ $product->product_qty > 0 ? "In stock" : "out of stock" }}
                </span>
            </div>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <!--================= offer check start  ========================== -->
            @if($isOfferActive==1)
            <div class="pro-price">
                <span class="new-price quick_chosen_price" id="quick_chosen_price"> ৳
                    {{ $discounted_price }}
                </span>
                <input type="hidden" id="product_quick_chosen_price" value="{{$discounted_price}}" name="price">
                <span class="old-price" id="quick-old-price"><del> ৳ {{ $product_main_price }}</del></span>
                <div class="Pro-lable">
                    <span class="p-discount"> - {{ $product_discount_name }}</span>
                </div>
            </div>
            @else
            <div class="pro-price">
                <span class="new-price quick_chosen_price" id="quick_chosen_price"> ৳ {{ $product->product_price }}
                </span>
                <input type="hidden" id="product_quick_chosen_price" value="{{$product->product_price}}" name="price">
            </div>
            @endif
            <!--================= offer check end ========================== -->
            @if($product->product_qty > 0)
            <span class="pro-details">Hurry up! only <span class="pro-number">{{ $product->product_qty }}</span>
                products left
                in
                stock!</span>
            @endif

            <!--======================== variation selector start ================-->
            <div id="product" class="mt-2">
                <div class="form-group required " style="display: block;">
                    @if (count(json_decode($product->colors)) > 0)
                    <ul class="list-inline checkbox-color mb-1">
                        <input type="hidden" name="id" value="188">
                        <li> <span
                                style="font-weight: 600;position: relative;bottom: 12px;text-transform: capitalize;margin-left: 10px;">Color:</span>
                        </li>
                        @foreach (json_decode($product->colors) as $key => $color)
                        <li>
                            <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color"
                                value="{{ $color }}" @if($key==0) checked @endif>
                            <label style="background: {{ $color }};border-color: black;"
                                for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip"
                                data-original-title="{{$color}}"></label>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            <strong style="margin-left: 20px">
                <strong>
                    <div class="col-md-12">
                        <!--custom choicses  -->
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                        <div id="product">
                            <div class="form-group required " style="display: block;">
                                <div id="input-option224">

                                    <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2"
                                        style="margin-left:5px">
                                        <li
                                            style="font-weight: 600;position: relative;bottom: 12px;text-transform: capitalize;margin-left: 25px;">
                                            {{ $choice->title }}:
                                        </li>
                                        @foreach ($choice->options as $key => $option)
                                        <li>
                                            <input type="radio" id="{{ $choice->name }}-{{ $option }}"
                                                name="{{$choice->name}}" value="{{$option}}" @if($key==0) checked
                                                @endif>
                                            <label for="{{ $choice->name }}-{{ $option }}">{{$option}}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- end custom chics -->
                    </div>
                </strong>
            </strong>

            <!-- add to cart data -->
            <input type="hidden" name="id" value="{{$product->id}}">
            <input type="hidden" name="name" value="{{$product->product_name}}">
            <input type="hidden" name="image" value="{{$product->image}}">
            <input type="hidden" name="shop_id" value="{{$product->shop_id}}">
            <input type="hidden" name="product_sku" id="quick_product_sku" value="{{$product->product_sku}}">
            <input type="hidden" name="user_id" value="{{ Request::ip() }}">
            <input type="hidden" name="vendor_id" value="{{ $product->user_id }}" />
            @if($product->have_a_discount == '1' && $isOfferActive == 1)
            <input type="hidden" name="offer_name" value="{{ $product->offer_stock_type }}" />
            <input type="hidden" name="product_main_price" value="{{ $product->product_price }}" />

            @else
            <h6>৳ {{ $product->product_price }}</h6>
            @endif
            <h6 id="sku"></h6>

            <div class="pro-qty mb-3" style="display: flex">
                <span class="qty" style="margin-top:20px">Quantity:</span>
                <div class="plus-minus">
                    <span style="margin-left: 20px">
                        <input name="product_quantity" id="quantity" class="form-control" type="number"
                            style="width: 100px" value="1">
                    </span>
                </div>
            </div>
            <div class="pro-btn">
                <a id="{{ $product->id }}" href="javascript:void(0)" onclick="addtowishlist(this)"
                    class="btn btn-style1" title="add to wishlist"><i class="fa fa-heart"></i></a>
                <a onclick="quickDetailsToCart()" class="btn btn-style1" title="add to cart" id="btn_details_cart"><i
                        class="fa fa-shopping-bag"></i></a>


            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#option-choice-form-quick-view input').on('change', function () {
            getQuickVariantPrice();
        });
    });

    function getQuickVariantPrice() {
        if ($('#option-choice-form-quick-view input[id=quantity]').val() > 0) {
            var quick_data = $('#option-choice-form-quick-view').serializeArray();
            console.log(quick_data);
            $.ajax({
                type: "GET",
                url: "{{ route('products.variant_price')}}",
                data: $('#option-choice-form-quick-view').serializeArray(),
                success: function (data) {
                    if (data.isOfferActive == 1) {
                        $('#quick_chosen_price').html('৳' + data.discounted_price);
                        $('#quick_product_sku').val(data.sku);
                        $('#product_sku').val(data.sku);
                        $('#product_quick_chosen_price').val(data.discounted_price);
                        $('#quick-old-price').html('<del> ৳ ' + data.price + '</del>');
                    } else {
                        $('#quick_chosen_price').html('৳' + data.price);
                        $('#quick_product_sku').val(data.sku);
                        $('#product_sku').val(data.sku);
                    }
                }
            });
        }
    }
    getQuickVariantPrice();

</script>
