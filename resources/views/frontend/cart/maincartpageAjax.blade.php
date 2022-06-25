<div class="row">
    <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
        <div class="cart-area">
            <div class="cart-details">
                <div class="cart-item">
                    <span class="cart-head">My cart:</span>
                    <span class="c-items">{{ $cartData->count() }} item</span>
                </div>
                @foreach(Cart::content() as $cartItem)
                <div class="cart-all-pro">
                    <div class="cart-pro">
                        @foreach($cartItem->options as $key => $image)
                        @if($key==0)
                        <div class="cart-pro-image">
                            <a href="javascript:void(0)"><img src="{{asset('uploads/products/'.$image)}}"
                                    class="img-fluid" alt="image" style="height: 150px; width: 150px"></a>
                        </div>
                        @endif
                        @endforeach

                        <div class="pro-details">
                            <h4><a href="javascript:void(0)">{{$cartItem->name}}</a></h4>
                            @foreach ($cartItem->options as $key => $value)
                            @if($key==1)
                            @if($value!=null)
                            <span class="pro-size"><span class="size">sku:</span> {{$value}}</span>
                            @endif
                            @endif


                            @endforeach
                            {{-- <span class="pro-shop">Petro-demo</span> --}}
                            <span class="cart-pro-price">৳{{ $cartItem->price }}</span>
                        </div>
                    </div>
                    <div class="qty-item">
                        <div class="center">
                            <div class="plus-minus">
                                <span>
                                    {{-- <a href="javascript:void(0)" class="minus-btn text-black">-</a> --}}
                                    <input type="number" onchange="cartqtyupdate(this)" id="{{ $cartItem->rowId }}"
                                        max="10" min="1" value="{{$cartItem->qty}}" name="qty">
                                    {{-- <input type="text" name="name" value="1"> --}}
                                    {{-- <a href="javascript:void(0)" class="plus-btn text-black">+</a> --}}
                                </span>
                            </div>
                            <a onclick="deletedata(this)" id="{{$cartItem->rowId}}" class="pro-remove">Remove</a>
                        </div>
                    </div>
                    <div class="all-pro-price">
                        <span>৳{{ $cartItem->price * $cartItem->qty }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="cart-total">
            <div class="shop-total">
                <span>Total</span>
                <span class="total-amount">৳{{Cart::subtotal()}}</span>
            </div>
            <a href="{{ url('/products/checkout') }}" class="check-link">Checkout</a>
            <a href="{{ url('/shop') }}" class="check-link">Continue shopping</a>
        </div>
    </div>
</div>
