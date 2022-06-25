<!-- top notificationbar start -->
<section class="top-2">
    <div class="container">
        <div class="row ">
            <div class="col">
                <ul class="top-home">
                    <li class="top-home-li t-content">
                        <div class="top-content">
                            <ul class="top-url">
                                <li class="top-li">
                                    <a href="{{ url('/about-us') }}">About</a>
                                    <a href="{{ url('/terms-conditions') }}">Terms & conditions</a>
                                    <a href="javascript:void(0)">Help</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="top-home-li">
                        <!-- login start -->
                        <div class="currency">
                            <div class="currency-drop">
                                <ul class="cry">
                                    <li class="eur-head">
                                        <span class="eur">account <i class="fa fa-angle-down"></i></span>
                                        <ul class="all-currency account-details">
                                            @if(Auth::user())
                                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                            <li><a href="#">Order history</a></li>
                                            <li><a href="{{ url('/products/cart') }}">My cart</a></li>
                                            <li><a href="{{ url('/wishlist') }}">My wishlist</a></li>
                                            @else
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- login end -->
                        <!-- wishlist start -->
                        <div class="currency top-wishlist">
                            <a href="{{ url('/wishlist') }}">Wishlist</a>
                        </div>
                        <!-- wishlist end -->
                        <!-- currency start -->
                        <div class="currency">
                            <div class="currency-drop">
                                <ul class="cry">
                                    <li class="eur-head">
                                        <span class="eur"><a data-bs-toggle="modal" data-bs-target="#order_track"><i
                                                    class="fa fa-truck" aria-hidden="true"></i>
                                                Track Order</a></span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- currency start -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- top notificationbar start -->

<!-- header start -->
<header class="header-area">
    <div class="header-main-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-main">
                        <!-- logo start -->
                        <div class="header-element logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('uploads/logo/'.$companyInformation->logo) }}" alt="logo-image"
                                    class="img-fluid " style="height: 60px; width: 160px">
                            </a> </div> <!-- logo end -->
                        <!-- main menu start -->
                        <div class="header-element megamenu-content">
                            <div class="mainwrap">
                                <ul class="main-menu">
                                    <li class="menu-link parent">
                                        <a href="{{ url('/') }}" class="link-title">
                                            <span class="sp-link-title">Home</span>
                                        </a>
                                    </li>
                                    <li class="menu-link parent">
                                        <a href="#" class="link-title">
                                            <span class="sp-link-title">Categories</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <a href="#blog-style" data-bs-toggle="collapse"
                                            class="link-title link-title-lg">
                                            <span class="sp-link-title">Catgegories</span>

                                            <i class="fa fa-angle-down"></i>
                                        </a>

                                        <ul class="dropdown-submenu sub-menu collapse" id="blog-style">
                                            @forelse ($maincate as $category)
                                            <li class="submenu-li">
                                                <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                                    class="g-l-link"><span>{{$category->name }}</span>
                                                    @if($category->reSubCategory->count() > 0)
                                                    <i class="fa fa-angle-right"></i>
                                                    @endif
                                                </a>
                                                <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                                    data-bs-toggle="collapse" class="sub-link"><span>{{
                                                        $category->name }}</span>
                                                    @if($category->subCategory->count() > 0)
                                                    <i class="fa fa-angle-right"></i>
                                                    @endif
                                                </a>
                                                <!-- 2nd foreach -->
                                                @if($category->subCategory->count() > 0)
                                                <ul class="collapse blog-style-1" id="blog-style03">
                                                    @forelse ($category->subCategory as
                                                    $subCategory)
                                                    <li>
                                                        <a href="{{ url('/sub-category/'.$subCategory->slug.'/'.$subCategory->id) }}"
                                                            class="sub-style"><span>{{$subCategory->name }}</span>@if($subCategory->reSubCategory->count()
                                                            > 0)
                                                            <i class="fa fa-angle-right"></i>
                                                            @endif</a>
                                                        <a href="{{ url('/sub-category/'.$subCategory->slug.'/'.$subCategory->id) }}"
                                                            data-bs-toggle="collapse"
                                                            class="blog-sub-style"><span>{{$subCategory->name }}
                                                            </span>
                                                            @if($subCategory->reSubCategory->count()
                                                            > 0)
                                                            <i class="fa fa-angle-right"></i>
                                                            @endif</a>
                                                        <!-- 3rd foreach -->
                                                        @if($subCategory->reSubCategory->count() > 0)
                                                        <ul class="grid-style collapse" id="grid1">
                                                            @forelse ($subCategory->reSubCategory as
                                                            $sub_child_category)
                                                            <li><a
                                                                    href="{{ url('/re-sub-category/'.$sub_child_category->slug.'/'.$sub_child_category->id) }}">{{
                                                                        $sub_child_category->name }}</a>
                                                            </li>
                                                            @empty
                                                            @endforelse
                                                        </ul>
                                                        @endif
                                                        <!-- 3rd foreach -->
                                                    </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                                @endif
                                                <!-- 2nd foreach -->
                                            </li>
                                            @empty
                                            @endforelse
                                        </ul>

                                    </li>
                                    <li class="menu-link parent">
                                        <a href="{{ url('/shop') }}" class="link-title">
                                            <span class="sp-link-title">Shop</span>
                                        </a>
                                    </li>
                                    <li class="menu-link parent">
                                        <a href="#" class="link-title">
                                            <span class="sp-link-title">Offers</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <a href="#blog-style" data-bs-toggle="collapse"
                                            class="link-title link-title-lg">
                                            <span class="sp-link-title">Offers</span>

                                            <i class="fa fa-angle-down"></i>
                                        </a>

                                        <ul class="dropdown-submenu sub-menu collapse" id="blog-style">

                                            <li class="submenu-li">
                                                <a href="{{ url('/11-offer') }}" class="g-l-link"><span>11 offer</span>
                                                </a>
                                                <a href="{{ url('/11-offer') }}" data-bs-toggle="collapse"
                                                    class="sub-link"><span>11 offer</span>
                                                </a>
                                            </li>

                                            <li class="submenu-li">
                                                <a href="{{ url('/special-offer') }}" class="g-l-link"><span>Special
                                                        offer</span>
                                                </a>
                                                <a href="{{ url('/special-offer') }}" data-bs-toggle="collapse"
                                                    class="sub-link"><span>Special offer</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-link parent">
                                        <a href="{{ url('/all-vendors') }}" class="link-title">
                                            <span class="sp-link-title">Seller</span>
                                        </a>
                                    </li>
                                    <li class="menu-link parent">
                                        <a href="{{ url('/contact-us') }}" class="link-title">
                                            <span class="sp-link-title">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- main menu end -->
                        <!-- header icon start -->




                        <div class="header-element right-block-box">
                            <ul class="shop-element">
                                <li class="side-wrap search-descktop">
                                    <form class="form_search" role="form" method="get"
                                        action="{{ url('/product-search') }}">

                                        <input type="text" name="q" placeholder="Search products, brands or advice">
                                        <button class="search-btn" type="button"><i class="icon-magnifier"></i></button>
                                    </form>
                                </li>
                                <li class="side-wrap nav-toggler">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarContent">
                                        <span class="line"></span>
                                    </button>
                                </li>
                                <li class="side-wrap search-wrap">
                                    <div class="search-rap">
                                        <a href="#search-modal" class="search-popuup" data-bs-toggle="modal"><i
                                                class="ion-ios-search-strong"></i></a>
                                    </div>
                                </li>
                                <li class="side-wrap cart-wrap">
                                    <div class="shopping-widget">
                                        <div class="shopping-cart">
                                            <a href="javascript:void(0)" class="cart-count">
                                                <span class="cart-icon-wrap">
                                                    <span class="cart-icon"><i class="icon-handbag"></i></span>
                                                    <span id="cart-total" class="bigcounter cart_count"></span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- header icon end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu start -->
    <div class="header-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="main-menu-area">
                        <div class="main-navigation navbar-expand-xl">
                            <div class="box-header menu-close">
                                <button class="close-box" type="button"><i class="ion-close-round"></i></button>
                            </div>
                            <div class="navbar-collapse" id="navbarContent">
                                <div class="megamenu-content">
                                    <div class="mainwrap">
                                        <ul class="main-menu">
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Home</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#collapse-home" data-bs-toggle="collapse"
                                                    class="link-title link-title-lg">
                                                    <span class="sp-link-title">Home</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu sub-menu collapse" id="collapse-home">
                                                    <li class="submenu-li">
                                                        <a href="index1.html" class="submenu-link">Vegist home
                                                            01</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="../vegist-rtl/index1.html" class="submenu-link">Vegist
                                                            home 01 (RTL)</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="../vegist-box/index1.html" class="submenu-link">Vegist
                                                            home 01 (BOX)</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index2.html" class="submenu-link">Vegist home
                                                            02</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index3.html" class="submenu-link">Vegist home
                                                            03</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index4.html" class="submenu-link">Vegist home
                                                            04</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index5.html" class="submenu-link">Vegist home
                                                            05</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index6.html" class="submenu-link">Vegist home
                                                            06</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index7.html" class="submenu-link">Vegist home
                                                            07</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index8.html" class="submenu-link">Vegist home
                                                            08</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index9.html" class="submenu-link">Vegist home
                                                            09</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index10.html" class="submenu-link">Vegist home
                                                            10</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="index11.html" class="submenu-link">Vegist home
                                                            11</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Shop</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#collapse-mega-menu" data-bs-toggle="collapse"
                                                    class="link-title link-title-lg">
                                                    <span class="sp-link-title">Shop</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu mega-menu collapse" id="collapse-mega-menu">
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Fresh food</h2>
                                                        <a href="#collapse-sub-mega-menu" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Fresh food</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse"
                                                            id="collapse-sub-mega-menu">
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fruit
                                                                    & nut</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Snack
                                                                    food</a>
                                                            </li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Organics nut
                                                                    gifts</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Non-dairy</a>
                                                            </li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Mayonnaise</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Milk
                                                                    almond</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Mixedfruits</h2>
                                                        <a href="#collapse-fruits-menu" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Mixedfruits</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="collapse-fruits-menu">
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Oranges</a></li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Coffee
                                                                    creamers</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Ghee
                                                                    beverages</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Ranch
                                                                    salad</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Hemp
                                                                    milk</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Nuts &
                                                                    seeds</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Bananas & plantains</h2>
                                                        <a href="#collapse-banana-menu" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Bananas & plantains</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="collapse-banana-menu">
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fresh
                                                                    gala</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fresh
                                                                    berries</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fruit
                                                                    & nut</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fifts
                                                                    mixed
                                                                    fruits</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Oranges</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Oranges</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Apples berries</h2>
                                                        <a href="#collapse-apple-menu" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Apples berries</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="collapse-apple-menu">
                                                            <li class="supmenu-li"><a href="product-style-6.html">Pears
                                                                    produce</a>
                                                            </li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Bananas</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Natural
                                                                    grassbeab</a></li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fresh
                                                                    green
                                                                    orange</a></li>
                                                            <li class="supmenu-li"><a href="product-style-6.html">Fresh
                                                                    organic
                                                                    reachter</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Balckberry
                                                                    100%organic</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Pages</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#collapse-page-menu" data-bs-toggle="collapse"
                                                    class="link-title link-title-lg">
                                                    <span class="sp-link-title">Pages</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu sub-menu collapse" id="collapse-page-menu">
                                                    <li class="submenu-li">
                                                        <a href="about-us.html" class="submenu-link">About
                                                            us</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="javascript:void(0)"
                                                            class="g-l-link"><span>Account</span> <i
                                                                class="fa fa-angle-right"></i></a>
                                                        <a href="#account-menu01" data-bs-toggle="collapse"
                                                            class="sub-link"><span>Account</span> <i
                                                                class="fa fa-angle-down"></i></a>
                                                        <ul class="collapse blog-style-1" id="account-menu01">
                                                            <li>
                                                                <a href="order-history.html"
                                                                    class="sub-style"><span>Order</span></a>
                                                                <a href="order-history.html"
                                                                    class="blog-sub-style"><span>Order</span></a>
                                                                <a href="profile.html"
                                                                    class="sub-style"><span>Profile</span></a>
                                                                <a href="profile.html"
                                                                    class="blog-sub-style"><span>Profile</span></a>
                                                                <a href="pro-addresses.html"
                                                                    class="sub-style"><span>Address</span></a>
                                                                <a href="pro-addresses.html"
                                                                    class="blog-sub-style"><span>Address</span></a>
                                                                <a href="pro-wishlist.html"
                                                                    class="sub-style"><span>Wishlist</span></a>
                                                                <a href="pro-wishlist.html"
                                                                    class="blog-sub-style"><span>Wishlist</span></a>
                                                                <a href="pro-tickets.html" class="sub-style"><span>My
                                                                        tickets</span></a>
                                                                <a href="pro-tickets.html"
                                                                    class="blog-sub-style"><span>My
                                                                        tickets</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="billing-info.html" class="submenu-link">Billing
                                                            info</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="cancellation.html"
                                                            class="submenu-link">Cancellation</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="cart.html" class="submenu-link">Cart page</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="coming-soon.html" class="submenu-link">Coming-soon</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="faq's.html" class="submenu-link">Faq's</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="forgot-password.html" class="submenu-link">Forgot
                                                            passowrd</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="order-complete.html" class="submenu-link">Order
                                                            complete</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="tracking.html" class="submenu-link">Track
                                                            page</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="contact.html" class="submenu-link">Contact
                                                            us</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="payment-policy.html" class="submenu-link">Payment
                                                            policy</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="privacy-policy.html" class="submenu-link">privacy
                                                            policy</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="return-policy.html" class="submenu-link">Return
                                                            policy</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="terms-conditions.html" class="submenu-link">Terms &
                                                            conditions</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="wishlist.html" class="submenu-link">Wishlist</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="sitemap.html" class="submenu-link">Sitemap</a>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="fnf-page.html" class="submenu-link">4 not 4</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Blogs</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#blog-grid-style01" data-bs-toggle="collapse"
                                                    class="link-title link-title-lg">
                                                    <span class="sp-link-title">Blogs</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu sub-menu collapse" id="blog-grid-style01">
                                                    <li class="submenu-li">
                                                        <a href="javascript:void(0)" class="g-l-link"><span>Blog
                                                                grid</span> <i class="fa fa-angle-right"></i></a>
                                                        <a href="#blog-style-03" data-bs-toggle="collapse"
                                                            class="sub-link"><span>Blog grid</span> <i
                                                                class="fa fa-angle-down"></i></a>
                                                        <ul class="collapse blog-style-1" id="blog-style-03">
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-1" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-1">
                                                                    <li><a href="blog-style-1-3-grid.html">Blog
                                                                            3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-1-left-3-grid.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-1-right-3-grid.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-2" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-2">
                                                                    <li><a href="blog-style-2-3-grid.html">Blog
                                                                            3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-2-left-3-grid.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-2-right-3-grid.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-3" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-3">
                                                                    <li><a href="blog-style-3-grid.html">Blog 3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-3-left-grid-blog.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-3-right-grid-blog.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-4" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-4">
                                                                    <li><a href="blog-style-5-3-grid.html">Blog
                                                                            3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-5-left-3-grid.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-5-right-3-grid.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-5" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-5">
                                                                    <li><a href="blog-style-6-3-grid.html">Blog
                                                                            3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-6-left-3-grid.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-6-right-3-grid.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#grid-6" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="grid-6">
                                                                    <li><a href="blog-style-7-3-grid.html">Blog
                                                                            3
                                                                            grid</a></li>
                                                                    <li><a href="blog-style-7-left-grid-blog.html">Left
                                                                            blog 3 grid</a></li>
                                                                    <li><a href="blog-style-7-right-grid-blog.html">Right
                                                                            blog 3 grid</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="javascript:void(0)" class="g-l-link"><span>Blog
                                                                list</span> <i class="fa fa-angle-right"></i></a>
                                                        <a href="#blog-list-style" data-bs-toggle="collapse"
                                                            class="sub-link"><span>Blog list</span> <i
                                                                class="fa fa-angle-down"></i></a>
                                                        <ul class="collapse blog-style-1" id="blog-list-style">
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-1" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-1">
                                                                    <li><a href="blog-style-1-list.html">Blog
                                                                            list</a></li>
                                                                    <li><a href="blog-style-1-left-list.html">Left
                                                                            blog list</a></li>
                                                                    <li><a href="blog-style-1-right-list.html">Right
                                                                            blog list</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-2" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-2">
                                                                    <li><a href="blog-style-2-list.html">Blog
                                                                            list</a></li>
                                                                    <li><a href="blog-style-2-left-list.html">Left
                                                                            blog list</a></li>
                                                                    <li><a href="blog-style-2-right-list.html">Right
                                                                            blog list</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-3" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-3">
                                                                    <li><a href="blog-style-3-list.html">Blog
                                                                            list</a></li>
                                                                    <li><a href="blog-style-3-left-list-blog.html">Left
                                                                            blog list</a></li>
                                                                    <li><a href="blog-style-3-right-list-blog.html">Right
                                                                            blog list</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-4" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-4">
                                                                    <li><a href="blog-style-5-list-blog.html">Blog
                                                                            list</a></li>
                                                                    <li><a href="blog-style-5-left-list.html">Left
                                                                            blog list</a></li>
                                                                    <li><a href="blog-style-5-right-list.html">Right
                                                                            blog list</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-5" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-5">
                                                                    <li><a href="blog-style-6-list-blog.html">Blog
                                                                            list</a></li>
                                                                    <li><a href="blog-style-6-left-list-blog.html">Left
                                                                            blog list</a></li>
                                                                    <li><a href="blog-style-6-right-list-blog.html">Right
                                                                            blog list</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-list-6" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-list-6">
                                                                    <li><a href="blog-style-7-list-blog.html">Blog
                                                                            list</a></li>
                                                                    <!--list-->
                                                                    <li><a href="blog-style-7-left-list-blog.html">Left
                                                                            blog list</a></li>
                                                                    <!--list-->
                                                                    <li><a href="blog-style-7-right-list-blog.html">Right
                                                                            blog list</a></li>
                                                                    <!--list-->
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="javascript:void(0)" class="g-l-link"><span>Blog
                                                                details</span> <i class="fa fa-angle-right"></i></a>
                                                        <a href="#blog-details-style" data-bs-toggle="collapse"
                                                            class="sub-link"><span>Blog Details</span> <i
                                                                class="fa fa-angle-down"></i></a>
                                                        <ul class="collapse blog-style-1 ex-width"
                                                            id="blog-details-style">
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-1" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        1</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-1">
                                                                    <li><a href="blog-style-1-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-1-left-details.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-1-right-details.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-2" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        2</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-2">
                                                                    <li><a href="blog-style-2-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-2-left-details.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-2-right-details.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-3" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        3</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-3">
                                                                    <li><a href="blog-style-3-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-3-left-blog-details.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-3-right-blog-details.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-4" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        4</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-4">
                                                                    <li><a href="blog-style-5-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-5-left-details.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-5-right-details.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-5" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        5</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-5">
                                                                    <li><a href="blog-style-6-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-6-left-details-blog.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-6-right-details-blog.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="sub-style"><span>Blog details style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <a href="#blog-details-6" data-bs-toggle="collapse"
                                                                    class="blog-sub-style"><span>Blog details
                                                                        style
                                                                        6</span><i class="fa fa-angle-right"></i></a>
                                                                <ul class="grid-style collapse" id="blog-details-6">
                                                                    <li><a href="blog-style-7-details.html">Blog
                                                                            details</a></li>
                                                                    <li><a href="blog-style-7-left-details.html">Left
                                                                            blog details</a></li>
                                                                    <li><a href="blog-style-7-right-details.html">Right
                                                                            blog details</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="submenu-li">
                                                        <a href="javascript:void(0)" class="g-l-link"><span>Center
                                                                blog</span> <i class="fa fa-angle-right"></i></a>
                                                        <a href="#center-b" data-bs-toggle="collapse"
                                                            class="sub-link"><span>Center blog</span> <i
                                                                class="fa fa-angle-down"></i></a>
                                                        <ul class="collapse blog-style-1" id="center-b">
                                                            <li>
                                                                <a href="blog-style-1-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        1</span></a>
                                                                <a href="blog-style-1-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        1</span></a>
                                                                <a href="blog-style-2-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        2</span></a>
                                                                <a href="blog-style-2-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        2</span></a>
                                                                <a href="blog-style-3-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        3</span></a>
                                                                <a href="blog-style-3-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        3</span></a>
                                                                <a href="blog-style-5-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        4</span></a>
                                                                <a href="blog-style-5-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        4</span></a>
                                                                <a href="blog-style-6-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        5</span></a>
                                                                <a href="blog-style-6-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        5</span></a>
                                                                <a href="blog-style-7-center-blog.html"
                                                                    class="sub-style"><span>Blog style
                                                                        6</span></a>
                                                                <a href="blog-style-7-center-blog.html"
                                                                    class="blog-sub-style"><span>Blog style
                                                                        6</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Feature</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#feature10" data-bs-toggle="collapse"
                                                    class="link-title link-title-lg">
                                                    <span class="sp-link-title">Feature</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu mega-menu collapse" id="feature10">
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Header style</h2>
                                                        <a href="#feature08" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Header style</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="feature08">
                                                            <li class="supmenu-li"><a href="header-style-1.html">Header
                                                                    style
                                                                    1</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-2.html">Header
                                                                    style
                                                                    2</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-3.html">Header
                                                                    style
                                                                    3</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-4.html">Header
                                                                    style
                                                                    4</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-5.html">Header
                                                                    style
                                                                    5</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-6.html">Header
                                                                    style
                                                                    6</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="header-style-7.html">Header
                                                                    style
                                                                    7</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Footer style</h2>
                                                        <a href="#feature07" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Footer style</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="feature07">
                                                            <li class="supmenu-li"><a href="footer-style-1.html">Footer
                                                                    style
                                                                    1</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-2.html">Footer
                                                                    style
                                                                    2</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-3.html">Footer
                                                                    style
                                                                    3</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-4.html">Footer
                                                                    style
                                                                    4</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-5.html">Footer
                                                                    style
                                                                    5</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-6.html">Footer
                                                                    style
                                                                    6</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="footer-style-7.html">Footer
                                                                    style
                                                                    7</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Product details</h2>
                                                        <a href="#feature06" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Product details</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="feature06">
                                                            <li class="supmenu-li"><a href="product.html">Product
                                                                    details style 1</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-2.html">Product details
                                                                    style 2</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-3.html">Product details
                                                                    style 3</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-4.html">Product details
                                                                    style 4</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-5.html">Product details
                                                                    style 5</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-6.html">Product details
                                                                    style 6</a></li>
                                                            <li class="supmenu-li"><a
                                                                    href="product-style-7.html">Product details
                                                                    style 7</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="megamenu-li parent">
                                                        <h2 class="sublink-title">Other style</h2>
                                                        <a href="#feature05" data-bs-toggle="collapse"
                                                            class="sublink-title sublink-title-lg">
                                                            <span>Other style</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-supmenu collapse" id="feature05">
                                                            <li class="supmenu-li"><a href="checkout-1.html">Checkout
                                                                    style 1</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="checkout-2.html">Checkout
                                                                    style 2</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="checkout-3.html">Checkout
                                                                    style 3</a>
                                                            </li>
                                                            <li class="supmenu-li"><a href="cart.html">Cart
                                                                    style
                                                                    1</a></li>
                                                            <li class="supmenu-li"><a href="cart-2.html">Cart
                                                                    style
                                                                    2</a></li>
                                                            <li class="supmenu-li"><a href="cart-3.html">Cart
                                                                    style
                                                                    3</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu end -->
    <!-- minicart start -->
    <div class="mini-cart" id="cart_section">
    </div>
    <!-- minicart end -->
    <!-- search start -->
    <div class="modal fade" id="search-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="search-content">
                                    <div class="search-engine">
                                        <input type="text" name="search" placeholder="Search products">
                                        <button class="search-btn" type="button"><i
                                                class="ion-ios-search-strong"></i></button>
                                    </div>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="ion-close-round"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search end -->
</header>
<!-- header end -->
