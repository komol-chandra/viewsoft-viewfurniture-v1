<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.home*') ? 'active' : '' }}"
                    href="{{route('admin.home')}}">
                    <span class="menu-icon">
                        <i class="bi bi-house fs-3"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>




            <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                @if(request()->routeIs('admin.approve.product*')) here show 
                @elseif(request()->routeIs('admin.payment-request-list.*')) here show
                @elseif(request()->routeIs('admin.approve.product.*')) here show
                @elseif(request()->routeIs('admin.reject.product*')) here show
                @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">DAILY REPORT</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    @php
                    $payment_requests_count =
                    App\Models\WithdrawPayment::where('is_deleted',0)->where('paid_status',0)->count();
                    $vendor_requests_count =
                    App\Models\User::where('is_vendor', 1)->where('is_vendor_approve',
                    0)->where('is_deleted',0)->count();
                    $pendingcount=App\Models\Product::where('is_active',1)->where('is_deleted',0)->where('is_approve',0)->count();
                    $rejectcount=App\Models\Product::where('is_active',1)->where('is_deleted',0)->where('is_approve',2)->count();

                    $custom_product_count =
                    App\Models\CustomChoiseRequested::where('is_deleted','0')->where('is_approve','0')->count();

                    @endphp
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.customer-custom-choose-request *') ? 'active' : '' }}"
                            href="{{ route('admin.customer-custom-choose-request') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Custom Product Request<span class="badge bg-primary">{{ $custom_product_count
        }}</span></span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment-request-list *') ? 'active' : '' }}"
                            href="{{ route('admin.payment-request-list') }}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Payment Request &nbsp;&nbsp;<span class="badge bg-primary">{{ $payment_requests_count
        }}</span></span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.unapproved-vendor.index*') ? 'active' : '' }}"
                            href="{{ route('admin.unapproved-vendor.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Unapproved Vendor &nbsp;&nbsp;<span class="badge bg-primary">{{ $vendor_requests_count
        }}</span></span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.approve.product*') ? 'active' : '' }}"
                            href="{{route('admin.approve.product')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Product Approve &nbsp;&nbsp;<span class="badge bg-primary">{{ $pendingcount
                }}</span></span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.reject.product*') ? 'active' : '' }}"
                            href="{{route('admin.reject.product')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Product Rejected &nbsp;&nbsp;<span class="badge bg-primary">{{ $rejectcount
                }}</span></span>
                        </a>
                    </div>
                </div>
            </div>








            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if(request()->routeIs('admin.productreport*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">REPORT SECTION</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.productreport*') ? 'active' : '' }}"
                            href="{{ url('/admin/productreport') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Product Report</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.section-product-report*') ? 'active' : '' }}"
                            href="{{ url('/admin/section-product-report') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Section Wish Product </span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.orderreport*') ? 'active' : '' }}"
                            href="{{ url('/admin/orderreport') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Order Report</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.vendor-wish-order*') ? 'active' : '' }}"
                            href="{{ url('/admin/vendor-wish-order') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Vendor Wish Order Report</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.category-wish-sell*') ? 'active' : '' }}"
                            href="{{ url('/admin/category-wish-sell') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Category Best Sell Product</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.best-sell-report*') ? 'active' : '' }}"
                            href="{{ url('/admin/best-sell-report') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Best Sell Product</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.user-area-report*') ? 'active' : '' }}"
                            href="{{ url('/admin/user-area-report') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">user area report</span>
                        </a>
                    </div>



                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.user.list*') ? 'active' : '' }}"
                            href="{{route('admin.user.list')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.vendor.list*') ? 'active' : '' }}"
                            href="{{route('admin.vendor.list')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> Vendors</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion  @if(request()->routeIs('admin.order*')) here show  @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">PRODUCT ORDER</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.order.list')}}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{url('/admin/neworder/list')}}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{url('/admin/processingorder/list')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Processing Order</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.order.alldeleverorder')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Delivered Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.order.reject')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Reject Order</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{url('admin/commissionlist/index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Commission Order</span>
                        </a>
                    </div>



                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion  
                @if(request()->routeIs('admin.approve.allshop*')) here show  
                @elseif(request()->routeIs('admin.all-approved.product*')) here show  
                @elseif(request()->routeIs('admin.review*')) here show  
                @elseif(request()->routeIs('admin.vendor.list*')) here show  
                @elseif(request()->routeIs('admin.user.list*')) here show  
                
                @else
                @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">MAIN MODULES</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.approve.allshop*') ? 'active' : '' }}"
                            href="{{route('admin.approve.allshop')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">All Shops</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.all-approved.product*') ? 'active' : '' }}"
                            href="{{route('admin.all-approved.product')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">All Products</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.review*') ? 'active' : '' }}"
                            href="{{route('admin.review.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">All Reviews</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.vendor.list*') ? 'active' : '' }}"
                            href="{{route('admin.vendor.list')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">All Vendors</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.user.list*') ? 'active' : '' }}"
                            href="{{route('admin.user.list')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">All Users</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion  
                @if(request()->routeIs('admin.brand*')) here show  
                @elseif(request()->routeIs('admin.shopping-charge.*')) here show  
                @elseif(request()->routeIs('admin.color.*')) here show  
                @elseif(request()->routeIs('admin.about-shop-page-info.*')) here show  
                @elseif(request()->routeIs('admin.cuppon.*')) here show  
                @elseif(request()->routeIs('admin.blog.*')) here show  
                @elseif(request()->routeIs('admin.banner.*')) here show  
                @elseif(request()->routeIs('admin.slider.*')) here show  
                @elseif(request()->routeIs('admin.user-message.*')) here show  
                @elseif(request()->routeIs('admin.website-message.*')) here show  
                @else
                @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">WEBSITE SETUP</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.website-message.*') ? 'active' : '' }}"
                            href="{{route('admin.website-message.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Website Message</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.user-message.*') ? 'active' : '' }}"
                            href="{{route('admin.user-message.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">User Message</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.ads.*') ? 'active' : '' }}"
                            href="{{route('admin.ads.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Ads</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.brand.*') ? 'active' : '' }}"
                            href="{{route('admin.brand.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Brands</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.shopping-charge*') ? 'active' : '' }}"
                            href="{{route('admin.shopping-charge.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Shopping Charge List</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.shop-category*') ? 'active' : '' }}"
                            href="{{route('admin.shop-category.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Shop Categories</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.color*') ? 'active' : '' }}"
                            href="{{route('admin.color.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Colors</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.material*') ? 'active' : '' }}"
                            href="{{route('admin.material.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Material</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.finished-color*') ? 'active' : '' }}"
                            href="{{route('admin.finished-color.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Finished colors</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.about-shop-page-info*') ? 'active' : '' }}"
                            href="{{route('admin.about-shop-page-info.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Shop Page Info List</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.cuppon.index*') ? 'active' : '' }}"
                            href="{{route('admin.cuppon.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Coupons</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"
                            href="{{route('admin.blog.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Blogs</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}"
                            href="{{route('admin.banner.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Banners</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}"
                            href="{{route('admin.slider.index')}}">
                            <span class="menu-icon">
                                <i class="bi bi-house fs-3"></i>
                            </span>
                            <span class="menu-title">Sliders</span>
                        </a>
                    </div>
                </div>
            </div>








            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion  @if(request()->routeIs('admin.companyInformation*')) here show  @elseif(request()->routeIs('admin.seoInformation*')) here show  @elseif(request()->routeIs('admin.socialInformation*')) here show  @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">SETTINGS</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.companyInformation*') ? 'active' : '' }}"
                            href="{{route('admin.companyInformation')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Company Information</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.seoInformation*') ? 'active' : '' }}"
                            href="{{ route('admin.seoInformation') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Seo</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.socialInformation*') ? 'active' : '' }}"
                            href="{{ route('admin.socialInformation') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Social</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.about-us*') ? 'active' : '' }}"
                            href="{{ route('admin.about-us.update') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">About Us</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.contact-us*') ? 'active' : '' }}"
                            href="{{ route('admin.contact-us.update') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Contact Us</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.privacy-policy.update*') ? 'active' : '' }}"
                            href="{{ route('admin.privacy-policy.update') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Privacy Policy</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.terms-conditions.update*') ? 'active' : '' }}"
                            href="{{ route('admin.terms-conditions.update') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Terms & Conditions</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.product-upload-policy.update*') ? 'active' : '' }}"
                            href="{{ route('admin.product-upload-policy.update') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Product Upload Policy</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Category Family</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion  @if(request()->routeIs('admin.category*')) here show  @elseif(request()->routeIs('admin.seoInformation*')) here show  @elseif(request()->routeIs('admin.socialInformation*')) here show  @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">CATEGORY SECTION</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.category.create*') ? 'active' : '' }}"
                            href="{{url('admin/category/create')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> Category Create</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.category.index*') ? 'active' : '' }}"
                            href="{{ route('admin.category.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All Category</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if(request()->routeIs('admin.subcategory*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">SUBCATEGORY SECTION</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.subcategory.create*') ? 'active' : '' }}"
                            href="{{ url('/admin/subcategory/create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> SubCategory Create</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.subcategory.index*') ? 'active' : '' }}"
                            href="{{ url('/admin/subcategory/index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All SubCategory</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if(request()->routeIs('admin.resubcategory*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">RESUBCATEGORY SECTION</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.resubcategory.create*') ? 'active' : '' }}"
                            href="{{ url('/admin/resubcategory/create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> ReSubCategory Create</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.resubcategory.index*') ? 'active' : '' }}"
                            href="{{ url('/admin/resubcategory/index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All ReSubCategory</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if(request()->routeIs('admin.re-resubcategory*')) here show @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-layers fs-3"></i>
                    </span>
                    <span class="menu-title">RESUBCATEGORY TWO</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.re-resubcategory.create*') ? 'active' : '' }}"
                            href="{{ url('/admin/re-resubcategory/create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">ReSubCategory Two Create</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.re-resubcategory.index*') ? 'active' : '' }}"
                            href="{{ url('/admin/re-resubcategory/index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All ReSubCategory Two</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion @if(request()->routeIs('admin.re-re-resubcategory*')) here show @endif" ">
				<span class=" menu-link">
                <span class="menu-icon">
                    <i class="bi bi-layers fs-3"></i>
                </span>
                <span class="menu-title">RESUBCATEGORY THREE</span>
                <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.re-re-resubcategory.create*') ? 'active' : '' }}"
                            href="{{ url('/admin/re-re-resubcategory/create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">ReSubCategory Three Create</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.re-re-resubcategory.index*') ? 'active' : '' }}"
                            href="{{ url('/admin/re-re-resubcategory/index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All ReSubCategory Three</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
