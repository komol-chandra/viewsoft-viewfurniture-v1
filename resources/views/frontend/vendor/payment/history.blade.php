@extends('layouts.frontend')
@section('title', 'Payment History')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="order-info">
                        <div class="row ">
                            <div class="col-md-4 mb-4 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-12 card_start">
                                            <div class="col-md-5 card_col_5">
                                                <img src="{{ asset('frontend/image/dashbord/sale.png') }}" alt="">
                                            </div>
                                            <div class="col-md-7 card_col_7">
                                                <h2>{{ $orders }}</h2>
                                                <h5>Total Orders</h5>
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
                                                <img src="{{ asset('frontend/image/dashbord/homework.png') }}" alt="">
                                            </div>
                                            <div class="col-md-7 card_col_7">
                                                <h2>{{ $pendingOrders }}</h2>
                                                <h5>Pending Order</h5>
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
                                                <img src="{{ asset('frontend/image/dashbord/order.png') }}" alt="">
                                            </div>
                                            <div class="col-md-7 card_col_7">
                                                <h2>{{ $processingOrders }}</h2>
                                                <h5>Processing Order </h5>
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
                                                <img src="{{ asset('frontend/image/dashbord/order.png') }}" alt="">
                                            </div>
                                            <div class="col-md-7 card_col_7">
                                                <h2>{{ $deliveredOrders }}</h2>
                                                <h5>Delivered Order </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- <h3>Payment History</h3> --}}
                        <a href="#" class="btn btn-success mt-2 mb-2" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_new_address">create payment request</a>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">request amount</th>
                                    <th scope="col">request date</th>
                                    <th scope="col">paid amount</th>
                                    <th scope="col">paid date</th>
                                    <th scope="col">transection id</th>
                                    <th scope="col">payment method</th>
                                    <th scope="col">paid status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alldata as $key => $data)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $data->request_amount }}</td>
                                    <td>{{ $data->request_date }}</td>
                                    <td>{{ $data->paid_amount }}</td>
                                    <td>{{ $data->paid_date }}</td>
                                    <td>{{ $data->transection_id }}</td>
                                    <td>{{ $data->payment_method }}</td>
                                    <td>
                                        @if($data->paid_status==0)
                                        <span class="btn btn-primary">Pending</span>
                                        @elseif($data->paid_status==1)
                                        <span class="btn btn-primary">Paid</span>
                                        @elseif($data->paid_status==2)
                                        <span class="btn btn-danger">Rejected</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
<!--  dashboard section end -->
<div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px modal-lg ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ url('/vendor/payment/request') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header" id="kt_modal_new_address_header">
                    <h6>Create Payment Request Now</h6>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon
                        {{-- {{$davit_balance + wallet(auth()->user()->id) - paidAmount(auth()->user()->id) - $credit_balance }} --}}
                        -->
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Your Sell Balance: <span style="color:red">*</span></label>
                            <input type="text" name="" id="blance" class="form-control" disabled value="{{ $wallet }}"
                                placeholder="Enter Shop Name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="request_amount">Request Amount: <span style="color:red">*</span></label>
                            <input type="number" name="request_amount" id="request_amount" class="form-control"
                                placeholder="{{ $wallet==0 ? "you have zero amount" : "Enter request amount" }}"
                                max="{{ $wallet }}" required {{ $wallet==0 ? "disabled" : "" }}>
                        </div>


                        <br>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    @if($wallet!= 0)
                    <button type="submit" class="btn btn-white me-3">Submit</button>
                    @endif
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
