@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('content')


<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>My Order View</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Order View</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!-- section start -->
<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.vendor.dashboard.include.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right" id="printableArea">
                    <div class="dashboard">
                        <div class="page-title">
                            <h2>My Order View</h2>
                            
                            <button onclick="printDiv('printableArea')" title="view products"
                                class="btn btn-primary btn-sm" style="float: right"><i class="ti-printer"></i></button>
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
                                                <th scope="col">name</th>
                                                <th scope="col">sku</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">price</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          
                                            @foreach (json_decode($alldata->products) as $key => $obj)
                                                @php
                                                    $shop_idmain=App\Models\Shop::where('id',$obj->shop_id)->select(['user_id'])->first();
                                                @endphp
                                            @if($shop_idmain->user_id == Auth::user()->id)
                                            <tr>
                                                <th scope="row">{{ ++$key}}</th>
                                                <td>
                                                <img src="{{asset('uploads/products/'.$obj->image)}}"
                                                        style="max-height: 40px; max-width: 50px" alt=""
                                                        class="img-fluid blur-up lazyloaded"></td>
                                                <td>{{Str::limit($obj->product_name,20)}}</td>
                                                <td>{{$obj->sku}}</td>
                                                <td>{{$obj->qty}}</td>
                                                <td>৳{{$obj->price}}</td>
                                                <td>৳{{$obj->subtotal}}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                           
                                            
                                        </tbody>
                                       
                                    </table>
                                </div>

                                <div class="col-lg-12">
                                    <div class="order-success-sec">
                                       
                                        
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