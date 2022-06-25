{{-- @extends('layouts.frontend')
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


<style>
    #product .radio-type-button .option-content-box :hover {
        background: #ff5e00;
        border-color: #ff5e00;
        color: white;
        padding: 5px;
    }

    .checkbox-alphanumeric input:checked~label {
        transform: scale(1.1);
        border: 1px solid red;
    }

</style>
<style>
    /* Rounded sliders */
    .toggle-switch-slider.round {
        border-radius: 34px;
    }

    .toggle-switch-slider.round:before {
        border-radius: 50%;
    }

    .checkbox-alphanumeric::after,
    .checkbox-alphanumeric::before {
        content: '';
        display: table;
    }

    .checkbox-alphanumeric::after {
        clear: both;
    }

    .checkbox-alphanumeric input {
        left: -9999px;
        position: absolute;
    }

    .checkbox-alphanumeric label {
        width: 2.25rem;
        height: 2.25rem;
        float: left;
        padding: 0.375rem 0;
        margin-right: 0.375rem;
        display: block;
        color: #818a91;
        font-size: 0.875rem;
        font-weight: 400;
        text-align: center;
        background: transparent;
        text-transform: uppercase;
        border: 1px solid #e6e6e6;
        border-radius: 2px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
        transform: scale(0.95);
    }

    .checkbox-alphanumeric-circle label {
        border-radius: 100%;
    }

    .checkbox-alphanumeric label>img {
        max-width: 100%;
    }

    .checkbox-alphanumeric label:hover {
        cursor: pointer;
        border-color: #8193ff;
    }

    .checkbox-alphanumeric input:checked~label {
        transform: scale(1.1);
    }

    .checkbox-alphanumeric--style-1 label {
        width: auto;
        height: auto;
        text-align: center;
        line-height: 16px;
        padding-left: 12px;
        padding-right: 12px;
        border-radius: 2px;
    }

    .d-table.checkbox-alphanumeric--style-1 {
        width: 100%;
    }

    .d-table.checkbox-alphanumeric--style-1 label {
        width: 100%;
    }

    /* CUSTOM COLOR INPUT */
    .checkbox-color::after,
    .checkbox-color::before {
        content: '';
        display: table;
    }

    .checkbox-color::after {
        clear: both;
    }

    .checkbox-color input {
        left: -9999px;
        position: absolute;
    }

    .checkbox-color label {
        /* width: 2.25rem;
  height: 2.25rem; */
        width: 25px;
        height: 25px;
        float: left;
        padding: 0.375rem;
        margin-right: 0.375rem;
        display: block;
        font-size: 0.875rem;
        text-align: center;
        opacity: 0.7;
        border: 1px solid transparent;
        border-radius: 2px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
        transform: scale(0.95);
    }

    .checkbox-color-circle label {
        border-radius: 100%;
    }

    .checkbox-color label:hover {
        cursor: pointer;
        opacity: 1;
    }

    .checkbox-color input:checked~label {
        transform: scale(1.1);
        opacity: 1;
        position: relative;
    }

    .checkbox-color input:checked~label:after {
        content: "\f00c";
        font-family: "FontAwesome";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .list-inline checkbox-alphanumeric li {
        display: inline-block;
    }

    ul.list-inline.checkbox-color.mb-1 li {
        display: inline-block;
        margin-right: 10px;
    }

    ul.list-inline.checkbox-alphanumeric.checkbox-alphanumeric--style-1.mb-2 li {
        display: inline-block;
        margin-right: 10px;
    }

    ul.list-inline.checkbox-alphanumeric.checkbox-alphanumeric--style-1.mb-2 {
        position: relative;
        left: -27px;
    }

    ul.list-inline.checkbox-color.mb-1 {
        position: relative;
        left: -10px;
    }

</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>product </h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->
<!-- section start -->
<section>
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slick">

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

                        @foreach($img as $dimage)
                        <div>
                            <img class="lazy img-fluid blur-up lazyload image_zoom_cls-0"
                                src="{{ asset('uploads/products/'.$dimage) }}" alt="">
                        </div>
                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="slider-nav">
                                @if($product->gallary_image !=NULL)
                                @foreach($img as $dimage)
                                <div>
                                    <img src="{{ asset('uploads/products/'.$dimage) }}" alt=""
                                        class="lazy img-fluid blur-up lazyload">
                                </div>
                                @endforeach

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 rtl-text">
                    <div class="product-right">
                        <form id="cartsection">

                            <h2>{{ $product->product_name }}</h2>

                            @include('frontend.shop.product.offer-deltails-data')

                            <div class="product-buttons">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="name" value="{{$product->product_name}}">
                                <input type="hidden" name="product_sku" value="{{$product->product_sku}}">
                                <input type="hidden" name="image" value="{{$product->image}}">
                                <input type="hidden" name="discount_price" value="">
                                <input type="hidden" name="discount_title" value="">
                                <input type="hidden" name="shop_id" value="{{$product->shop_id}}">
                                <input type="hidden" name="product_sku" value="{{$product->product_sku}}">
                                <input type="hidden" name="user_id" value="{{ Request::ip() }}">
                                <a class="btn btn-solid hover-solid btn-animation" onclick="detailsToCart()">
                                    <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> add to cart</a>
                                <a class="btn btn-solid wishlist"><i class="fa fa-bookmark fz-16 me-2"
                                        aria-hidden="true"></i>wishlist</a>
                            </div>
                        </form>
                        <div class="product-count">
                            <ul>
                                <li>
                                    <img src="{{ asset('frontend')}}/assets/images/icon/truck.png" class="img-fluid"
                                        alt="image">
                                    <span class="lang">Cash On Delivery</span>
                                </li>
                            </ul>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">More info</h6>
                            <ul class="shipping-info">
                                <li>Qty: {{ $product->product_qty }}</li>
                                <li>Brand: {{ $product->product_brand }}</li>
                                @if($product->product_weight !=NULL) <li>Weight: {{ $product->product_weight }}</li>
                                @endif
                                @if($product->style !=NULL) <li>Style: {{ $product->style }}</li>@endif
                                @if($product->product_materials !=NULL) <li>Materials: {{ $product->product_materials }}
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">share it</h6>
                            <div class="product-icon">
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                        <div class="border-product">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->
<!-- product-tab starts -->
<section class="tab-product m-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                            href="#top-home" role="tab" aria-selected="true"><i
                                class="icofont icofont-ui-home"></i>Details</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                            href="#top-profile" role="tab" aria-selected="false"><i
                                class="icofont icofont-man-in-glasses"></i>Specification</a>
                        <div class="material-border"></div>
                    </li>
                </ul>
                <div class="tab-content nav-material" id="top-tabContent">
                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <div class="product-tab-discription">
                            {!! $product->product_details !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">

                        <div class="single-product-tables">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Qty</td>
                                        <td>{{ $product->product_qty }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>{{ $product->product_brand }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>
                                            @if($product->product_condition !=NULL){{ $product->product_condition }}
                                            @else Null
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <table>
                                <tbody>
                                    @if($product->style !=NULL)
                                    <tr>
                                        <td>Style</td>
                                        <td>
                                            {{ $product->style }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->product_materials !=NULL)
                                    <tr>
                                        <td>Materials</td>
                                        <td>
                                            {{ $product->product_materials }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->product_gender !=NULL)
                                    <tr>
                                        <td>Gender Type</td>
                                        <td>
                                            {{ $product->product_gender }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->age_group !=NULL)
                                    <tr>
                                        <td>Age Group </td>
                                        <td>
                                            {{ $product->age_group }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->product_weight !=NULL)
                                    <tr>
                                        <td>Weight</td>
                                        <td>
                                            {{ $product->product_weight }}
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- product-tab ends -->


<!-- product section start -->
<section class="section-b-space ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col-12 product-related">
                <h2>related products</h2>
            </div>
        </div>
        <div class="row search-product">
            @foreach($related_products as $key => $product)
            <div class="col-xl-2 col-md-4 col-6">
                @include('frontend.shop.product.basic-cart-product')
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

--}}
