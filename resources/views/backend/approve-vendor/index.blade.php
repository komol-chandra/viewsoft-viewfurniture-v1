@extends('layouts.backend')
@section('title', 'Payment Request Report')
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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Vendor Request Report</h1>
                <!--end::Title-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            {{-- <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-5 p-lg-8">
                    <div class="row">

                        <form action="{{url('/admin/payment-request-list')}}" method="get">
            <div class="col-md-1">
                <div class="fs-6 fw-bold mt-2 mb-3">From</div>
            </div>
            <div class="col-md-2 fv-row">
                <div class="position-relative d-flex align-items-center">
                    <input class="form-control form-control-solid  kt_datepicker_1" type="text" name="from" required />
                </div>
            </div>
            <div class="col-md-1">
                <div class="fs-6 fw-bold mt-2 mb-3">To</div>
            </div>
            <div class="col-md-2 fv-row">
                <div class="position-relative d-flex align-items-center">
                    <input class="form-control form-control-solid  kt_datepicker_1" type="text" name="to" required>
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
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5 mb-xl-8">
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
                        id="dataTableExample1" class="data-table" style="width:100%">
                        <!--begin::Table head-->

                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone</th>
                                <th scope="col">Created At</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($vendors!=null)
                            @foreach($vendors as $key => $data)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->emial }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->created_at->format('Y-m-d') }}</td>


                                <td>
                                    @if($data->is_vendor_approve == 0)
                                    <a href="{{url('/admin/approve-vendor-status/approve/'.$data->id)}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fas fa-thumbs-up blue"></i>
                                    </a>
                                    @else
                                    <a href="{{url('/admin/approve-vendor-status/approve/'.$data->id)}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="fa fa-times validation"></i>
                                    </a>
                                    @endif
                                    <a href="{{ url('/admin/unapproved-vendor/view/'.$data->id) }}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                     --}}
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
