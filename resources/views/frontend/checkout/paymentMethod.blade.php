@extends('layouts.frontend')
@section('title', 'Order Complete')

@section('content')
<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-area">

                    <div class="order-details">
                        <span class="text-success order-i"><i class="fa fa-check-circle"></i></span>
                        <h4>Thank you for order</h4>
                        <span class="order-s" style="text-transform:uppercase;">After checking payment information we
                            contact as soon as possible</span>
                        {{-- <a href="tracking.html" class="tracking-link btn btn-style1">Tracking details</a> --}}
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
                <div class="order-area">

                    <div class="order-delivery">
                        <ul class="delivery-payment">
                            <li class="delivery">
                                <h5>Delivery address</h5>
                                @php
                                $division = Devfaysal\BangladeshGeocode\Models\Division::find($data->shipping_division);
                                @endphp
                                <span class="order-span">{{ $division->name }}</span>
                                @php
                                $city = Devfaysal\BangladeshGeocode\Models\District::find($data->shipping_city);
                                @endphp
                                <span class="order-span">{{ $city->name }}</span>
                                <span class="order-span">{{ $data->shipping_address }}</span>
                                <span class="order-span">Shipping zip: {{ $data->shipping_zip }}</span>
                                <span class="order-span">Mobile No :{{ $data->shipping_phone }}</span>
                            </li>
                            <li class="pay">
                                <h5>Payment summary</h5>
                                <p class="" style="color: black">Order No : {{ $data->order_id }}</p>
                                <span class="order-span p-label">
                                    <span class="n-price">Product </span>
                                    <span class="o-price">৳ {{ $data->cart_total }}</span>
                                </span>
                                <span class="order-span p-label">
                                    <span class="n-price">Shipping charge</span>
                                    <span class="o-price">৳ {{ $data->delivery_charge }}</span>
                                </span>
                                @if($data->cupon_discounted_amount != null || $data->cupon_discounted_amount != 0)
                                <span class="order-span p-label">
                                    <span class="n-price">Shipping Cupon Amount</span>
                                    <span class="o-price">(-) ৳ {{ $data->cupon_discounted_amount }}</span>
                                </span>
                                @endif
                                @if($data->wallet_amount != null || $data->wallet_amount != 0)
                                <span class="order-span p-label">
                                    <span class="n-price">Wallet Amount</span>
                                    <span class="o-price">(-) ৳ {{ $data->wallet_amount }}</span>
                                </span>
                                @endif

                                @if(($data->full_paid_offer != null || $data->full_paid_offer !=
                                0)&&($data->full_paid_offer_amount!=null || $data->full_paid_offer_amount!=0))
                                <span class="order-span p-label">
                                    <span class="n-price">Full Paid Offer</span>
                                    <span class="o-price">{{ $data->full_paid_offer }} %</span>
                                </span>

                                <span class="order-span p-label">
                                    <span class="n-price">Full Paid Offer Amount</span>
                                    <span class="o-price">(-) ৳ {{ $data->full_paid_offer_amount }} </span>
                                </span>
                                @endif

                                <span class="order-span p-label">
                                    <span class="n-price">Order Total</span>
                                    <span class="o-price">৳ {{ $data->total_amount }}</span>
                                </span>
                                <span class="order-span p-label">
                                    <span class="n-price">Advance payment</span>
                                    <span class="o-price">৳ {{ $data->advance_pay }}</span>
                                </span>
                                <span class="order-span p-label">
                                    <span class="n-price">Your bkash payment</span>
                                    <span class="o-price"> {{ $data->payment_mobile }}</span>
                                </span>
                                <span class="order-span p-label">
                                    <span class="n-price">Your transaction id</span>
                                    <span class="o-price">{{ $data->transaction_id }}</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
