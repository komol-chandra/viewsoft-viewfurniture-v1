@extends('layouts.frontend')
@section('title', 'Custom choose product view')
@section('content')

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="order-history">
                    @include('frontend.customerDashboard.include.sidebar')
                    <div class="order-info">
                        @if($data->is_approve==1 && $data->order_status == 0)
                        <div class="row">
                            <div class="card mt-2 mb-2">
                                <div class="card-body" style="display: flex">

                                    <h6>Purchuse this product</h6>
                                    <a style="margin-left: 20px" title="buy product"
                                        href="{{url('/dashboard/custom-choose-checkout/'.$data->id)}}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i></a>

                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="card mb-5">
                                                <div class="card-body ">
                                                    <h4 class="text-center"> Customer Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">Phone</div>
                                                                <div class="text-gray-600">{{ $data->Customer->phone }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">Email</div>
                                                                <div class="text-gray-600">{{ $data->Customer->email }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">User Name</div>
                                                                <div class="text-gray-600">{{ $data->Customer->name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">User Address</div>
                                                                <div class="text-gray-600">{{ $data->address }}</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="card mb-5">
                                                <div class="card-body ">
                                                    <h4 class="text-center"> Product Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">Name</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->Product->product_name }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">Price</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->Product->product_price }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">Sku</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->Product->product_sku }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="fw-bolder mt-2">Image</div>
                                                                <img src="{{ asset('uploads/products/'.$data->Product->image) }}"
                                                                    alt="" style="height:150px;width:300px">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="card mb-5">
                                                <div class="card-body ">
                                                    <h4 class="text-center">Customize Product Request Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder ">New Price for this custom
                                                                    product</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->custom_product_price?? "not set yet" }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Color</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->Color->color_name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Material</div>
                                                                <div class="text-gray-600">{{ $data->Material->name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Finished</div>
                                                                <div class="text-gray-600">
                                                                    {{ $data->FinishedColor->name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Hight</div>
                                                                <div class="text-gray-600">{{ $data->hight }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Weight</div>
                                                                <div class="text-gray-600">{{ $data->weight }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fw-bolder mt-2">Length</div>
                                                                <div class="text-gray-600">{{ $data->length }}</div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="fw-bolder mt-2">Description</div>
                                                                <div class="text-gray-600">{{ $data->description }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="fw-bolder mt-2">Image</div>
                                                                <img src="{{ asset('uploads/custom_choose/'.$data->image) }}"
                                                                    alt="" style="height:150px;width:300px">

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
    </div>
</section>
@endsection
