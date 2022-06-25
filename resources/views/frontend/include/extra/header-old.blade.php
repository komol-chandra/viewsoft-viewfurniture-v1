    <!-- top notificationbar start -->
    <section class="top1">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="top-home">
                        <li class="top-home-li">
                            <!-- currency start -->
                            <div class="currency">
                                <span class="currency-head">
                                    <p class="top-slogn"><span class="top-c"><a data-bs-toggle="modal"
                                                data-bs-target="#order_track"><i class="fa fa-truck"
                                                    aria-hidden="true"></i>
                                                Track Order</a></span></p>
                                </span>

                            </div>
                            <!-- currency end -->
                            <!-- mobile search start -->
                            <div class="r-search">
                                <a href="#r-search-modal" class="search-popuup" data-bs-toggle="modal"><i
                                        class="fa fa-search"></i></a>
                                <div class="modal fade" id="r-search-modal">
                                    {{-- <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form class="form_search" role="form" method="get"
                                                    action="{{ url('/product-search') }}">

                                    <div class="m-drop-search">
                                        <input type="text" name="q" type="search"
                                            placeholder="Search products, brands or advice">
                                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>


                                    </div>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        style="margin-left: 20px; margin-right: 20px"><i
                                            class="ion-close-round"></i></button>



                                    </form>

                                </div>
                            </div>
                </div> --}}

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="m-drop-search">
                                <form class="form_search" role="form" method="get"
                                    action="{{ url('/product-search') }}">
                                    <input type="text" name="search" placeholder="Search products, brands or advice">
                                    <button class="search-btn" type="button"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal"><i
                                    class="ion-close-round"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile search end -->
        </li>
        <li class="top-home-li t-content">
            <!-- offer text start -->
            <div class="top-content">

                {{-- <p class="top-slogn"><span class="top-c"><a data-bs-toggle="modal" data-bs-target="#order_track"><i
                                class="fa fa-truck" aria-hidden="true"></i>
                            Track Order</a></span></p> --}}
            </div>
            <!-- offer text end -->
        </li>
        </ul>
        </div>
        </div>
        </div>
    </section>
    <!-- top notificationbar end -->
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
                                        class="img-fluid asif " height="50px">
                                </a>
                            </div>
                            <div class="header-element search-wrap">
                                <form class="form_search" role="form" method="get"
                                    action="{{ url('/product-search') }}">
                                    <input type="text" name="q" type="search" placeholder="Search product.">
                                    <button type="submit" class="custom_search_btn"><i
                                            class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!-- search end -->
                            <!-- header-icon start -->
                            <div class="header-element right-block-box">
                                <ul class="shop-element">

                                    <li class="side-wrap nav-toggler">

                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarContent">
                                            <span class="line"></span>
                                        </button>
                                    </li>
                                    <li class="side-wrap">

                                    </li>
                                    <li class="side-wrap user-wrap">
                                        <div class="acc-desk">
                                            <div class="user-icon">
                                                <a href="{{ Auth::user() ? url('/dashboard') : url('/login')}}"
                                                    class="user-icon-desk">
                                                    <span><i class="icon-user"></i></span>
                                                </a>
                                            </div>
                                            <div class="user-info">
                                                <span class="acc-title">Account</span>
                                                <div class="account-login">
                                                    @if(Auth::user())
                                                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                                                    @else
                                                    <a href="{{ url('/register') }}">Register</a>
                                                    <a href="{{ url('/login') }}">Log in</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acc-mob">
                                            <a href="{{ Auth::user() ? url('/dashboard') : url('/login')}}"
                                                class="user-icon">
                                                <span><i class="icon-user"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap wishlist-wrap">
                                        <a href="{{ url('/wishlist') }}" class="header-wishlist" title="wishlist">
                                            <span class="wishlist-icon"><i class="icon-heart"></i></span>

                                        </a>
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
                            <!-- header-icon end -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-area">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="main-menu-area">
                                <div class="main-navigation navbar-expand-xl">
                                    <div class="box-header menu-close">
                                        <button class="close-box" type="button"><i class="ion-close-round"></i></button>
                                    </div>
                                    <!-- menu start -->
                                    <div class="navbar-collapse" id="navbarContent">
                                        <div class="megamenu-content">
                                            <div class="mainwrap">
                                                <ul class="main-menu">
                                                    <li class="menu-link parent">
                                                        <a href="javascript:void(0)" class="link-title">
                                                            <span class="sp-link-title">Categories</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <a href="#blog-style" data-bs-toggle="collapse"
                                                            class="link-title link-title-lg">
                                                            <span class="sp-link-title">Categories</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-submenu sub-menu collapse" id="blog-style">
                                                            @forelse ($maincate as $category)

                                                            <li class="submenu-li">
                                                                <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                                                    class="g-l-link"><span>{{$category->name}}</span>
                                                                    @if($category->subCategory->count() > 0)
                                                                    <i class="fa fa-angle-right"></i>
                                                                    @endif
                                                                </a>
                                                                <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                                                    data-bs-toggle="collapse"
                                                                    class="sub-link"><span>{{$category->name}}</span>
                                                                    @if($category->subCategory->count() > 0)
                                                                    <i class="fa fa-angle-right"></i>
                                                                    @endif</a>
                                                                <!-- 2nd foreach -->
                                                                @if($category->subCategory->count() > 0)
                                                                <ul class="collapse blog-style-1" id="blog-style03">
                                                                    @forelse ($category->subCategory as $sub_category)
                                                                    <li>
                                                                        <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                                            class="sub-style"><span>{{$sub_category->name }}</span>@if($sub_category->reSubCategory->count()
                                                                            > 0)
                                                                            <i class="fa fa-angle-right"></i>
                                                                            @endif</a>
                                                                        <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                                            data-bs-toggle="collapse"
                                                                            class="blog-sub-style"><span>{{$sub_category->name }}
                                                                            </span>@if($sub_category->reSubCategory->count()
                                                                            >
                                                                            0)
                                                                            <i class="fa fa-angle-right"></i>
                                                                            @endif</a>
                                                                        <!-- 3rd foreach -->
                                                                        @if($sub_category->reSubCategory->count() > 0)
                                                                        <ul class="grid-style collapse" id="grid1">
                                                                            @forelse ($sub_category->reSubCategory as
                                                                            $sub_child_category)
                                                                            <li><a
                                                                                    href="{{ url('/re-sub-category/'.$sub_child_category->slug.'/'.$sub_child_category->id) }}">{{
                                                                $sub_child_category->name }}</a></li>
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


                                                    @php
                                                    $fixcate=App\Models\Category::where('id',2)->with(['subCategory'])->first();
                                                    @endphp
                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/category/'.$fixcate->slug.'/'.$fixcate->id) }}"
                                                            class="link-title">
                                                            <span class="sp-link-title">Eview
                                                                Mall</span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <a href="#blog-style" data-bs-toggle="collapse"
                                                            class="link-title link-title-lg">
                                                            <span class="sp-link-title">Eview
                                                                Mall</span>
                                                            @if($fixcate->subCategory->count() > 0)
                                                            <i class="fa fa-angle-down"></i>@endif
                                                        </a>
                                                        @if($fixcate->subCategory->count() > 0)

                                                        <ul class="dropdown-submenu sub-menu collapse" id="blog-style">
                                                            @forelse ($fixcate->subCategory as $sub_category)
                                                            <li class="submenu-li">
                                                                <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                                    class="g-l-link"><span>{{$sub_category->name }}</span>
                                                                    @if($sub_category->reSubCategory->count() > 0)
                                                                    <i class="fa fa-angle-right"></i>
                                                                    @endif
                                                                </a>
                                                                <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                                    data-bs-toggle="collapse" class="sub-link"><span>{{
                                                                        $sub_category->name }}</span>
                                                                    @if($sub_category->reSubCategory->count() > 0)
                                                                    <i class="fa fa-angle-right"></i>
                                                                    @endif
                                                                </a>
                                                                <!-- 2nd foreach -->
                                                                @if($sub_category->reSubCategory->count() > 0)
                                                                <ul class="collapse blog-style-1" id="blog-style03">
                                                                    @forelse ($sub_category->reSubCategory as
                                                                    $sub_child_category)
                                                                    <li>
                                                                        <a href="{{ url('/re-sub-category/'.$sub_child_category->slug.'/'.$sub_child_category->id) }}"
                                                                            class="sub-style"><span>{{$sub_category->name }}</span>@if($sub_category->reSubCategory->count()
                                                                            > 0)
                                                                            <i class="fa fa-angle-right"></i>
                                                                            @endif</a>
                                                                        <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                                            data-bs-toggle="collapse"
                                                                            class="blog-sub-style"><span>{{$sub_category->name }}
                                                                            </span>
                                                                            @if($sub_category->reSubCategory->count()
                                                                            > 0)
                                                                            <i class="fa fa-angle-right"></i>
                                                                            @endif</a>
                                                                        <!-- 3rd foreach -->
                                                                        @if($sub_category->reSubCategory->count() > 0)
                                                                        <ul class="grid-style collapse" id="grid1">
                                                                            @forelse ($sub_category->reSubCategory as
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

                                                        @endif
                                                    </li>


                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/shop') }}" class="link-title">
                                                            <span class="sp-link-title">Shop</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/11-offer') }}" class="link-title">
                                                            <span class="sp-link-title">11 offer</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/22-offer') }}" class="link-title">
                                                            <span class="sp-link-title">22 offer</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/special-offer') }}" class="link-title">
                                                            <span class="sp-link-title">Special offer</span>
                                                        </a>
                                                    </li>

                                                    <li class="menu-link parent">
                                                        <a href="{{ url('/all-vendors') }}" class="link-title">
                                                            <span class="sp-link-title">Vendors</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- menu end -->
                                    <div class="img-hotline">
                                        <div class="image-line">
                                            <a href="javascript:void(0)"><img
                                                    src="{{ asset('frontend') }}/image/icon_contact.png"
                                                    class="img-fluid" alt="image-icon"></a>
                                        </div>
                                        <div class="image-content">
                                            <span class="hot-l">Hotline:</span>
                                            <span>{{ $companyInformation->mobile ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mini-cart" id="cart_section">

        </div>
    </header>
    <!-- header end -->

    <!-- mobile menu start -->
    @include('frontend.include.mobile_nav')
    <!-- mobile menu end -->
