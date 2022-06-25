@extends('layouts.backend')
@section('title', 'All Order')
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
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend"
                data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">All New Order</h1>
                <!--end::Title-->
            </div>

        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-5 p-lg-8">
                    <div class="row">

                        <form action="{{route('admin.order.list')}}" method="get">

                            <div class="col-md-4">
                                <div class="fs-6 fw-bold mt-2 mb-3">Order Type</div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control form-control-solid"
                                    style="padding-top: 1px;padding-bottom: 1px;" name="order_type">
                                    <option value="all" selected>All</option>
                                    <option value="0">New</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Rejected</option>
                                    <option value="3">In Transit</option>
                                    <option value="4">Delevered To User</option>
                                    <option value="5">Return From User</option>
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
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">All Order Product</span>
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
                                            <th>#</th>
                                            <th class="min-w-150px">Date</th>
                                            <th class="min-w-140px">Order ID</th>
                                            <th class="min-w-140px">Details</th>
                                            <th class="min-w-140px">Customer</th>
                                            <th class="min-w-140px">Status</th>
                                            {{-- <th class="min-w-140px">Change</th> --}}
                                            <th class="min-w-100px text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($alldata as $key => $data)
                                        <tr>

                                            <td class="text-dark fw-bolder text-hover-primary fs-6"> {{ ++$key }} </td>
                                            <td>
                                                <a href="#">{{ $data->created_at->format('d-m-Y')  }}</a>
                                            </td>
                                            <td>
                                                <!-- <a href="#"> ৳</a> -->
                                                <a href="#">{{ $data->order_id  }}</a>
                                            </td>
                                            <td>
                                                <span>Item :{{ $data->total_item  }}</span><br>
                                                <span>Qty :{{ $data->total_qty  }}</span><br>
                                                <span>Amount :৳{{ $data->total_amount  }}</span>

                                            </td>

                                            <td>
                                                <a href="#">{{ $data->Customer->name }}</a><br><br>
                                                <span>{{ $data->Customer->email }}</span><br>
                                                <span>{{ $data->Customer->phone }}</span>
                                            </td>
                                            <td>
                                                <span class="btn-sm btn-primary">
                                                    {{-- {{ $data->order_status==1 ? "New" : "" }} --}}
                                                    @if($data->order_status==0)New
                                                    @elseif($data->order_status=='1')Pending
                                                    @elseif($data->order_status=='2')Rejected
                                                    @elseif($data->order_status=='3')In Transit
                                                    @elseif($data->order_status=='4')Delevered To User
                                                    @elseif($data->order_status=='5')Return From User
                                                    @else
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                {{-- <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{url('/admin/processing/order/'.$data->id)}}">Pending</a>
                                                <a class="dropdown-item"
                                                    href="{{url('/admin/reject/order/'.$data->id)}}">Rejected</a>
                                                <a class="dropdown-item"
                                                    href="{{url('admin/order/deliver/'.$data->id)}}">In
                                                    Transit</a>
                                                <a class="dropdown-item" href="#">Delevered To User</a>
                                                <a class="dropdown-item" href="#">Return From User</a>

                            </div>
                        </div> --}}
                        </td>
                        <td class="text-end">

                            <a href="{{url('admin/update/order/'.$data->id)}}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                data-toggle="tooltip" data-placement="top" title="Update Order">
                                <i class="fas fa-pen-square blue"></i>
                            </a>
                            <a href="{{url('admin/invoice/order/'.$data->id)}}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                data-toggle="tooltip" data-placement="top" title="View Order">
                                <i class="fas fa-eye blue"></i>
                            </a>
                            {{-- <a href="{{url('/admin/processing/order/'.$data->id)}}"
                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                            data-toggle="tooltip" data-placement="top" title="Approve On Delever">
                            <i class="fas fa-thumbs-up blue"></i>
                            </a>
                            <a href="{{url('/admin/reject/order/'.$data->id)}}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-toggle="tooltip"
                                data-placement="top" title="Cancel Order">
                                <i class="fa fa-times validation"></i>
                            </a> --}}
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
