<div class="header-bottom-area mobile">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="main-menu-area">
                    <div class="main-navigation navbar-expand-xl">
                        <div class="box-header menu-close">
                            <button class="close-box" type="button"><i class="ion-close-round"></i></button>
                        </div>
                        <!-- menu start -->
                        <div class="navbar-collapse" id="navbarContent01">
                            <div class="megamenu-content">
                                <div class="mainwrap">
                                    <ul class="main-menu">
                                        <li class="menu-link parent">
                                            <a href="{{ url('/') }}" class="link-title">
                                                <span class="sp-link-title">Home</span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                        </li>

                                        <li class="menu-link parent">
                                            <a href="javascript:void(0)" class="link-title">
                                                <span class="sp-link-title">Categories</span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <a href="#collapse-mega-menu1" data-bs-toggle="collapse"
                                                class="link-title link-title-lg">
                                                <span class="sp-link-title">Categories</span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-submenu mega-menu collapse" id="collapse-mega-menu1">
                                                @forelse ($maincate as $category)
                                                <li class="megamenu-li parent">
                                                    <h2 class="sublink-title">{{$category->name}}</h2>
                                                    <a href="#collapse-sub-mega-menu1" data-bs-toggle="collapse"
                                                        class="sublink-title sublink-title-lg">
                                                        <span>{{$category->name}}</span>
                                                        @if($category->subCategory->count() > 0)
                                                        <i class="fa fa-angle-down"></i>
                                                        @endif
                                                    </a>
                                                    @if($category->subCategory->count() > 0)

                                                    <ul class="dropdown-supmenu collapse" id="collapse-sub-mega-menu1">
                                                        @forelse ($category->subCategory as $sub_category)
                                                        <li class="supmenu-li"><a
                                                                href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}">{{ $sub_category->name }}</a>
                                                        </li>
                                                        @empty
                                                        @endforelse
                                                    </ul>
                                                    @endif
                                                </li>
                                                @empty
                                                @endforelse

                                            </ul>
                                        </li>

                                        <li class="menu-link">
                                            <a href="{{ url('/shop') }}" class="link-title">
                                                <span class="sp-link-title">Shop</span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ url('/11-offer') }}" class="link-title">
                                                <span class="sp-link-title">11 offer</span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ url('/22-offer') }}" class="link-title">
                                                <span class="sp-link-title">22 offer</span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ url('/special-offer') }}" class="link-title">
                                                <span class="sp-link-title">Special offer</span>
                                            </a>
                                        </li>
                                        <li class="menu-link ">
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
                                <a href="javascript:void(0)"><img src="{{ asset('frontend') }}/image/icon_contact.png"
                                        class="img-fluid" alt="image-icon"></a>
                            </div>
                            <div class="image-content">
                                <span class="hot-l">Hotline:</span>
                                <span>{{
                                    $companyInformation->mobile }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
