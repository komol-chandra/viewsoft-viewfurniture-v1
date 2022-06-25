<!-- footer start -->
<section class="footer-one section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer-bottom">
                    <div class="footer-link" id="footer-accordian">
                        <div class="f-link footer-logo">
                            <a href="index9.html">
                                <img data-original="{{ asset('uploads/logo/'.$companyInformation->logo) }}"
                                    class="img-fluid img_laz" alt="image" style="width: 160px">

                            </a>
                            <div class="address">
                                <span>{{ $companyInformation->company_address ?? 'N/A' }}</span>
                            </div>
                            <div class="call-mail">
                                <a href="tel:1-800-222-000">{{ $companyInformation->mobile ?? 'N/A' }}</a>
                                <a
                                    href="mailto:{{ $companyInformation->email ?? 'N/A' }}">{{ $companyInformation->email ?? 'N/A' }}</a>
                            </div>
                        </div>
                        <div class="f-link">
                            <h2 class="h-footer">Categories</h2>
                            <a href="#t-cate" data-bs-toggle="collapse" class="h-footer">
                                <span>Categories</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="f-link-ul collapse" id="t-cate" data-bs-parent="#footer-accordian">
                                @forelse ($limitCategory as $category)
                                <li class="f-link-ul-li"><a
                                        href="{{ url('/category/'.$category->slug.'/'.$category->id) }}">{{$category->name}}</a>
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                        <div class="f-link">
                            <h2 class="h-footer">Services</h2>
                            <a href="#services" data-bs-toggle="collapse" class="h-footer">
                                <span>Services</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="f-link-ul collapse" id="services" data-bs-parent="#footer-accordian">
                                <li class="f-link-ul-li"><a href="{{ url('/about-us') }}">About us</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/privacy-policy') }}">Privacy policy</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/terms-conditions') }}">Terms & conditions</a>
                                </li>
                                <li class="f-link-ul-li"><a href="{{ route('blogs') }}">Blogs</a></li>
                            </ul>
                        </div>
                        <div class="f-link">
                            <h2 class="h-footer">My account</h2>
                            <a href="#privacy" data-bs-toggle="collapse" class="h-footer">
                                <span>Service</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="f-link-ul collapse" id="account" data-bs-parent="#footer-accordian">
                                @if(Auth::user())

                                <li class="f-link-ul-li"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="f-link-ul-li"><a href="#">Order history</a></li>
                                @else
                                <li class="f-link-ul-li"><a href="{{ route('login') }}">Login</a></li>
                                <li class="f-link-ul-li"><a href="{{ route('register') }}">Register</a></li>
                                @endif
                                <li class="f-link-ul-li"><a href="{{ url('/products/cart') }}">My cart</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/wishlist') }}">My wishlist</a></li>

                                <li class="f-link-ul-li"><a data-bs-toggle="modal" data-bs-target="#order_track">Track
                                        Order</a></li>
                            </ul>
                        </div>
                        <div class="f-link footer-social">
                            <h2 class="h-footer">Social media</h2>
                            <ul class="social-ul">
                                <li class="social-li">
                                    <a target="_blank" href="{{ $icon->skype ?? '#' }}" class="f-icn-link"><i
                                            class="fa fa-skype"></i></a>
                                    <a target="_blank" href="{{ $icon->facebook ?? '#' }}" class="f-icn-link"><i
                                            class="fa fa-facebook-f"></i></a>
                                    <a target="_blank" href="{{ $icon->google_plus ?? '#' }}" class="f-icn-link"><i
                                            class="fa fa-google-plus"></i></a>
                                    <a target="_blank" href="{{ $icon->linkend ?? '#' }}" class="f-icn-link"><i
                                            class="fa fa-linkedin"></i></a>
                                    <a target="_blank" href="{{ $icon->youtube ?? '#' }}" class="f-icn-link"><i
                                            class="fa fa-youtube"></i></a>

                                </li>
                            </ul>
                            <div class="pay">
                                <h2 class="h-footer">User & Vendor Offer</h2>
                                <div class="pay-img">
                                    <a href="javascript:void(0)" style="color: green">Note:If you Update Your
                                        Profile
                                        You will Get 2500tk Singup Bonus!</a>
                                    <a href="javascript:void(0)" style="color: green">Note: If you
                                        Register a Vendor
                                        !You will Get 10,000tk Singup Bonus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer end -->

<!-- copyright start -->
<section class="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="copyrighta-ul">
                    <li class="copyrighta-li">
                        <span class="store-info text-center">Copyright <i class="fa fa-copyright"></i>
                            <script type="text/javascript">
                                document.write(new Date().getFullYear())

                            </script>
                            all rights
                            reserved to {{ $companyInformation->company_name }}
                        </span>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</section>
<!-- copyright end -->
