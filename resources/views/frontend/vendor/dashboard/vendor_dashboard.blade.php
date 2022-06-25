@extends('layouts.frontend')
@section('title', 'Vendor-Create')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>vendor dashboard</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">vendor dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.vendor.dashboard.include.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="counter-section">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/order.png" class="img-fluid">
                                            <div>

                                                <h3>{{$countproduct}}</h3>
                                                <h5>Total Products</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/sale.png" class="img-fluid">
                                            <div>
                                                <h3>{{$totalsellproduct}}</h3>
                                                <h5>Total Sales</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="counter-box">
                                            <img src="{{ asset('frontend') }}/assets/images/icon/dashboard/homework.png" class="img-fluid">
                                            <div>
                                                <h3>{{ $totalpendingOrder }}</h3>
                                                <h5>Order Pending</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="chart-order"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card dashboard-table">
                                        <div class="card-body">
                                            <h3>Best Sell Products</h3>
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">image</th>
                                                        <th scope="col">product name</th>
                                                        <th scope="col">price</th>
                                                        <th scope="col">sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($OrderBysellproduct as $product)
                                                    <tr>
                                                        <th scope="row">
                                                        <img src="{{ asset('uploads/products/'.$product->image) }}" class="blur-up lazyloaded"></th>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>{{ $product->product_price }}</td>
                                                        <td>{{$product->sell_qty}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card dashboard-table">
                                        <div class="card-body">
                                            <h3>Recent Orders</h3>
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order id</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($allpendingOrder as $pendingorder)
                                                    <tr>
                                                        <th scope="row">#{{$pendingorder->order_id}}</th>
                                                        <td>{{ $pendingorder->created_at->format('d-M-Y') }}</td>
                                                        @if($pendingorder->order_status==0)
                                                        <td>Pending</td>
                                                        @elseif($pendingorder->order_status==1)
                                                        <td>Processing</td>
                                                        @elseif($pendingorder->order_status==2)
                                                        <td>Rejected</td>
                                                        @elseif($pendingorder->order_status==3)
                                                        <td>Delivered</td>
                                                        @elseif($pendingorder->order_status==4)
                                                        <td>Returned</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="products">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-md">
                                            <div class="top-sec">
                                                <h3>all products</h3>
                                                <a href="#" class="btn btn-sm btn-solid">add product</a>
                                            </div>
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">image</th>
                                                        <th scope="col">product name</th>
                                                        <th scope="col">category</th>
                                                        <th scope="col">price</th>
                                                        <th scope="col">stock</th>
                                                        <th scope="col">sales</th>
                                                        <th scope="col">edit/delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              
                                                    <tr>
                                                        <th scope="row">
                                                        <img src=""
                                                                class="blur-up lazyloaded"></th>
                                                        <td>neck velvet dress</td>
                                                        <td>women clothes</td>
                                                        <td>$205</td>
                                                        <td>1000</td>
                                                        <td>2000</td>
                                                        <td><i class="fa fa-pencil-square-o me-1"
                                                                aria-hidden="true"></i><i class="fa fa-trash-o ms-1"
                                                                aria-hidden="true"></i></td>
                                                    </tr>
                                              
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-sm">
                                            <div class="top-sec">
                                                <h3>orders</h3>
                                                <a href="#" class="btn btn-sm btn-solid">add product</a>
                                            </div>
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">order id</th>
                                                        <th scope="col">product details</th>
                                                        <th scope="col">status</th>
                                                        <th scope="col">price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">#125021</th>
                                                        <td>neck velvet dress</td>
                                                        <td>shipped</td>
                                                        <td>$205</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#521214</th>
                                                        <td>belted trench coat</td>
                                                        <td>shipped</td>
                                                        <td>$350</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#521021</th>
                                                        <td>men print tee</td>
                                                        <td>pending</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#245021</th>
                                                        <td>woman print tee</td>
                                                        <td>shipped</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#122141</th>
                                                        <td>men print tee</td>
                                                        <td>canceled</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#125015</th>
                                                        <td>men print tee</td>
                                                        <td>pending</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#245021</th>
                                                        <td>woman print tee</td>
                                                        <td>shipped</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#122141</th>
                                                        <td>men print tee</td>
                                                        <td>canceled</td>
                                                        <td>$150</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#125015</th>
                                                        <td>men print tee</td>
                                                        <td>pending</td>
                                                        <td>$150</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="dashboard-box">
                                                <div class="dashboard-title">
                                                    <h4>profile</h4>
                                                    <span data-toggle="modal" data-bs-target="#edit-profile">edit</span>
                                                </div>
                                                <div class="dashboard-detail">
                                                    <ul>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>company name</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>Fashion Store</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>email address</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>mark.enderess@mail.com</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Country / Region</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>Downers Grove, IL</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Year Established</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>2018</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Total Employees</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>101 - 200 People</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>category</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>clothing</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>street address</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>549 Sulphur Springs Road</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>city/state</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>Downers Grove, IL</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>zip</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6>60515</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="dashboard-box">
                                                <div class="dashboard-title">
                                                    <h4>settings</h4>
                                                </div>
                                                <div class="dashboard-detail">
                                                    <div class="account-setting">
                                                        <h5>Notifications</h5>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios"
                                                                        id="exampleRadios1" value="option1" checked>
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios1">
                                                                        Allow Desktop Notifications
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios"
                                                                        id="exampleRadios2" value="option2">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios2">
                                                                        Enable Notifications
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios"
                                                                        id="exampleRadios3" value="option3">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios3">
                                                                        Get notification for my own activity
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios"
                                                                        id="exampleRadios4" value="option4">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios4">
                                                                        DND
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="account-setting">
                                                        <h5>deactivate account</h5>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios1"
                                                                        id="exampleRadios4" value="option4" checked>
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios4">
                                                                        I have a privacy concern
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios1"
                                                                        id="exampleRadios5" value="option5">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios5">
                                                                        This is temporary
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios1"
                                                                        id="exampleRadios6" value="option6">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios6">
                                                                        other
                                                                    </label>
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-solid btn-xs">Deactivate
                                                                    Account</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="account-setting">
                                                        <h5>Delete account</h5>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios3"
                                                                        id="exampleRadios7" value="option7" checked>
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios7">
                                                                        No longer usable
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios3"
                                                                        id="exampleRadios8" value="option8">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios8">
                                                                        Want to switch on other account
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="radio_animated form-check-input"
                                                                        type="radio" name="exampleRadios3"
                                                                        id="exampleRadios9" value="option9">
                                                                    <label class="form-check-label"
                                                                        for="exampleRadios9">
                                                                        other
                                                                    </label>
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-solid btn-xs">Delete Account</button>
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
            </div>
        </div>
    </section>
    <!--  dashboard section end -->


    <!-- Modal start -->
    <div class="modal logout-modal fade" id="logout" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logging Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to log out?
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark btn-custom" data-bs-dismiss="modal">no</a>
                    <a href="index.html" class="btn btn-solid btn-custom">yes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
@endsection