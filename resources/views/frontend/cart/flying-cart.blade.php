<div style="height: 600px;overflow-y: auto;">
    {{-- {{ dd(Cart::content()) }} --}}
    @foreach(Cart::content() as $cartItem)
    <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white px-3 rounded">
        <div class="mr-1">
            @foreach($cartItem->options as $key => $image)
            @if($key==0)
            @if($image!=null)
            <img class="rounded" src="{{asset('uploads/products/'.$image)}}" width="50">
            @else
            <img class="rounded" src="{{asset('uploads/no-image.png')}}" width="50">
            @endif
            @endif
            @endforeach

        </div>
        <div class=" flex-column align-items-center product-details"><span
                class="font-weight-bold">{{Str::limit($cartItem->name,20)}}</span>
            <div class=" flex-row product-desc">
                <div class="size mr-1"><span class="text-grey">price:</span><span
                        class="font-weight-bold">&nbsp;{{$cartItem->qty}} x ৳
                        {{$cartItem->price}}</span></div>
                @foreach ($cartItem->options as $key => $value)
                @if($key==4)
                @if($value!=null)
                <div class="size mr-1"><span class="text-grey">attributes:</span><span
                        class="font-weight-bold">&nbsp;{{$value}}</span></div>
                @endif
                @endif

                @endforeach

                <div class="color"><span class="text-grey">total:</span><span class="font-weight-bold">&nbsp;৳{{
                        $cartItem->subtotal() }}</span></div>

            </div>
        </div>

        <div class="d-flex align-items-center" onclick="deletedata(this)" id="{{$cartItem->rowId}}"><i
                class="fa fa-trash mb-1 text-danger"></i>
        </div>
    </div>

    @endforeach
</div>
<div class="cart-sidebar-footer">
    <div class="cart-store-details">
        <p class="text-center"> Total <strong class="float-right">৳{{Cart::subtotal()}}</strong></p>
    </div>
    <a href="/products/checkout"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"
            onclick="checkout(this)"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to
                Checkout
            </span><span class="float-right"><strong>৳{{Cart::subtotal()}}</strong><span
                    class="mdi mdi-chevron-right"></span></span></button></a>
</div>