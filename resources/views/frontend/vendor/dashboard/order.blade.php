@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('content')

<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.vendor.dashboard.include.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <div class="page-title">
                            <h2>My Orders</h2>
                        </div>
                        <div class="welcome-msg">
                            <p>Hello, {{ Auth::user()->name }} !</p>
                            <p>Here you can view your all orders list</p>
                        </div>
                        <div class="box-account box-info">
                            <div class="box-head">
                                <h2>Product Orders List</h2>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 table-responsive-xs">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Date Purchased</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($allorders as $key => $order)
                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ $order->created_at->format('d-F-Y') }}</td>
                                                <td>
                                                    @if($order->delevery_status==0)
                                                    <span class="btn btn-primary">Pending</span>
                                                    @elseif($order->delevery_status==1)
                                                    <span class="btn btn-primary">Processing</span>
                                                    @elseif($order->delevery_status==2)
                                                    <span class="btn btn-danger">Rejected</span>
                                                    @elseif($order->delevery_status==3)
                                                    <span class="btn btn-success">Delivered</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="view products"
                                                        href="{{url('/vendor/order/view/'.$order->id)}}"
                                                        class="btn btn-primary btn-sm"><i class="ti-eye"></i></a></td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <p class="text-center text-warning">no order!</p>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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
@endsection
