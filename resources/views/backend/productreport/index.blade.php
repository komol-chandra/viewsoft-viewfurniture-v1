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
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
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
                      
                        <form action="{{url('/admin/productreport')}}" method="post">
                            @csrf

                                <div class="col-md-3">
                                    
                                </div>
                              


                                <div class="col-md-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Product</div>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-control-solid"  style="padding-top: 1px;padding-bottom: 1px;" name="product">
                                        <option value="all" selected>All Product</option>
                                        @foreach ($alldata as $item)
                                        <option value="{{$item->id}}">{{$item->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 
                                <div class="col-md-1">

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
                        <div class="card-body py-3">
                            
                           
                           
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3" id="dataTableExample1" class="data-table" style="width:100%">
                                    <!--begin::Table head-->
                                    <thead class="text-center">
                                        <tr class="fw-bolder text-muted">
                                            <th>#</th>
                                            <th class="min-w-140px">Name</th>
                                            <th class="min-w-140px">Sku</th>
                                            <th class="min-w-140px">Sale Qty</th>
                                            <th class="min-w-120px">Stock Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @if(isset($data))
                                        @foreach($data as  $key => $product)
                                            <tr>
                                                <td class="text-dark fw-bolder text-hover-primary fs-6"> {{ ++$key }} </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $product->product_name  }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $product->product_sku  }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $product->sell_qty  }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ intval(round($product->product_qty))   - $product->sell_qty   }}</a>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    @endif
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