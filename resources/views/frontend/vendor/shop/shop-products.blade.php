@extends('layouts.frontend')
@section('title', 'Shop Products')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="order-info">
                        <!-- ===============  card start ==============-->
                        <div class="col-md-12 mb-2 mt-2">
                            <a class="btn btn-success" style="margin-bottom:10px" href="{{ route('vendor.shop') }}">Go
                                To Shop List</a>
                        </div>
                        <!-- ===============  card end ==============-->

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
