@extends('layouts.frontend')
@section('title', 'Product-Details')
@section('product_share')
@php
$detailsof_product=Str::limit($product->product_details,20);
$proedetails=strip_tags($detailsof_product);
@endphp
<meta property="og:image" content="{{ asset('uploads/products/'.$product->image) }}" />
<meta property="og:image:width" content="600px" />
<meta property="og:image:height" content="500px" />
<meta property="og:title" content="{{ $product->product_name }}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:type" content="website" />
<meta name="og:description" content="{{ $proedetails }}" />
@endsection


@section('content')

<section class="section-tb-padding pro-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-12 col-md-12 col-xs-12 pro-image">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 col-md-6 col-12 col-xs-12 larg-image">
                        <div class="tab-content">
                            @if($product->gallary_image !=NULL)
                            @php
                            $thunmbnailImg = array($product->image);
                            $gal_img=json_decode($product->gallary_image);
                            $img = array_merge($thunmbnailImg, $gal_img);
                            @endphp
                            @else
                            @php
                            $thunmbnailImg = array($product->image);
                            $img = $thunmbnailImg;
                            @endphp
                            @endif
                            @foreach($img as $key => $dimage)
                            <div class="tab-pane fade  @if($key=='0') show active @endif" id="image-{{ $key }}">
                                <a href="javascript:void(0)" class="long-img">
                                    <figure class="zoom" onmousemove="zoom(event)"
                                        style="background-image: url({{ asset('uploads/products/'.$dimage) }}">
                                        <img src="{{ asset('uploads/products/'.$dimage) }}" class="img-fluid"
                                            alt="image{{ $key }}">
                                    </figure>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <ul class="nav nav-tabs pro-page-slider owl-carousel owl-theme">
                            @if($product->gallary_image !=NULL)
                            @foreach($img as $yes => $dimage)
                            <li class="nav-item items">
                                <a class="nav-link @if($yes=='0') active @endif" data-bs-toggle="tab"
                                    href="#image-{{ $yes }}"><img src="{{ asset('uploads/products/'.$dimage) }}"
                                        class="img-fluid" alt="image"></a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-lg-6 col-xl-6 col-md-6 col-12 col-xs-12 pro-info">
                        <form id="option-choice-form" class="option-choice-form">
                            <h4>{{ $product->product_name }}</h4>
                            {{-- <div class="rating">
                                <i class="fa fa-star d-star"></i>
                                <i class="fa fa-star d-star"></i>
                                <i class="fa fa-star d-star"></i>
                                <i class="fa fa-star d-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div> --}}

                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <!--================= offer check start  ========================== -->
                            @if($isOfferActive==1)
                            <div class="pro-price">
                                <span class="new-price chosen_price" id="chosen_price"> ৳
                                    {{ $discounted_price }}
                                </span>
                                <input type="hidden" id="product_chosen_price" value="{{$discounted_price}}"
                                    name="price">
                                <span class="old-price"><del> ৳ {{ $product_main_price }}</del></span>
                                <div class="Pro-lable">
                                    <span class="p-discount"> - {{ $product_discount_name }}</span>
                                </div>
                            </div>
                            @else
                            <div class="pro-price">
                                <span class="new-price chosen_price" id="chosen_price"> ৳ {{ $product->product_price }}
                                </span>
                                <input type="hidden" id="product_chosen_price" value="{{$product->product_price}}"
                                    name="price">
                            </div>
                            @endif
                            <input type="hidden" name="product_sku" id="product_sku" value="{{$product->product_sku}}">
                            <!--================= offer check end ========================== -->
                            <div class="row mt-1 ">
                                <span class="available" style="font-size: 16px"> Measurements</span>
                                <div class="col">
                                    <ul class="service-ul pt-2">

                                        <li class="service-li mt-2">

                                            @if($product->hight != null)
                                            <span> Hight :{{ $product->hight }}</span>
                                            @endif
                                            @if($product->width != null)
                                            <span style="margin-left: 30px"> Width :{{ $product->width }}</span>
                                            @endif
                                        </li>

                                        <li class="service-li mt-2">
                                            @if($product->length != null)
                                            <span> Length :{{ $product->length }}</span>
                                            @endif
                                            @if($product->depth != null)
                                            <span style="margin-left: 30px"> Depth :{{ $product->depth }}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @if(($product->have_a_warranty =="1"|| $product->have_a_warranty ==1)&&
                            $product->warranty_name!="none")
                            <div class="pro-availabale">
                                <span class="available">{{ $product->warranty_name }}:</span>
                                <span class="pro-instock">{{ $product->warranty_year}} Years
                                </span>
                            </div>
                            @endif

                            <div class="pro-availabale">
                                <span class="available">Availability:</span>
                                <span class="pro-instock">{{ $product->product_qty > 0 ? "In stock" : "out of stock" }}
                                </span>
                            </div>
                            @if($product->product_qty > 0)
                            <span class="pro-details mb-2">Hurry up! only <span
                                    class="pro-number">{{ $product->product_qty }}</span> products left
                                in
                                stock!</span>
                            @endif
                            <!-- my code -->
                            <div id="product" class="mt-2">
                                <div class="form-group required " style="display: block;">
                                    @if (count(json_decode($product->colors)) > 0)
                                    <ul class="list-inline checkbox-color mb-1">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <li> <span
                                                style="font-weight: 600;position: relative;bottom: 12px;text-transform: capitalize; margin-left: 10px">Color:</span>
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
                            <strong>
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
                                                            style="font-weight: 600;position: relative;bottom: 12px;text-transform: capitalize;margin-left: 20px">
                                                            {{ $choice->title }}:
                                                        </li>
                                                        @foreach ($choice->options as $key => $option)
                                                        <li>
                                                            <input type="radio" id="{{ $choice->name }}-{{ $option }}"
                                                                name="{{$choice->name}}" value="{{$option}}"
                                                                @if($key==0) checked @endif>
                                                            <label
                                                                for="{{ $choice->name }}-{{ $option }}">{{$option}}</label>
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
                            <!-- my code end -->
                            <!-- add to cart data -->
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="name" value="{{$product->product_name}}">
                            <input type="hidden" name="image" value="{{$product->image}}">
                            <input type="hidden" name="shop_id" value="{{$product->shop_id}}">
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

                                        <input name="product_quantity" id="quantity" class="form-control" type="number"
                                            value="1">
                                        <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                                    </span>
                                </div>
                            </div>
                            <div class="pro-btn">
                                <a class="btn btn-style1 wishlist" style="padding: 7px 15px;"><i
                                        class="fa fa-heart"></i></a>
                                <a onclick="detailsToCart()" class="btn btn-style1 btn-style-asif"
                                    style="padding: 7px 15px;"><i class="fa fa-shopping-bag"></i>
                                    Add
                                    to
                                    cart</a>
                                @if(auth()->user())
                                <a class="btn btn-style1 " style="padding: 7px 15px;" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2" href="javascript:void(0)"
                                    onclick="customChooseProduct(this)" data-id="{{ $product->id }}"><i
                                        class="fa fa-rocket"></i> Custom Choise</a>
                                @else
                                <a class="btn btn-style1 " style="padding: 7px 15px;" href="{{ url('/login') }}"><i
                                        class="fa fa-rocket"></i> Custom Choise</a>
                                @endif

                            </div>
                        </form>

                        <div class="share">
                            <span class="share-lable">Share:</span>
                            <ul class="share-icn">
                                <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-12 col-md-12 col-xs-12 pro-shipping">

                @if ($ads)
                <a href="{{ $ads->url }}" target="_blank" class="ads_click" data-id="{{ $ads->id }}"
                    onclick="adClickCount();">
                    <img src="{{ asset('uploads/ads/' . $ads->image) }}" alt="" class="img-fluid" />
                </a>
                @endif
            </div>
            {{-- @include('frontend.product_details.delivery_info') --}}
        </div>
    </div>
</section>

@include('frontend.product_details.other')
@if($related_products->count() > 0)
<section class="h-t-products1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="category-head desktop section-b-padding">
                    <div class="category-btn flex-md-row-auto justify-content-between" style="display: flex">
                        <h2><span>Related Products</span></h2>
                    </div>
                </div>
                <div class="trending-products owl-carousel owl-theme">
                    @foreach($related_products as $product)
                    <div class="items">
                        @include('frontend.components.products.shop_page_product')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@include('frontend.include.shopping_head')

@endsection
@section('js')

<script>
    $(document).ready(function () {
        $('#option-choice-form input').on('change', function () {
            getVariantPrice();
        });
    });

    function getVariantPrice() {

        if ($('#option-choice-form input[id=quantity]').val() > 0) {
            $.ajax({
                type: "GET",
                url: "{{ route('products.variant_price')}}",
                data: $('#option-choice-form').serializeArray(),
                success: function (data) {
                    console.log(data);
                    if (data.isOfferActive == 1) {
                        $('#chosen_price').html('৳' + data.discounted_price);
                        $('#product_chosen_sku').val(data.sku);
                        $('#product_sku').val(data.sku);
                        $('#product_chosen_price').val(data.discounted_price);
                        $('.old-price').html('<del> ৳ ' + data.price + '</del>');
                    } else {
                        $('#chosen_price').html('৳' + data.price);
                        $('#product_chosen_sku').val(data.sku);
                        $('#product_sku').val(data.sku);
                    }
                }
            });
        }
    }
    getVariantPrice();

</script>
@endsection
