<header class="header-style-5 color-style" id="sticky-header">
    <div class="mobile-fix-option"></div>
    <div class="top-header top-header-theme">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>Welcome to {{
                                $companyInformation->company_name }}</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: {{
                                $companyInformation->mobile }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-contact text-end">
                        <ul>
                            <li><a data-bs-toggle="modal" data-bs-target="#order_track"><i class="fa fa-truck" aria-hidden="true"></i>Track Order</a></li>
                            <li class="pe-0"><a href="{{ url('/wishlist') }}" style="text-decoration: none; color: white; margin-right: 20px"><i class="fa fa-heart" aria-hidden="true"></i>Wishlist</a></li>
                        </li>
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                            My Account
                            <ul class="onhover-show-div">
                                @if(Auth::user())
                                @php
                                $companycheck=App\Models\VendorCompany::where('user_id',Auth::user()->id)->first();
                                @endphp
                                @if($companycheck)
                                <li><a href="{{ url('/vendor/dashboard') }}">Dashboard</a></li>
                                @else
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                @endif
                                @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">register</a></li>
                                @endif
                            </ul>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar d-block d-xl-none" onclick="openNav()">
                            <a href="javascript:void(0)">
                                <div class="bar-style" id="toggle-sidebar-res"><i class="fa fa-bars sidebar-bar"
                                        aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                        <div class="brand-logo">
                            <a href="{{ url('/') }}"><img style="height: 40px; width: 180px" src="{{asset('uploads/logo/'.$companyInformation->logo)}}"
                                class="img-fluid blur-up lazyload" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <form class="form_search" role="form" method="get" action="{{ url('/product-search') }}">
                            <input id="query search-autocomplete" name="q" type="search"
                                placeholder="Search any Device or Gadgets..." class="nav-search nav-search-field"
                                aria-expanded="true">
                            <button type="submit" class="btn-search">
                                <i class="ti-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="menu-right pull-right">
                        <div class="menu-right pull-right">
                            <nav class="text-start">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                            </nav>
                            <div class="top-header d-block">
                                <ul class="header-dropdown">
                                    @if(Auth::user())
                                        @php
                                        $companycheck=App\Models\VendorCompany::where('user_id',Auth::user()->id)->first();
                                        @endphp
                                        @if($companycheck)
                                        <li class="mobile-wishlist"><a href="{{ url('/vendor/dashboard') }}"><img src="{{ asset('frontend') }}/assets/images/icon/white-icon/user.png" alt=""> </a></li>
                                        @else
                                        <li class="mobile-wishlist"><a href="{{ url('/dashboard') }}"><img src="{{ asset('frontend') }}/assets/images/icon/white-icon/user.png" alt=""> </a></li>
                                        @endif

                                        @else
                                        <li class="mobile-wishlist"><a href="{{ route('login') }}"><img src="{{ asset('frontend') }}/assets/images/icon/white-icon/user.png" alt=""> </a></li>
                                        @endif
                                    
                                </ul>
                            </div>
                        </div>




















                        <nav class="text-start">
                            <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                        </nav>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search d-xl-none d-inline-block">
                                        <div><img src="{{asset('frontend')}}/assets/images/icon/search.png"
                                                onclick="openSearch()" class="img-fluid blur-up lazyload" alt=""> <i
                                                class="ti-search" onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()"
                                                    title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <input type="search" class="form-control"
                                                                            placeholder="Search a Product" name="">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart" id="cart_section">

                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    <div class="category-menu d-none d-xl-block h-100">
                        <div id="toggle-sidebar" class="toggle-sidebar">
                            <i class="fa fa-bars sidebar-bar"></i>
                            <h5 class="mb-0">shop by category</h5>
                        </div>
                    </div>
                    <div class="sidenav fixed-sidebar marketplace-sidebar">
                        <nav>
                            <div>
                                <div class="sidebar-back text-start d-xl-none d-block"><i
                                        class="fa fa-angle-left pe-2" aria-hidden="true"></i> Back</div>
                            </div>
                            <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                <!-- first foreach -->
                                @forelse ($maincate as $category)
                                <li> <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}">{{
                                        $category->name
                                        }}</a>
                                    <!-- 2nd foreach -->
                                    @if($category->subCategory->count() > 0)
                                    <ul>
                                        @forelse ($category->subCategory as $sub_category)
                                        <li><a
                                                href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}">{{
                                                $sub_category->name }}</a>
                                            <!-- 3rd foreach -->
                                            @if($sub_category->reSubCategory->count() > 0)
                                            <ul>
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
                                        </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                    @endif
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 position-unset">
                    <div class="main-nav-center">
                        <nav class="text-start">
                            <!-- Sample menu definition -->
                            <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                <li>
                                    <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2"
                                            aria-hidden="true"></i></div>
                                </li>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/shop') }}">Shop</a></li>
                                <li><a href="{{ url('/11-offer') }}">11 Offer</a></li>
                                <li><a href="{{ url('/22-offer') }}">22 Offer</a></li>
                                <li><a href="{{ url('/special-offer') }}">Special Offer</a></li>

                                @php
                                $fixcate=App\Models\Category::where('id',2)->with(['subCategory'])->first();
                                @endphp
                                <li><a href="{{ url('/category/'.$fixcate->slug.'/'.$fixcate->id) }}">Eview Mall</a>
                                    @if($fixcate->subCategory->count() > 0)
                                    <ul>
                                        @forelse ($fixcate->subCategory as $sub_category)
                                        <li><a
                                                href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}">{{
                                                $sub_category->name }}</a>
                                            <!-- 3rd foreach -->
                                            @if($sub_category->reSubCategory->count() > 0)
                                            <ul>
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
                                        </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                    @endif
                                </li>
                                <li><a href="{{ url('/all-vendors') }}">Vendor</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</header>