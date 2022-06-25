@extends('layouts.frontend')
@section('title', 'Profile')

@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="profile-form">
                        <div class="dashboard">
                            <div class="page-title">
                                <h2>My Order View</h2>
                                @if($data->order_type!="cart_checkout")

                                <h6>Custom Product Report</h6>
                                @endif
                                <input type="hidden" id="data_id" name="data_id" value="{{ $data->id }}">
                                <button onclick="printDiv('printableArea')" title="view products"
                                    class="btn btn-primary btn-sm" style="float: right"><i
                                        class="ti-printer"></i></button>
                            </div>
                            <div class="welcome-msg">
                                <p>Hello, {{ Auth::user()->name }} !</p>
                                <p>Here you can oreder all products</p>
                            </div>
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
                                                    <th scope="col">image</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">sku</th>
                                                    <th scope="col">quantity.</th>
                                                    <th scope="col">price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->order_type=="custom_checkout")
                                                @php
                                                $product = json_decode($data->products);
                                                @endphp
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td><img src="{{asset($product->image ? 'uploads/products/'.$product->image:"uploads/damo/no-img.png")}}"
                                                            style="max-height: 40px; max-width: 50px" alt=""
                                                            class="img-fluid blur-up lazyloaded"></td>
                                                    <td>
                                                        <h6>
                                                            <p>{{Str::limit($product->product_name,20)}}</p>
                                                        </h6>
                                                    </td>
                                                    <td>{{$product->sku}}</td>
                                                    <td>{{$product->qty}}</td>
                                                    <td>৳{{$product->price}}</td>
                                                </tr>
                                                @else

                                                @foreach (json_decode($data->products) as $key => $obj)
                                                @php $product_image =
                                                App\Models\Product::where('id',$obj->id)->first();@endphp

                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td><img src="{{asset($obj->image ? 'uploads/products/'.$obj->image:"uploads/damo/no-img.png")}}"
                                                            style="max-height: 40px; max-width: 50px" alt=""
                                                            class="img-fluid blur-up lazyloaded"></td>
                                                    <td>
                                                        <h6>
                                                            <p>{{Str::limit($obj->product_name,20)}}</p>
                                                            @if($obj->sku !=null)
                                                            <p>sku : {{$obj->sku}}
                                                            </p>
                                                            @endif
                                                        </h6>

                                                    </td>
                                                    <td>{{$product_image->product_sku}}</td>
                                                    <td>{{$obj->qty}}</td>
                                                    <td>৳{{$obj->price}}</td>
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
                                                    <td>Full Paid Offer Amount</td>
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
                                                    <h6>summery</h6>
                                                    <ul class="order-detail">
                                                        <li>order ID: {{ $data->order_id }}</li>
                                                        <li>Order Date: {{ $data->created_at->format('d/m/Y') }}</li>
                                                        <li>Order Total: ৳{{ $data->total_amount }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>shipping address</h6>
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

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

</script>
<!-- section end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"
    integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
