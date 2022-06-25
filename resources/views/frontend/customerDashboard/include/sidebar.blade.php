<div class="profile">

    @if(auth()->user()->cover != null)
    <div class="order-pro">
        <a href="javascript:void(0)"><img
                src="{{asset(auth()->user()->cover ? 'uploads/user/'.auth()->user()->cover : 'uploads/damo/no-img.png')}}"
                alt="img" class="img-fluid" style="height: 111px"></a>

    </div>
    @endif
    <div class="order-pro">
        <div class="pro-img">
            <a href="javascript:void(0)"><img
                    src="{{asset(auth()->user()->image ? 'uploads/user/'.auth()->user()->image : 'uploads/damo/no-img.png')}}"
                    alt="img" class="img-fluid" style="height: 111px; width: 111px"></a>
        </div>
        <div class="order-name">
            @php
            $davit_balance=
            App\Models\Wallet::where('user_id',Auth::user()->id)->where('amount_type','Dabit')->where('is_deleted',0)->sum('amount');
            $credit_balance=
            App\Models\Wallet::where('user_id',Auth::user()->id)->where('amount_type','Credit')->sum('amount');
            @endphp
            <h4>{{ Auth::user()->name }}</h4>
            <span>Joined {{ Auth::user()->created_at->format('M d Y') }}</span>
            <h6>Wallet Balance:
                {{$davit_balance + wallet(auth()->user()->id) - paidAmount(auth()->user()->id) - $credit_balance }} Tk
            </h6>
            @if(auth()->user()->is_vendor_approve == 1)
            <h6>Only Sell Balance:
                {{paidAmount(auth()->user()->id)}} Tk
            </h6>
            @endif

        </div>
    </div>
    <div class="text-center justify-content-center mb-3">

        <p>{{ auth()->user()->description }}</p>
    </div>
    <div class="order-his-page">
        <ul class="profile-ul">

            @php
            $id = auth()->user()->id;
            $cartOrder = App\Models\Order::where('customer_id',$id)->count();
            $requrestedOrder = App\Models\Order::where('company_id', 'like', "%{$id}%")->count();
            $custom_product_count =
            App\Models\CustomChoiseRequested::where('is_deleted','0')->where('is_approve','1')->where('user_id',auth()->user()->id)->count();
            @endphp
            <li class="profile-li"><a href="{{ url('/dashboard') }}"
                    class="@if(request()->routeIs('customer.dashboard*')) active @endif"><span>Dashboard</span></a>
            </li>
            <li class="profile-li"><a href="{{ url('/profile') }}"
                    class="@if(request()->routeIs('customer.profile*')) active @endif">Update Profile</a></li>

            <!-- =============== vendor part ==============-->
            @if(auth()->user()->is_vendor == 1)
            <li class="profile-li"><a href="{{ url('/vendor-bank-info') }}"
                    class="@if(request()->routeIs('vendor-bank-info*')) active @endif"><span>Update Bank Info</span>
                </a></li>
            <li class="profile-li"><a href="{{ url('/vendor/shop') }}"
                    class="@if(request()->routeIs('vendor.shop*')) active @endif">Shop</a></li>

            <li class="profile-li"><a href="{{ url('/vendor/product') }}"
                    class="@if(request()->routeIs('vendor.product*')) active @endif">Products</a></li>
            <li class="profile-li"><a href="{{ route('vendor.payment.history') }}"
                    class="@if(request()->routeIs('vendor.payment.history*')) active @endif"><span>Payment
                        History</span> </a></li>
            <li class="profile-li"><a href="{{ route('vendor.order') }}"
                    class="@if(request()->routeIs('vendor.order*')) active @endif"><span>Requested Orders</span> <span
                        class="pro-count">{{ $requrestedOrder }}</span></a></li>

            @endif
            @if(auth()->user()->is_vendor == 0)
            <li class="profile-li"><a href="{{ route('user.vendor.create') }}"
                    class="@if(request()->routeIs('user.vendor.create')) active @endif"><span>Became A Vendor</span>
                </a>
            </li>
            @endif
            <!-- =============== vendor part ==============-->

            <li class="profile-li"><a href="{{ route('customer.order') }}"
                    class="@if(request()->routeIs('customer.order*')) active @endif"><span>My Cart Orders</span> <span
                        class="pro-count">{{ $cartOrder }}</span></a></li>

            <li class="profile-li"><a href="{{ route('customer.custom-choose-product') }}"
                    class="@if(request()->routeIs('customer.custom-choose-product*')) active @endif"><span>Custom
                        Choose Products
                    </span> <span class="pro-count">{{ $custom_product_count }}</span></a></li>

            <li class="profile-li"><a href="{{ url('/password-change') }}"
                    class="@if(request()->routeIs('customer.passwordChange*')) active @endif">Password Change</a></li>
            <li class="profile-li"><a href="{{ route('logout') }}"><span>Logout</span></a></li>

        </ul>
    </div>
</div>
