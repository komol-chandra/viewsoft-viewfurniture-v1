@extends('layouts.backend')
@section('title', 'Order Report')
@section('content')
<style>
    <style>
div.dataTables_wrapper div.dataTables_length select {

  height: 33px;
}
div.dataTables_wrapper div.dataTables_filter input {

    height: 25px;
}
</style>
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Order Report</h1>
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
                      
                        <form action="{{url('/admin/orderreport')}}" method="post">
                            @csrf
                                <div class="col-md-1">
                                
                                </div>
                                <div class="col-md-1">
                                    <div class="fs-6 fw-bold mt-2 mb-3">From</div>
                                </div>
                                <div class="col-md-3 fv-row">
                                    <div class="position-relative d-flex align-items-center">
                                        <input class="form-control form-control-solid  kt_datepicker_1" type="text" name="from" />
                                    </div>
                                </div> 
                                <div class="col-md-1">
                                    <div class="fs-6 fw-bold mt-2 mb-3">To</div>
                                </div>
                                <div class="col-md-3 fv-row">
                                    <div class="position-relative d-flex align-items-center">
                                        <input class="form-control form-control-solid  kt_datepicker_1" type="text" name="to" >
                                    </div>
                                </div>
                                <div class="col-md-2" style="">
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
                                            <th class="min-w-140px">Order Id</th>
                                            <th class="min-w-140px">Customer</th>
                                            <th class="min-w-140px">Quantity</th>
                                            <th class="min-w-120px">Amount</th>
                                            <th class="min-w-140px">Order Status</th>
                                            <th class="min-w-140px">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @if(isset($data))
                                        @foreach($data as  $key => $val)
                                            <tr>
                                                <td class="text-dark  text-hover-primary fs-6"> {{ ++$key }} </td>
                                                <td>
                                                    <a href="#" class="text-dark  text-hover-primary d-block mb-1 fs-6">{{ $val->order_id  }}</a>
                                                </td>
                                             
                                                <td>
                                                    <a href="#" class="text-dark d-block mb-1 fs-6">{{ $val->Customer->name  }}</a>
                                                     <span>{{ $val->Customer->phone  }}</span><br>
                                                     <span>{{ $val->Customer->email  }}</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $val->total_qty  }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $val->total_amount   }}</a>
                                                </td>
                                                <td>
                                                    @if($val->order_status == 0 )
                                                    <a href="#" class="text-dark text-hover-primary d-block mb-1 fs-6">Pending</a>
                                                    @elseif($val->order_status == 1 )
                                                    <a href="#" class="text-dark  text-hover-primary d-block mb-1 fs-6">Processing</a>
                                                    @elseif($val->order_status == 2 )
                                                    <a href="#" class="text-dark  text-hover-primary d-block mb-1 fs-6">Rejected</a>
                                                    @elseif($val->order_status == 3 )
                                                    <a href="#" class="text-dark text-hover-primary d-block mb-1 fs-6">Delivered</a>
                                                    @elseif($val->order_status == 4 )
                                                    <a href="#" class="text-dark text-hover-primary d-block mb-1 fs-6">Returned</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('admin/invoice/order/'.$val->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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