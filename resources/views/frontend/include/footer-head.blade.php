<section class="footer-flying-head">
    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-white">
        <div class="container">
            <div class="header-main">
                <div class="header-element right-block-box">
                    <ul class="shop-element"
                        style="padding-left: 30px; padding-right: 30px;margin-top: 5px; margin-bottom: 5px;">

                        <li class="side-wrap wishlist-wrap padding-20">
                            <a href="javascript:void(0)" class="header-wishlist" title="wishlist">
                                <span class="wishlist-icon"><i class="fa fa-cog" style="font-size: 25px;"
                                        aria-hidden="true"></i></span>

                            </a>
                        </li>
                        <li class="side-wrap user-wrap padding-20">
                            <div class="acc-desk">
                                <div class="user-icon">
                                    <a href="{{ Auth::user() ? url('/dashboard') : url('/login')}}"
                                        class="user-icon-desk">
                                        <span><i class="icon-user"></i></span>
                                    </a>
                                </div>

                            </div>
                            <div class="acc-mob">
                                <a href="{{ Auth::user() ? url('/dashboard') : url('/login')}}" class="user-icon">
                                    <span><i class="icon-user"></i></span>
                                </a>
                            </div>
                        </li>
                        <li class="side-wrap wishlist-wrap padding-20">
                            <a href="{{ url('/wishlist') }}" class="header-wishlist" title="wishlist">
                                <span class="wishlist-icon"><i class="icon-heart"></i></span>

                            </a>
                        </li>
                        <li class="side-wrap cart-wrap padding-20">
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
            </div>
        </div>
    </nav>
</section>
