<section class="footer-one section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer-service section-b-padding">
                    <ul class="service-ul">
                        <li class="service-li">
                            <a href="javascript:void(0)"><i class="fa fa-truck"></i></a>
                            <span>Delivery charge included</span>
                        </li>
                        <li class="service-li">
                            <a href="javascript:void(0)">
                                <i class="fa fa-credit-card"></i>
                            </a>
                            <span>Cash on delivery</span>
                        </li>
                        <li class="service-li">
                            <a href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                            <span>7 Days returns</span>
                        </li>
                        <li class="service-li">
                            <a href="javascript:void(0)"><i class="fa fa-headphones"></i></a>
                            <span>Online support</span>
                        </li>
                    </ul>
                </div>
                <div class="f-logo">
                    <ul class="footer-ul">
                        <li class="footer-li footer-logo">
                            <a href="{{ url('/') }}">
                                <img class="img-fluid" src="{{ asset('uploads/logo/'.$companyInformation->logo) }}"
                                    alt="" style="width: 150px">
                            </a>
                        </li>
                        <li class="footer-li footer-address">
                            <ul class="f-ul-li-ul">
                                <li class="footer-icon">
                                    <i class="ion-ios-location"></i>
                                </li>
                                <li class="footer-info">
                                    <h6>Address</h6>
                                    <span>{{ $companyInformation->company_address ?? 'N/A' }}</span>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li footer-contact">
                            <ul class="f-ul-li-ul">
                                <li class="footer-icon">
                                    <i class="ion-ios-telephone"></i>
                                </li>
                                <li class="footer-info">
                                    <h6>Contact</h6>
                                    <a href="tel:{{ $companyInformation->mobile ?? 'N/A' }}">Phone:
                                        {{ $companyInformation->mobile ?? 'N/A' }}</a>
                                    <a href="mailto:{{ $companyInformation->email ?? 'N/A' }}">Email:
                                        {{ $companyInformation->email ?? 'N/A' }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li footer-address">
                            <ul class="f-ul-li-ul">
                                <li class="footer-icon">
                                    <i class="ion-ios-help"></i>
                                </li>
                                <li class="footer-info">
                                    <h6>Help</h6>
                                    <span>24/7 support </span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="footer-bottom section-t-padding">
                    <div class="footer-link" id="footer-accordian">
                        <div class="f-link">
                            <h2 class="h-footer">Top categories</h2>
                            <a href="#t-cate" data-bs-toggle="collapse" class="h-footer">
                                <span>Top categories</span>
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
                            <a href="#account" data-bs-toggle="collapse" class="h-footer">
                                <span>My account</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="f-link-ul collapse" id="account" data-bs-parent="#footer-accordian">
                                @if(Auth::user())
                                @php
                                $companycheck=App\Models\VendorCompany::where('user_id',Auth::user()->id)->first();
                                @endphp
                                @if($companycheck)
                                <li class="f-link-ul-li"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="f-link-ul-li"><a href="#">Order history</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/products/cart') }}">My cart</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/wishlist') }}">My wishlist</a></li>
                                @else
                                <li class="f-link-ul-li"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="f-link-ul-li"><a href="#">Order history</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/products/cart') }}">My cart</a></li>
                                <li class="f-link-ul-li"><a href="{{ url('/wishlist') }}">My wishlist</a></li>
                                @endif
                                @else
                                <li class="f-link-ul-li"><a href="{{ route('login') }}">Login</a></li>
                                <li class="f-link-ul-li"><a href="{{ route('register') }}">Register</a></li>
                                @endif
                                <li class="f-link-ul-li"><a data-bs-toggle="modal" data-bs-target="#order_track">Track
                                        Order</a></li>
                            </ul>
                        </div>
                        <div class="f-link">
                            <h2 class="h-footer">User & Vendor Offer</h2>
                            <a href="#privacy" data-bs-toggle="collapse" class="h-footer">
                                <span>User & Vendor Offer</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="f-link-ul collapse" id="privacy" data-bs-parent="#footer-accordian">
                                <li class="f-link-ul-li text-green"><a href="javascript:void(0)"
                                        style="color: green">Note:If you Update Your
                                        Profile
                                        You will Get 1000tk Singup Bonus!</a></li>
                                <li class="f-link-ul-li"><a href="javascript:void(0)" style="color: green">Note: If you
                                        Register a Vendor
                                        !You will Get 10,000tk Singup Bonus</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer end -->
<!-- footer copyright start -->
<section class="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="f-bottom">
                    <li class="f-c f-copyright">
                        <p>Copyright <i class="fa fa-copyright"></i> <span id="">
                                <script type="text/javascript">
                                    document.write(new Date().getFullYear())

                                </script>
                            </span> all rights
                            reserved to {{ $companyInformation->company_name }}</p>
                    </li>
                    <li class="f-c f-social">
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
            </div>
        </div>
    </div>
</section>
<!-- footer copyright end -->
