@extends('layouts.backend')
@section('title', 'View Custom Product Request Report')
@section('content')
<style>
    <style>div.dataTables_wrapper div.dataTables_length select {

        height: 33px;
    }

    div.dataTables_wrapper div.dataTables_filter input {

        height: 25px;
    }

</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-place="true" data-kt-place-mode="prepend"
                data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">View Custom Product Request Report
                </h1>
                <a href="{{ url('/admin/customer-custom-choose-request') }}" class="btn btn-sm btn-primary" style="margin-left: 20px;
                ">all</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body ">
                            <h2 class="text-center"> Customer Info</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Phone</div>
                                        <div class="text-gray-600">{{ $data->Customer->phone }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Email</div>
                                        <div class="text-gray-600">{{ $data->Customer->email }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">User Name</div>
                                        <div class="text-gray-600">{{ $data->Customer->name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">User Address</div>
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
                            <h2 class="text-center"> Vendor Info</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Phone</div>
                                        <div class="text-gray-600">{{ $data->Vendor->phone }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Email</div>
                                        <div class="text-gray-600">{{ $data->Vendor->email }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">User Name</div>
                                        <div class="text-gray-600">{{ $data->Vendor->name }}</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body ">
                            <h2 class="text-center"> Product Info</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Name</div>
                                        <div class="text-gray-600">{{ $data->Product->product_name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Price</div>
                                        <div class="text-gray-600">{{ $data->Product->product_price }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Sku</div>
                                        <div class="text-gray-600">{{ $data->Product->product_sku }}</div>
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
                            <h2 class="text-center">Customize Product Request Info</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Color</div>
                                        <div class="text-gray-600">{{ $data->Color->color_name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Material</div>
                                        <div class="text-gray-600">{{ $data->Material->name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Finished</div>
                                        <div class="text-gray-600">{{ $data->FinishedColor->name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Hight</div>
                                        <div class="text-gray-600">{{ $data->hight }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Weight</div>
                                        <div class="text-gray-600">{{ $data->weight }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bolder mt-5">Length</div>
                                        <div class="text-gray-600">{{ $data->length }}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fw-bolder mt-5">Description</div>
                                        <div class="text-gray-600">{{ $data->description }}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fw-bolder mt-5">Image</div>
                                        <img src="{{ asset('uploads/custom_choose/'.$data->image) }}" alt=""
                                            style="height:250px;width:500px">

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

@endsection
