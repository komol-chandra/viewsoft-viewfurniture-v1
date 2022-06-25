@extends('layouts.backend')
@section('title', 'Product Report')
@section('content')
<style>
    div.dataTables_wrapper div.dataTables_length select {

        height: 33px;
    }

    div.dataTables_wrapper div.dataTables_filter input {

        height: 25px;
    }

</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend"
                data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Product Report</h1>
                <!--end::Title-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-5 p-lg-8">
                    <div class="row">

                        <form action="{{url('/admin/section-product-report')}}" method="get">

                            <div class="col-md-4">
                                <div class="fs-6 fw-bold mt-2 mb-3">Product</div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control form-control-solid"
                                    style="padding-top: 1px;padding-bottom: 1px;" name="product">
                                    <option value="all" selected>All Product</option>
                                    <option value="feature_product">Feature Product</option>
                                    <option value="trending_product">Trending Product</option>
                                    <option value="top_collection_product">Top Collection Product</option>

                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">All Products</span>
                                <!-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 orders</span> -->
                            </h3>
                            <div class="card-toolbar">


                            </div>
                        </div>

                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
                                    id="dataTableExample1" class="data-table" style="width:100%">
                                    <!--begin::Table head-->
                                    <thead class="text-center">
                                        <tr class="fw-bolder text-muted">
                                            <!-- <th class="min-w-150px">#</th> -->
                                            <th class="min-w-140px">Name</th>
                                            <th class="min-w-140px">Price</th>
                                            <th class="min-w-140px">Category Name</th>
                                            <th class="min-w-140px">Vendor</th>
                                            <th class="min-w-140px">Shop</th>
                                            <th class="min-w-120px">Image</th>
                                            <th class="min-w-100px text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($alldata as $key => $data)
                                        <tr>
                                            <!-- <td class="text-dark fw-bolder text-hover-primary fs-6"> {{ ++$key }} </td> -->
                                            <td>
                                                <a href="#">{{Str::limit($data->product_name, 20)}}</a>
                                            </td>
                                            <td>
                                                <a href="#">{{ $data->product_price  }} ৳</a>
                                            </td>
                                            <td>
                                                <a href="#">{{ $data->Category->name  }}</a>
                                            </td>
                                            <td>
                                                <a href="#">{{ $data->Vendor->name }}</a><br>
                                                <span>{{Str::limit( $data->Vendor->email, 15)}}</span>
                                            </td>
                                            <td>
                                                <a href="#">{{  $data->MainShop->shop_name ?? '' }}</a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/products/'.$data->image) }}" height="65px"
                                                    alt="">
                                            </td>
                                            <td class="text-end">
                                                @if($data->is_active==1)
                                                <a href="{{url('admin/all-approved/deactive/'.$data->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="fa fa-thumbs-up green"></i>
                                                </a>
                                                @else
                                                <a href="{{url('admin/all-approved/active/'.$data->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="fa fa-thumbs-down red"></i>
                                                </a>
                                                @endif
                                                {{-- <a href="{{url('admin/product/approve/'.$data->id)}}" class="btn
                                                btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="fas fa-thumbs-up blue"></i>
                                                </a> --}}
                                                <a href="{{url('admin/product/edit/'.$data->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{url('/admin/reject/product/'.$data->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                    <i class="fa fa-times validation"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
