@extends('layouts.frontend')
@section('title', 'Track Orders')

@section('content')
@if($data!=null)

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="track-area">
                    <div class="track-price">
                        <ul class="track-order">
                            <li>
                                <h4>Your order id is: {{ $data->order_id }}</h4>
                            </li>
                            <li>
                                <h4>Your product will be ready to delivered in 7-15 days.</h4>
                            </li>
                            <li><span class="track-status">Status:</span>
                                @php
                                if ($data->order_status == 0) {
                                $text = 'Order confirmed';
                                } elseif ($data->order_status == 1) {
                                $text = 'Order in process';
                                } elseif ($data->order_status == 2) {
                                $text = 'Order is rejected';
                                } elseif ($data->order_status == 3) {
                                $text = 'Order in transit';
                                } elseif ($data->order_status == 4) {
                                $text = 'Order returned';
                                } else {
                                }
                                @endphp
                                {{ $text }}
                            </li>
                        </ul>
                    </div>
                    <div class="track-main">
                        <div class="track">
                            <div
                                class="step @if($data->order_status ==0 ||$data->order_status ==1 || $data->order_status ==2 || $data->order_status ==3) active @endif ">
                                <span class="icon"><i class="fa fa-check"></i></span>
                                <span class="text">Order confirmed</span>
                            </div>
                            <div
                                class="step @if($data->order_status ==1 || $data->order_status ==2 || $data->order_status ==3) active @endif">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <span class="text">Order in process</span>
                            </div>
                            @if($data->order_status ==2)
                            <div class="step @if($data->order_status ==2 ) active @endif">
                                <span class="icon"><i class="fa fa-ban"></i></span>
                                <span class="text"> Order is rejected </span>
                            </div>
                            @else
                            <div class="step @if($data->order_status ==3) active @endif">
                                <span class="icon"><i class="fa fa-truck"></i></span>
                                <span class="text"> Order in transit </span>
                            </div>
                            <div class="step @if($data->order_status ==4) active @endif">
                                <span class="icon"><i class="fa fa-archive"></i>
                                </span> <span class="text">Order Successfully Delivery</span>
                            </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="order-history">
                    <div class="profile-form">
                        <div class="dashboard">
                            <div class="box-account box-info">
                                <div class="box-head mb-2">
                                    <h4>Order Products List</h4>
                                </div>
                                <div class="row">
                                    <div class="table-responsive-md">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Quantity.</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $product = json_decode($data->products);
                                                @endphp
                                                @if($data->order_type=="custom_checkout")
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td><img src="{{asset($product->image?'uploads/products/'.$product->image :'uploads/damo/no-img.png')}}"
                                                            style="max-height: 40px; max-width: 50px" alt=""
                                                            class="img-fluid blur-up lazyloaded"></td>
                                                    <td>
                                                        <h6>
                                                            <p>{{Str::limit($product->product_name,20)}}</p>
                                                            <p>Sku : {{$product->sku}}
                                                            </p>
                                                        </h6>
                                                    </td>
                                                    <td>{{$product->qty}}</td>
                                                    <td>৳{{$product->subtotal}}</td>
                                                </tr>
                                                @else
                                                @foreach ($product as $key => $obj)
                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td><img src="{{asset('uploads/products/'.$obj->image)}}"
                                                            style="max-height: 40px; max-width: 50px" alt=""
                                                            class="img-fluid blur-up lazyloaded"></td>
                                                    <td>
                                                        <h6>
                                                            <p>{{Str::limit($obj->product_name,20)}}</p>
                                                            <p>Sku : {{$obj->sku}}
                                                            </p>
                                                        </h6>
                                                    </td>
                                                    <td>{{$obj->qty}}</td>
                                                    <td>৳{{$obj->subtotal}}</td>
                                                </tr>
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>TOTAL</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>৳{{ $data->cart_total }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Delivery Charge</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>৳{{ $data->delivery_charge }}</td>
                                                </tr>
                                                @if($data->cupon_discounted_amount != null ||
                                                $data->cupon_discounted_amount != 0)
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Shipping Cupon Amount</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>(-) ৳ {{ $data->cupon_discounted_amount }}</td>
                                                </tr>
                                                @endif

                                                @if($data->wallet_amount != null || $data->wallet_amount != 0)
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Wallet Amount</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>(-) ৳ {{ $data->wallet_amount }}</td>
                                                </tr>


                                                @endif
                                                @if($data->full_paid_offer_amount != null ||
                                                $data->full_paid_offer_amount != 0)
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Full paid offer amount</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>(-) ৳ {{ $data->full_paid_offer_amount }}</td>
                                                </tr>


                                                @endif
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>GRAND TOTAL</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>৳{{ $data->total_amount }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="order-success-sec">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6>Summery</h6>
                                                    <ul class="order-detail">
                                                        <li>Order ID: {{ $data->order_id }}</li>
                                                        <li>Order Date: {{ $data->created_at->format('d/m/Y') }}</li>
                                                        <li>Order Total: ৳{{ $data->total_amount }}</li>
                                                        <li>Order advance pay: ৳{{ $data->advance_pay }}</li>
                                                        <li>Order payment mobile: {{ $data->payment_mobile }}</li>
                                                        <li>Order transaction id: {{ $data->transaction_id }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>Shipping address</h6>
                                                    <ul class="order-detail">
                                                        <li>{{ $data->country_name }}</li>
                                                        <li>{{ $data->city_name }}</li>
                                                        <li>{{ $data->shipping_address }}</li>
                                                        <li>Contact No. {{ $data->shipping_phone }}</li>
                                                    </ul>
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
        </div>
    </div>
</section>
@else
<section class="section-b-space light-layout">
    <div class="container" style="text-align: center;margin-top: 20px; margin-bottom: 20px">
        <div class="row">
            <div class="col-md-12">
                <div class="success-text">
                    <h3 class="text-danger mb-5">Opps! Order id not found</h3>
                    <a href="{{ url('/') }}" class="btn btn-info" id="mc-submit">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
