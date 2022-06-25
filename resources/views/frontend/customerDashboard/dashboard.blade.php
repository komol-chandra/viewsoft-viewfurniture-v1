@extends('layouts.frontend')
@section('title', 'Profile')

@php
$checkwalletdata=App\Models\Wallet::where('user_id',Auth::user()->id)->where('wallet_type','signup_bonus')->first();
$checkvendorbonus=App\Models\Wallet::where('user_id',Auth::user()->id)->where('wallet_type','vendor_bonus')->first();

@endphp
@section('content')
<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <div class="continer">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/sale.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $totalOrderCount }}</h2>
                                                        <h5>Orders</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/homework.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $totalDeliveredOrderCount }}</h2>
                                                        <h5>Completed Order</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $totalProcessingOrderCount }}</h2>
                                                        <h5>Processing Order </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="col-md-12 vendor_verified_div">
                                            <div class="col-md-5">
                                                @if(auth()->user()->is_vendor_approve ==0 && auth()->user()->is_vendor
                                                == 1)
                                                <img src="{{ asset('uploads/damo/not-verified.png') }}"
                                                    class="vendor_verified_img">
                                                @endif
                                                @if(auth()->user()->is_vendor_approve ==1 && auth()->user()->is_vendor
                                                == 1)
                                                <img src="{{ asset('uploads/damo/verified.png') }}"
                                                    class="vendor_verified_img">
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">






                                </div>
                                <!-- ================ info card =========================-->
                                <div class="row">
                                    <div class="card col-md-12 mb-2">
                                        <div class="card-header justify-content-between" style="display: flex">
                                            <h5><span>Basic Notice</span></h5>

                                        </div>
                                        <div class="card-body">
                                            <!-- ====== user Singup Bonus ==========-->
                                            @if(!$checkwalletdata)
                                            <div class="row" style="display: flex">
                                                <div class="col-md-9 mb-2">
                                                    <p style="color:red">Note:If you Update Your Profile You will Get
                                                        1000tk
                                                        Singup
                                                        Bonus!</p>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <a href="{{ url('/profile') }}" class="btn btn-sm btn-primary"
                                                        style="float: right;">Edit
                                                        Profile</a>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- ====== Vendor Singup Bonus ==========-->

                                            @if(!$checkvendorbonus && auth()->user()->is_vendor == 0)
                                            <div class="row" style="display: flex">
                                                <div class="col-md-8 mb-2">
                                                    <p style="color:red">Note: If you Register a Vendor !You will Get
                                                        10,000tk Singup
                                                        Bonus</p>
                                                </div>
                                                <div class="col-md-4 mb-4 mt-2">
                                                    <a href="{{ route('user.vendor.create') }}"
                                                        class="btn btn-sm btn-primary" style="float: right;">Become
                                                        a
                                                        vendor</a>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- ====== Vendor Singup Bonus ==========-->
                                            @if(auth()->user()->is_vendor_approve ==0 && auth()->user()->is_vendor == 1)
                                            <div class="col-md-12 mb-3">
                                                <p style="color:red">Note: Your Are not approved By website Admin !
                                                    Please
                                                    Waiting for this process !</p>
                                            </div>
                                            @endif
                                            <div class="col-md-12 mb-2">
                                                <p style="color:red; margin-bottom: 10px"><span
                                                        style="color: black">Step 1 :</span> At first
                                                    your need to create
                                                    new shop . Please go to shop section & then create your shop and
                                                    wait for
                                                    admin approval. admin set the shop commission percentage (%) for
                                                    each product . </p>

                                                <p style="color:red; margin-bottom: 10px"> <span
                                                        style="color: black">Step 2 : </span>
                                                    Now go to Product Section and you can view your all product related
                                                    information. Now click on <span style="color: green">Add New
                                                        Product</span> . now you can add products .
                                                    after completing your product data you can click on <span
                                                        style="color: green">Back To Products</span> to wiew your
                                                    product list. now wait for admin product approval .
                                                </p>
                                            </div>





                                            </p>

                                        </div>
                                    </div>
                                    <div class="card col-md-12">
                                        <div class="card-header justify-content-between" style="display: flex">
                                            <h5><span>Basic Info</span></h5>

                                        </div>
                                        <div class="card-body">

                                            <p class="card-text card_text"> <span>Name : </span>
                                                {{ auth()->user()->name }}
                                            </p>
                                            <p class="card-text card_text"> <span>Age : </span>
                                                {{ auth()->user()->age }}
                                            </p>
                                            <p class="card-text card_text"> <span>Email : </span>
                                                {{ auth()->user()->email }}
                                            </p>
                                            <p class="card-text card_text"> <span>Phone : </span>
                                                {{ auth()->user()->phone }}
                                            </p>
                                            <p class="card-text card_text"> <span>Gender : </span>
                                                {{ auth()->user()->gender==1 ? "Male" : "Female" }}</p>
                                            <p class="card-text card_text"> <span>Division : </span>
                                                @if(auth()->user()->division != null)
                                                @php
                                                $division =
                                                Devfaysal\BangladeshGeocode\Models\Division::find(auth()->user()->division);
                                                @endphp
                                                {{ $division->name }}
                                                @else
                                                not set yet
                                                @endif

                                            </p>
                                            <p class="card-text card_text"> <span>City : </span>
                                                @if(auth()->user()->city != null)
                                                @php
                                                $city =
                                                Devfaysal\BangladeshGeocode\Models\District::find(auth()->user()->city);
                                                @endphp
                                                {{ $city->name }}
                                                @else
                                                not set yet
                                                @endif

                                            </p>
                                            <p class="card-text card_text"> <span>Full Address : </span>
                                                {{ auth()->user()->main_address }}
                                            </p>

                                        </div>
                                    </div>



                                </div>

                                <!-- ================ info card =========================-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
{{--
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Dashboard</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
</ol>
</nav>
</div>
</div>
</div>
</div>
<!-- breadcrumb End -->
<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.customerDashboard.include.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <div class="page-title">
                            <h2>My Dashboard</h2>
                        </div>
                        <div class="welcome-msg">
                            <p>Hello, {{ Auth::user()->name }} !</p>

                        </div>
                        <div class="box-account box-info">
                            <div class="box-head">
                                <h2>Account Information</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="box">
                                        <div class="box-title">
                                            <h3>Contact Information</h3><a href="{{ url('/profile') }}">Edit</a>
                                        </div>
                                        <div class="box-content">
                                            <h6>{{ Auth::user()->name }}</h6>
                                            <h6>{{ Auth::user()->email }}</h6>
                                            <h6>Your Address</h6>
                                            <address>{{ Auth::user()->main_address}}<br></address>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="box">
                                        <div class="box-title">
                                            <h3>Password</h3><a href="{{ url('/password-change') }}">Edit</a>
                                        </div>
                                        <div class="box-content">
                                            <p>Change your password</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
--}}
@endsection
