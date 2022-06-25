@extends('layouts.frontend')
@section('title', 'Home')
@section('content')
<!--======================= slider start ==============================  -->
<section class="slider">
    <div class="home-slider owl-carousel owl-theme">
        @foreach($allSlider as $slider)
        <div class="items">
            <div class="img-back" style="background-image:url({{asset('uploads/slider/'.$slider->image)}});">
                <div class="h-s-content slide-c-l">
                    {{-- <span>Summer vage sale</span> --}}
                    <h1>{{ $slider->title }}</h1>
                    <a href="{{ url('/shop') }}" class="btn btn-style1">Shop now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!--======================= bannder start ==============================  -->
@if($allBanner->count() > 0)
<section class="t-banner1 section-tb-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="home-offer-banner">
                    @foreach($allBanner as $banners)
                    <div class="o-t-banner">
                        <a href="{{$banners->url}}" class="image-b">
                            <img class="img-fluid" src="{{ asset('uploads/banner/'.$banners->image) }}"
                                alt="banner image">
                        </a>
                        <div class="o-t-content">
                            <h6>{{$banners->title}}</h6>
                            <h6>{{$banners->discount}}</h6>
                            <a href="{{$banners->url}}" class="btn btn-style1">Shop</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!--======================= category start ==============================  -->
<section class="category-img1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="home-category owl-carousel owl-theme">
                    @foreach ($allCategory as $category)
                    <div class="items">
                        <div class="h-cate">
                            <div class="c-img">
                                <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                    class="home-cate-img">
                                    <img class="img-fluid img_laz"
                                        data-original="{{asset('uploads/category/'.$category->image)}}" alt="cate-image"
                                        style="height: 120px; width: 120px">
                                    <span class="cat-title">{{ $category->name }}</span>
                                </a>
                            </div>
                            <span class="cat-num">{{ $category->product_count }} Products</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!--======================= bestsell products start ==============================  -->
@if($bestSellProducts->count() > 0)
<section class="h-t-products1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="category-head desktop section-b-padding">
                    {{-- <div class="section-title">
                        <h2><span>Shop by categories</span></h2>
                    </div> --}}
                    <div class="category-btn flex-md-row-auto justify-content-between" style="display: flex">
                        <h2><span>Top sell Product</span></h2>
                        <a href="{{ url('/section','bestsellproduct') }}" class="btn-style3" style="float: right">See
                            all</a>
                    </div>

                </div>
                <div class="trending-products owl-carousel owl-theme">
                    @foreach($bestSellProducts as $product)
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
<!--======================= bestsell products start ==============================  -->
@if($trendingProducts->count() > 0)
<section class="h-t-products1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="category-head desktop section-b-padding">
                    {{-- <div class="section-title">
                        <h2><span>Shop by categories</span></h2>
                    </div> --}}
                    <div class="category-btn flex-md-row-auto justify-content-between" style="display: flex">
                        <h2><span>Trending Products</span></h2>
                        <a href="{{ url('/section','trandingproduct') }}" class="btn-style3" style="float: right">See
                            all</a>
                    </div>

                </div>
                <div class="trending-products owl-carousel owl-theme">
                    @foreach($trendingProducts as $product)
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
<!--======================= bestsell products start ==============================  -->
@if($featureProducts->count() > 0)
<section class="h-t-products1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="category-head desktop section-b-padding">
                    {{-- <div class="section-title">
                        <h2><span>Shop by categories</span></h2>
                    </div> --}}
                    <div class="category-btn flex-md-row-auto justify-content-between" style="display: flex">
                        <h2><span>Feature Products</span></h2>
                        <a href="{{ url('/section','featureproduct') }}" class="btn-style3" style="float: right">See
                            all</a>
                    </div>

                </div>
                <div class="trending-products owl-carousel owl-theme">
                    @foreach($featureProducts as $product)
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
<!--======================= newProducts start ==============================  -->
@if($newProducts->count() > 0)
<section class="h-t-products1 section-t-padding section-b-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="category-head desktop section-b-padding">
                    {{-- <div class="section-title">
                        <h2><span>Shop by categories</span></h2>
                    </div> --}}
                    <div class="category-btn flex-md-row-auto justify-content-between" style="display: flex">
                        <h2><span>Fresh Product</span></h2>
                        <a href="{{ url('/section','topCollectionProducts') }}" class="btn-style3"
                            style="float: right">See
                            all</a>
                    </div>

                </div>
                <div class="trending-products owl-carousel owl-theme">
                    @foreach($newProducts as $product)
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




















{{-- <section class="home-countdown1">
    <div class="back-img " style="background-image: url({{ asset('frontend') }}/image/dealbanner.jpg);">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="deal-content">
                <h2>Deal Of The Day!</h2>
                <span class="deal-c">We offer a hot deal offer every festival</span>
                <ul class="contdown_row">
                    <li class="countdown_section">
                        <span id="days" class="countdown_timer">254</span>
                        <span class="countdown_title">Days</span>
                    </li>
                    <li class="countdown_section">
                        <span id="hours" class="countdown_timer">11</span>
                        <span class="countdown_title">Hours</span>
                    </li>
                    <li class="countdown_section">
                        <span id="minutes" class="countdown_timer">33</span>
                        <span class="countdown_title">Minutes</span>
                    </li>
                    <li class="countdown_section">
                        <span id="seconds" class="countdown_timer">36</span>
                        <span class="countdown_title">Seconds</span>
                    </li>
                </ul>
                <a href="grid-list.html" class="btn btn-style1">Shop collection</a>
            </div>
        </div>
    </div>
</div>
</div>
</section> --}}


{{-- <section class="our-products-tab section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title">
                    <h2>Our products</h2>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home">BESTSELLER </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile">TRANDING PRODUCTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact">TOP
                                PRODUCTS</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content pro-tab-slider">
                    <div class="tab-pane fade show active" id="home">
                        <div class="home-pro-tab swiper-container">
                            <div class="swiper-wrapper">
                                @forelse ($bestsellproduct as $product)
                                <div class="swiper-slide">
                                    <div class="h-t-pro">
                                        @include('frontend.components.products.shop_page_product')
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="swiper-buttons">
                            <div class="content-buttons">
                                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                                    aria-disabled="false"></div>
                                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button"
                                    aria-label="Previous slide" aria-disabled="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <div class="home-pro-tab swiper-container">
                            <div class="swiper-wrapper">
                                @forelse ($trandingproduct as $product)
                                <div class="swiper-slide">
                                    <div class="h-t-pro">
                                        @include('frontend.components.products.shop_page_product')
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>

                        </div>
                        <div class="swiper-buttons">
                            <div class="content-buttons">
                                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                                    aria-disabled="false"></div>
                                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button"
                                    aria-label="Previous slide" aria-disabled="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact">
                        <div class="home-pro-tab swiper-container">
                            <div class="swiper-wrapper">
                                @forelse ($topProducts as $product)
                                <div class="swiper-slide">
                                    <div class="h-t-pro">
                                        @include('frontend.components.products.shop_page_product')
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="swiper-buttons">
                            <div class="content-buttons">
                                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                                    aria-disabled="false"></div>
                                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button"
                                    aria-label="Previous slide" aria-disabled="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
