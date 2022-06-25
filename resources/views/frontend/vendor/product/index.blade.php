@extends('layouts.frontend')
@section('title', 'Vendor-Products')

@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')

                    <div class="order-info">
                        <!-- ===============  card start ==============-->
                        <div class="continer">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12 card_start">
                                                    <div class="col-md-5 card_col_5">
                                                        <img src="{{ asset('frontend/image/dashbord/sale.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countProducts }}</h2>
                                                        <h5>Total Products</h5>
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
                                                        <img src="{{ asset('frontend/image/dashbord/homework.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countActiveProducts }}</h2>
                                                        <h5>Active Products</h5>
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
                                                        <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7 card_col_7">
                                                        <h2>{{ $countUnapprovedProducts }}</h2>
                                                        <h5>Unapproved Products</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product-create') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Add New Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product?t=active') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Active Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product?t=inactive') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Inactive Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product?t=approve') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Approve Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product?t=un-approve') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Unapprove Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4 mt-4">
                                        <div class="card">
                                            <a href="{{ url('/vendor/product?t=offer') }}">
                                                <div class="card-body">
                                                    <div class="col-md-12 card_start">
                                                        <div class="col-md-5 card_col_5">
                                                            <img src="{{ asset('frontend/image/dashbord/order.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-md-7 card_col_7">
                                                            <h5>Have A Discount Product</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- ===============  card end ==============-->
                        <div class="col-md-12 text-center m-4">
                            <h4 class="text-info">{{$table_title}} Products Table</h4>
                        </div>
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
                            id="dataTableExample1" class="data-table" style="width:100%">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allProduct as $key => $data)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $data->product_name }}</td>
                                    <td>{{ $data->product_sku }}</td>
                                    <td>{{ $data->product_price }}</td>
                                    <td>{{ $data->Category->name }}</td>
                                    <td><img src="{{asset('uploads/products/'.$data->image)}}" height="30px" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ url('vendor/product/edit/'.$data->id) }}"> <i
                                                class="fa fa-pencil-square-o me-1" aria-hidden="true"></i></a>
                                        <a href="{{ url('vendor/product/delete/'.$data->id) }}"><i
                                                class="fa fa-trash-o ms-1" aria-hidden="true"></i></a>
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
@endsection
