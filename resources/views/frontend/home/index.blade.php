@extends('layouts.frontend')
@section('title', 'Home')
@section('content')
@include('frontend.include.category_section')

<!-- ================== slider start ====================-->
<section class="main-slider">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="slider-area">
                    <div class="swiper-container" id="home-slider-09">
                        <div class="swiper-wrapper">
                            @foreach($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="slider-image"
                                    style="background-image:url({{asset('uploads/slider/'.$slider->image)}});">
                                    <div class="slider-text">

                                        <a href="{{ url('/shop') }}" class="slider-btn btn-style1">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-buttons">
                        <a href="javascript:void(0)" class="swiper-prev-slider"><i class="ti-angle-left"></i></a>
                        <a href="javascript:void(0)" class="swiper-next-slider"><i class="ti-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===================== banner grid start ====================== -->
<section class="section-tb-padding grid-banner">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="organic-food-fresh-banner">
                    @foreach($banners as $banner)
                    <div class="offer-banner">
                        <a href="{{$banner->url}}" class="banner-hover">
                            <img data-original="{{ asset('uploads/banner/'.$banner->image) }}" alt="offer-banner"
                                class="img-fluid img_laz">
                        </a>
                        <div class="banner-content">
                            <a href="{{$banner->url}}" class="btn-style2">Shop now</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===================== header ads start ====================== -->
{{-- @if ($headerAds)
<section class="news-letter1">
    <div class="container">
        <div class="col-md-12 row">
            <a href="{{ $headerAds->url }}" class="header_click" target="_blank" data-id="{{ $headerAds->id }}"
onclick="headerCount();">
<img src="{{ asset('uploads/ads/' . $headerAds->image) }}" alt="" class="img-fluid add_imz"
    style="height: 110px;width: 100%" />
</a>
</div>
</div>
</section>
@endif --}}
<!-- ================== Trending product start ============================-->
@if($trendingProducts->count() > 0)

<section class="featured-product section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>
                        <span>Trending product</span>
                    </h2>
                </div>
                <div class="swiper-container" id="featured-9">
                    <div class="swiper-wrapper">
                        @foreach($trendingProducts as $product)
                        @include('frontend.components.products.shop_page_product')
                        @endforeach

                    </div>
                </div>
                <div class="featured-btn section-t-padding">
                    <a href="{{ url('/section','trandingproduct') }}" class="btn-style3">See all</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ================== featured product start ============================-->
@if($featureProducts->count() > 0)

<section class="featured-product section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>
                        <span>Featured product</span>
                    </h2>
                </div>
                <div class="swiper-container" id="featured-9">
                    <div class="swiper-wrapper">
                        @foreach($featureProducts as $product)
                        @include('frontend.components.products.shop_page_product')
                        @endforeach

                    </div>
                </div>
                <div class="featured-btn section-t-padding">
                    <a href="{{ url('/section','featureproduct') }}" class="btn-style3">See all</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ================== featured product start ============================-->
@if($topCollectionProducts->count() > 0)

<section class="featured-product section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>
                        <span>Top Collection product</span>
                    </h2>
                </div>
                <div class="swiper-container" id="featured-9">
                    <div class="swiper-wrapper">
                        @foreach($topCollectionProducts as $product)
                        @include('frontend.components.products.shop_page_product')
                        @endforeach

                    </div>
                </div>
                <div class="featured-btn section-t-padding">
                    <a href="{{ url('/section','topCollectionProducts') }}" class="btn-style3">See all</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ================== best sell product start ============================-->
@if($bestSellProducts->count() > 0)

<section class="featured-product section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>
                        <span>Best Sell product</span>
                    </h2>
                </div>
                <div class="swiper-container" id="featured-9">
                    <div class="swiper-wrapper">
                        @foreach($bestSellProducts as $product)
                        @include('frontend.components.products.shop_page_product')
                        @endforeach

                    </div>
                </div>
                <div class="featured-btn section-t-padding">
                    <a href="{{ url('/section','bestsellproduct') }}" class="btn-style3">See all</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ================== best sell product start ============================-->
@if($usedProducts->count() > 0)
<section class="featured-product section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>
                        <span>Used product</span>
                    </h2>
                </div>
                <div class="swiper-container" id="featured-9">
                    <div class="swiper-wrapper">
                        @foreach($usedProducts as $product)
                        @include('frontend.components.products.shop_page_product')
                        @endforeach

                    </div>
                </div>
                <div class="featured-btn section-t-padding">
                    <a href="{{ url('/section','usedproduct') }}" class="btn-style3">See all</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!--======================= footer ads start ==============================  -->
{{-- @if ($footerAds)
<section class="news-letter1">
    <div class="container">
        <div class="col-md-12 row">
            <a href="{{ $footerAds->url }}" class="footer_add_click" target="_blank" data-id="{{ $footerAds->id }}"
onclick="footerCount();">
<img src="{{ asset('uploads/ads/' . $footerAds->image) }}" alt="" class="img-fluid add_imz"
    style="height: 110px;width: 100%" />
</a>
</div>
</div>
</section>
@endif --}}

<!--================== pop-up add start ===================-->
@php
$today = Carbon\Carbon::now()->format('Y-m-d');
$userIp = App\Models\UserIp::where('user_ip', Request::ip())->where('date', $today)->first();
@endphp
@if ($popupAds && $userIp == null)
<div class="vegist-popup animated modal fadeIn" id="myModal1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup-content">
                    <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close" class="close-btn"><i
                            class="ion-close-round"></i></a>
                    <div class="pop-up-newsletter"
                        style="background-image: url({{ asset('uploads/ads/' . $popupAds->image) }});">
                        <div class="logo-content">
                        </div>
                        <div class="subscribe-area">
                            <a href="{{ $popupAds->url }}" target="_blank" data-id="{{ $popupAds->id }}"
                                onclick="popupCount();" class="btn btn-style1 popup_click">click
                                Here {{ $userIp }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="check_ip" name="user_ip" value="{{ Request::ip() }}">
<script>
    $(document).ready(function () {
        checkUserCookie();
    });

    function checkUserCookie() {
        var ip = $('#check_ip').val();
        $.ajax({
            url: "{{url('/check-cookie/')}}/" + ip,
            type: 'get',
            success: function (data) {

            }
        });
    }

</script>
@endif

<script>
    function footerCount() {
        var id = $('.footer_add_click').attr("data-id");
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

    function headerCount() {
        var id = $('.header_click').attr("data-id");
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

    function popupCount() {
        var id = $('.popup_click').attr("data-id");
        $.ajax({
            url: "{{ url('/ads_click') }}/" + id,
            type: 'get',
            success: function (data) {
                if (data) {
                    console.log('increased');
                } else {
                    console.log(error)
                }
            }
        })
    }

</script>
@endsection
