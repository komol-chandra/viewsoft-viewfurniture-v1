<section class="top-menubar">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="menu-slider">
                    <div class="vegamenu-content">
                        <a href="#vega-menu" data-bs-toggle="collapse" class="vegamenu-title">
                            <span class="menu-icon"><i class="ti-layout-grid2"></i></span>
                            <span class="menu-cat-title">Categories</span>
                            <span class="menu-down-icon"><i class="ion-ios-arrow-down"></i></span>
                        </a>
                        <div class="main-wrap collapse" id="vega-menu">
                            <ul class="vega-menu">
                                @foreach ($maincate as $category)
                                <li class="menu-link parent">
                                    <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                        class="link-title">
                                        <img src="{{ asset('uploads/category/'.$category->image) }}" alt="menu-image"
                                            style="height: 30px; width: 30px">
                                        <span>{{$category->name}}</span>
                                        @if($category->subCategory->count() > 0)
                                        <i class="fa fa-angle-down"></i>
                                        @endif
                                    </a>
                                    <a href="#{{ $category->slug }}" data-bs-toggle="collapse"
                                        class="left-mega-menu-xl">
                                        <img src="{{ asset('uploads/category/'.$category->image) }}" alt="menu-image"
                                            style="height: 30px; width: 30px">
                                        <span>{{$category->name}}</span>
                                        @if($category->subCategory->count() > 0)
                                        <i class="fa fa-angle-down"></i>
                                        @endif
                                    </a>
                                    <!-- 2nd foreach -->
                                    @if($category->subCategory->count() > 0)
                                    <ul class="dropdown-submenu collapse" id="{{ $category->slug }}">
                                        @foreach ($category->subCategory as $sub_category)
                                        <li class="submenu-li parant">
                                            <h6>{{$sub_category->name }}</h6>
                                            <a href="{{ url('/sub-category/'.$sub_category->slug.'/'.$sub_category->id) }}"
                                                data-bs-toggle="collapse" class="left-mega-menu-xl">
                                                <span>{{$sub_category->name }}</span>
                                                @if($sub_category->reSubCategory->count() > 0)
                                                <i class="fa fa-angle-down"></i>
                                                @endif
                                            </a>
                                            <!-- 3rd foreach -->
                                            @if($sub_category->reSubCategory->count() > 0)
                                            <ul class="submenu-megamenu-link collapse" id="left-menu-b">
                                                @foreach ($sub_category->reSubCategory as
                                                $sub_child_category)
                                                <li><a
                                                        href="{{ url('/re-sub-category/'.$sub_child_category->slug.'/'.$sub_child_category->id) }}">{{
                                                            $sub_child_category->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                        </li>
                                        @endforeach
                                        <li class="left-menu-link left-menu-image">
                                            <img src="{{ asset('uploads/category/'.$category->image) }}"
                                                alt="drop-image" style="height: 250px; width: 250px">
                                        </li>
                                    </ul>
                                    @endif
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="head-categry">
                        <div class="swiper-container" id="top-category">
                            <div class="swiper-wrapper">
                                @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    <div class="top-cat">
                                        <a href="{{ url('/category/'.$category->slug.'/'.$category->id) }}"
                                            class="cat-url">
                                            <img data-original="{{ asset('uploads/category/'.$category->image) }}"
                                                class="img-fluid img_laz" alt="image">
                                            <span class="title">{{$category->name}}</span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="swiper-buttons">
                            <a href="javascript:void(0)" class="swiper-prev-cat"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)" class="swiper-next-cat"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
