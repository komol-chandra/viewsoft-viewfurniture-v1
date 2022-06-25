@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="order-info">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
                            id="dataTableExample1" class="data-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Date Purchased</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $order)
                                <tr>
                                    <td scope="row">{{ $key+1 }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>৳{{ $order->total_amount}}</td>
                                    @if($order->order_status==0)
                                    <td>Pending</td>
                                    @elseif($order->order_status==1)
                                    <td>Processing</td>
                                    @elseif($order->order_status==2)
                                    <td>Rejected</td>
                                    @elseif($order->order_status==3)
                                    <td>Delivered</td>
                                    @elseif($order->order_status==4)
                                    <td>Returned</td>
                                    @endif
                                    <td><a title="view products" href="{{url('/dashboard/order/view/'.$order->id)}}"
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
</section>
@endsection
