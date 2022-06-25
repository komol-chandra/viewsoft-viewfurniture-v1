@extends('layouts.frontend')
@section('title', 'Custom choose products')
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
                                    <th>Product Name</th>
                                    <th>Date</th>
                                    <th>Product Price</th>
                                    <th>New Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $key => $data)
                                <tr>
                                    <td scope="row">{{ $key+1 }}</td>
                                    <td>{{ $data->Product->product_name }}</td>
                                    <td>{{ $data->created_at->format('d/m/Y') }}</td>
                                    <td>৳{{ $data->Product->product_price}}</td>
                                    <td>{{ $data->custom_product_price ?? "not set yet"}}</td>
                                    @if($data->is_approve==0)
                                    <td>Pending</td>
                                    @elseif($data->is_approve==1 && $data->order_status ==0)
                                    <td>shop now</td>
                                    @elseif($data->is_approve==1 && $data->order_status ==1)
                                    <td>Completed shopping</td>

                                    @endif
                                    <td><a title="view products"
                                            href="{{url('/dashboard/custom-choose-product/view/'.$data->id)}}"
                                            class="btn btn-primary btn-sm"><i class="ti-eye"></i></a>
                                        @if($data->is_approve==1 && $data->order_status == 0)
                                        <a style="margin-left: 20px" title="buy product"
                                            href="{{url('/dashboard/custom-choose-checkout/'.$data->id)}}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i></a>

                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <p class="text-center text-warning">no products!</p>
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
