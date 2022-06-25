<a href="javascript:void(0)" class="shopping-cart-close"><i class="ion-close-round"></i></a>
<div class="cart-item-title">
    <p>
        <span class="cart-count-desc">There are</span>
        <span class="cart-count-item bigcounter">{{ $cartData->count() }}</span>
        <span class="cart-count-desc">Products</span>
    </p>
</div>
<ul class="cart-item-loop">
    @foreach(Cart::content() as $cartItem)
    <li class="cart-item">
        @foreach($cartItem->options as $key => $image)
        @if($key==0)
        @if($image!=null)
        <div class="cart-img">
            <a href="javascript:void(0)">
                <img src="{{asset('uploads/products/'.$image)}}" alt="cart-image" class="img-fluid">
            </a>
        </div>
        @else
        <div class="cart-img">
            <a href="javascript:void(0)">
                <img src="{{asset('uploads/no-image.png')}}" alt="cart-image" class="img-fluid">
            </a>
        </div>
        @endif
        @endif
        @endforeach

        <div class="cart-title">
            <h6><a href="javascript:void(0)">{{Str::limit($cartItem->name,20)}}</a></h6>
            @foreach ($cartItem->options as $key => $value)
            @if($key==1)
            @if($value!=null)
            <p><span class="text-grey">sku:</span><span class="font-weight-bold">&nbsp;{{ $value }}</span></p>
            @endif
            @endif
            {{-- @if($key==5)
            <p><span class="text-grey">type: {{ $value }}</span></p>
            @endif --}}
            @endforeach

            <div class="cart-pro-info">
                <div class="cart-qty-price">
                    <span class="quantity">{{$cartItem->qty}} x </span>
                    <span class="price-box">৳ {{$cartItem->price}}</span>
                </div>
                <div class="delete-item-cart">
                    <a onclick="deletedata(this)" style="cursor: pointer;" id="{{$cartItem->rowId}}"><i
                            class="icon-trash icons"></i></a>
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
<ul class="subtotal-title-area">
    <li class="subtotal-info">
        <div class="subtotal-titles">
            <h6>Sub total:</h6>
            <span class="subtotal-price">৳{{Cart::subtotal()}}</span>
        </div>
    </li>
    <li class="mini-cart-btns">
        <div class="cart-btns">
            <a a href="{{ url('/products/cart') }}" class="btn btn-style2">View cart</a>
            <a href="{{ url('/products/checkout') }}" class="btn btn-style2">checkout</a>
        </div>
    </li>
</ul>
