@extends('layouts.frontend')
@section('title', 'Wishlist Page')

@section('content')
<section class="cart-page section-tb-padding">
    <div class="container">

        <div class="row">
            <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="cart-area">
                    <div class="cart-details">
                        <div class="cart-item">
                            <span class="cart-head">My Wishlist:</span>
                            <span class="c-items">{{ Cart::instance('wishlist')->count() }} item</span>
                        </div>
                        @foreach(Cart::instance('wishlist')->content() as $cartItem)
                        <div class="cart-all-pro">
                            <div class="cart-pro">
                                @foreach($cartItem->options as $key => $image)
                                @php
                                $proudct_info =
                                App\Models\Product::where('id',$cartItem->id)->select(['id','product_slug'])->first();
                                @endphp
                                @if($key==0)
                                <div class="cart-pro-image">
                                    <a
                                        href="{{ url('/products/' . $proudct_info->product_slug . '/' . $proudct_info->id) }}"><img
                                            src="{{asset('uploads/products/'.$image)}}" class="img-fluid" alt="image"
                                            style="height: 150px; width: 150px"></a>
                                </div>
                                @endif
                                @endforeach

                                <div class="pro-details">

                                    <h4><a
                                            href="{{ url('/products/' . $proudct_info->product_slug . '/' . $proudct_info->id) }}">{{$cartItem->name}}</a>
                                    </h4>

                                    @foreach ($cartItem->options as $key => $value)
                                    @if($key==4)
                                    @if($value!=null)
                                    <span class="pro-size"><span class="size">attributes:</span> {{$value}}</span>
                                    @endif
                                    @endif

                                    @endforeach
                                    {{-- <span class="pro-shop">Petro-demo</span> --}}
                                    <span class="cart-pro-price">৳{{ $cartItem->price }}</span>
                                </div>
                            </div>
                            <div class="qty-item">
                                <div class="center">
                                    <a href="{{ url('/products/' . $proudct_info->product_slug . '/' . $proudct_info->id) }}"
                                        class="pro-remove">Details</a>
                                    <a onclick="deletewishlistdata(this)" id="{{$cartItem->rowId}}"
                                        class="pro-remove">Remove</a>
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
                        <span class="total-amount">৳{{Cart::instance('wishlist')->subtotal()}}</span>
                    </div>
                    <a href="{{ url('/products/checkout') }}" class="check-link">Checkout</a>
                    <a href="{{ url('/shop') }}" class="check-link">Continue shopping</a>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection
