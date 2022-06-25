@extends('layouts.backend')
@section('title', 'Invoice')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<style>
    body {
        background-color: rgb(190, 190, 190)
    }

    .padding {
        padding: 2rem !important
    }

    .card {
        margin-bottom: 30px;
        bdata: none;
        -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
    }

    .card-header {
        background-color: #fff;
        bdata-bottom: 1px solid #e6e6f2
    }

    h3 {
        font-size: 20px
    }

    h5 {
        font-size: 15px;
        line-height: 26px;
        color: #3d405c;
        margin: 0px 0px 15px 0px;
        font-family: 'Circular Std Medium'
    }

    .text-dark {
        color: #3d405c !important
    }

</style>
<section class="pt-3 pb-3 page-info section-padding bdata-bottom bg-white">
    <div class="container" id="printableArea">
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
                <div class="card">
                    <div class="card-header p-4">
                        <h2 class="pt-2 d-inline-block">{{ $user->name }}</h2>
                        <div class="float-right">
                            <h3 class="mb-0">Invoice #{{$data->order_id}}</h3>
                            Date: {{$data->created_at}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">Company Information:</h5>
                                <h3 class="text-dark mb-1">{{$user->name}}</h3>
                                <div>{{$user->main_address}}</div>
                                <div>Email: {{$user->email}}</div>
                                <div>Phone: {{$user->mobile}}</div>
                            </div>
                            @php
                            $division=Devfaysal\BangladeshGeocode\Models\Division::where('id',$data->shipping_division)->get();
                            $district=Devfaysal\BangladeshGeocode\Models\District::where('id',$data->shipping_city)->get();
                            @endphp
                            <div class="col-sm-6 ">
                                <h5 class="mb-3">Shipping Address:</h5>
                                <h3 class="text-dark mb-1">{{$data->shipping_name}}</h3>
                                <div>
                                    {{$division[0]->name}},{{$district[0]->name}},{{$data->shipping_address}},{{$data->shipping_zip}}
                                </div>
                                <div>Email: {{$data->shipping_email}}</div>
                                <div>Phone: {{$data->shipping_phone}}</div>

                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Sku</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->order_type=="custom_checkout")
                                    {{-- {{ dd("hi") }} --}}
                                    @php $product = json_decode($data->products);@endphp
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">{{Str::limit($product->product_name,20)}}</td>
                                        <td class="left">{{$product->sku}}</td>
                                        <td class="right">৳{{$product->price}}</td>
                                        <td class="center">{{$product->qty}}</td>
                                        <td class="right">৳{{$product->subtotal}}</td>
                                    </tr>
                                    @endif
                                    @if($data->order_type=="cart_checkout")
                                    {{-- {{ dd("he") }} --}}

                                    @foreach (json_decode($data->products) as $key => $obj)
                                    <tr>
                                        <td class="center">{{++$key }}</td>
                                        <td class="left strong">{{Str::limit($obj->product_name,20)}}</td>
                                        <td class="left">{{$obj->sku}}</td>
                                        <td class="right">৳{{$obj->price}}</td>
                                        <td class="center">{{$obj->qty}}</td>
                                        <td class="right">৳{{$obj->subtotal}}</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    <div class="col-lg-4 col-sm-5">
                                    </div>
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Delivery Charge</td>
                                        <td class="left">৳{{$data->delivery_charge	}}</td>
                                    </tr>
                                    @if($data->cupon_discounted_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Cupon discounted amount</td>
                                        <td class="left">(-)৳{{$data->cupon_discounted_amount}}</td>
                                    </tr>
                                    @endif
                                    @if($data->wallet_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Wallet amount</td>
                                        <td class="left">(-)৳{{$data->wallet_amount}}</td>
                                    </tr>
                                    @endif
                                    @if($data->full_paid_offer_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Full paid offer amount</td>
                                        <td class="left">(-)৳{{$data->full_paid_offer_amount}}</td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Total</td>
                                        <td class="left">৳{{$data->total_amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <p class="mb-0">{{ $user->name }}, {{ $user->email }}, {{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="printableArea2">
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
                <div class="card">
                    <div class="card-header p-4">
                        <h2 class="pt-2 d-inline-block">{{ $user->name }}</h2>
                        <div class="float-right">
                            <h3 class="mb-0">Invoice #{{$data->order_id}}</h3>
                            Date: {{$data->created_at}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">Company Information:</h5>
                                <h3 class="text-dark mb-1">{{$user->name}}</h3>
                                <div>{{$user->main_address}}</div>
                                <div>Email: {{$user->email}}</div>
                                <div>Phone: {{$user->phone}}</div>
                            </div>
                            @php
                            $division=Devfaysal\BangladeshGeocode\Models\Division::where('id',$data->shipping_division)->get();
                            $district=Devfaysal\BangladeshGeocode\Models\District::where('id',$data->shipping_city)->get();
                            @endphp
                            <div class="col-sm-6 ">
                                <h5 class="mb-3">Shipping Address:</h5>
                                <h3 class="text-dark mb-1">{{$data->shipping_name}}</h3>
                                <div>
                                    {{$division[0]->name}},{{$district[0]->name}},{{$data->shipping_address}},{{$data->shipping_zip}}
                                </div>
                                <div>Email: {{$data->shipping_email}}</div>
                                <div>Phone: {{$data->shipping_phone}}</div>

                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Vendor</th>
                                        <th>Sku</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->order_type=="custom_checkout")
                                    @php $obj = json_decode($data->products);@endphp
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">{{Str::limit($obj->product_name,20)}}</td>
                                        <td class="left">
                                            @php
                                            $product_details=App\Models\Product::where('id',$obj->id)->first();
                                            $shop_name=App\Models\Shop::where('id',$product_details->shop_id)->first();

                                            @endphp
                                            {{ $user->name }}
                                            <br>
                                            {{ $user->phone }}
                                            <br>
                                            {{ $user->email }}
                                            <br>
                                            {{$shop_name->shop_name}}
                                        </td>
                                        <td class="left">{{$obj->sku}}</td>
                                        <td class="right">৳{{$obj->price}}</td>
                                        <td class="center">{{$obj->qty}}</td>
                                        <td class="right">৳{{$obj->subtotal}}</td>
                                    </tr>
                                    @endif
                                    @if($data->order_type=="cart_checkout")
                                    {{-- {{ dd("he") }} --}}

                                    @php $product = json_decode($data->products) @endphp
                                    @foreach ($product as $key => $obj)
                                    <tr>
                                        <td class="center">{{++$key }}</td>
                                        <td class="left strong">{{Str::limit($obj->product_name,20)}}</td>
                                        <td class="left">
                                            @php
                                            $product_details=App\Models\Product::where('id',$obj->id)->first();
                                            $shop_name=App\Models\Shop::where('id',$product_details->shop_id)->first();

                                            @endphp
                                            {{ $user->name }}
                                            <br>
                                            {{ $user->phone }}
                                            <br>
                                            {{ $user->email }}
                                            <br>
                                            {{$shop_name->shop_name}}
                                        </td>
                                        <td class="left">{{$obj->sku}}</td>
                                        <td class="right">৳{{$obj->price}}</td>
                                        <td class="center">{{$obj->qty}}</td>
                                        <td class="right">৳{{$obj->subtotal}}</td>
                                    </tr>
                                    @endforeach
                                    @endif



                                    <div class="col-lg-4 col-sm-5">
                                    </div>
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Delivery Charge</td>
                                        <td class="left">৳{{$data->delivery_charge	}}</td>
                                    </tr>
                                    @if($data->cupon_discounted_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Cupon discounted amount</td>
                                        <td class="left">(-)৳{{$data->cupon_discounted_amount}}</td>
                                    </tr>
                                    @endif
                                    @if($data->wallet_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Wallet amount</td>
                                        <td class="left">(-)৳{{$data->wallet_amount}}</td>
                                    </tr>
                                    @endif
                                    @if($data->full_paid_offer_amount != null)
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Full paid offer amount</td>
                                        <td class="left">(-)৳{{$data->full_paid_offer_amount}}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="left"></td>
                                        <td class="right">Total</td>
                                        <td class="left">৳{{$data->total_amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <p class="mb-0">{{ $user->name }}, {{ $user->email }},
                            {{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
<div>
    <button onclick="printDiv('printableArea')" class="btn btn-primary btn-sm" style="float: right">Print Customer
        Invoice </button>
    <button onclick="printDiv('printableArea2')" class="btn btn-primary btn-sm" style="float: right">Print Admin
        Invoice</button>
</div>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"
    integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
@endsection
