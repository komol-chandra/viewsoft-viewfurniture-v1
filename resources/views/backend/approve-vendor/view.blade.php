@extends('layouts.backend')
@section('title', 'View Payment Request Report')
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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">View Request List</h1>
                <a href="{{ url('/admin/unapproved-vendor/index') }}" class="btn btn-sm btn-primary" style="margin-left: 20px;
                ">all</a>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body pt-0 pt-lg-1">
                    <!--begin::Summary-->
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <img src="{{ asset('uploads/user/' . $vendor->image) }}" alt="image">
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Name-->
                            <a href="#"
                                class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $vendor->company_name }}</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <div class="mb-9">
                                <!--begin::Badge-->
                                <div class="badge badge-lg badge-light-primary d-inline">Vendor <span>(
                                        {{ $allShop->count() }} shop)</span></div>
                                <!--begin::Badge-->
                            </div>
                            <!--end::Position-->
                            <!--begin::Info-->
                            <!--begin::Info heading-->
                            <div class="fw-bolder mb-3">vendor History
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                    data-bs-trigger="hover" data-bs-html="true"
                                    data-bs-content="Number of support tickets assigned, closed and pending this week."
                                    data-bs-original-title="" title=""></i>
                            </div>
                            <!--end::Info heading-->
                            <div class="d-flex flex-wrap flex-center">
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-75px">{{ $product }}</span>
                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Arrow-up.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <rect fill="#000000" opacity="0.5" x="11" y="5" width="2"
                                                        height="14" rx="1"></rect>
                                                    <path
                                                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <div class="fw-bold text-gray-400">Products</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-75px">0</span>
                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Arrow-up.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <rect fill="#000000" opacity="0.5" x="11" y="5" width="2"
                                                        height="14" rx="1"></rect>
                                                    <path
                                                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <div class="fw-bold text-gray-400">Pay Request</div>
                                </div>

                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-50px">{{wallet($vendor->id) - paidAmount($vendor->id)}}
                                            ৳</span>
                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Arrow-down.svg-->

                                        <!--end::Svg Icon-->
                                    </div>
                                    <div class="fw-bold text-gray-400">wallet</div>
                                </div>
                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-50px">{{ $order }}</span>
                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Arrow-up.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <rect fill="#000000" opacity="0.5" x="11" y="5" width="2"
                                                        height="14" rx="1"></rect>
                                                    <path
                                                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <div class="fw-bold text-gray-400"> total Orders</div>
                                </div>



                            </div>
                            <div class="d-flex flex-wrap flex-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            Basic Info
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Phone</div>
                                            <div class="text-gray-600">{{ $vendor->phone }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Email</div>
                                            <div class="text-gray-600">{{ $vendor->email }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">User Name</div>
                                            <div class="text-gray-600">{{ $vendor->name }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Age</div>
                                            <div class="text-gray-600">{{ $vendor->age }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Gender</div>
                                            <div class="text-gray-600">{{ $vendor->gender == 1 ? "Male" : "Female" }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">created_at</div>
                                            <div class="text-gray-600">{{ $vendor->created_at->format('Y-m-d') }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Approved Status</div>
                                            <div class="text-gray-600">
                                                {{ $vendor->is_vendor_approve == 1 ? "Approved" : "Not Approve Yet" }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Main Address</div>
                                            @php
                                            if($vendor->division != null){
                                            $division =
                                            Devfaysal\BangladeshGeocode\Models\Division::find($vendor->division);
                                            }else{
                                            $division = null;
                                            }
                                            if($vendor->city != null){
                                            $city =
                                            Devfaysal\BangladeshGeocode\Models\District::find(auth()->user()->city);
                                            }else{
                                            $city = null;
                                            }
                                            @endphp
                                            <div class="text-gray-600">
                                                @if($vendor->division != null)
                                                {{ $division }} ,
                                                @endif
                                                @if($vendor->city != null)
                                                {{ $city }} ,
                                                @endif
                                                {{ $vendor->main_address }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">zip_code</div>
                                            <div class="text-gray-600">
                                                {{ $vendor->zip_code}}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">sale_area</div>
                                            <div class="text-gray-600">
                                                {{ $vendor->sale_area}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 mt-4">
                                            Bank Info
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Account Number</div>
                                            <div class="text-gray-600">{{ $vendor->bank_account_number }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Bank Name</div>
                                            <div class="text-gray-600">
                                                <a href="#"
                                                    class="text-gray-600 text-hover-primary">{{ $vendor->bank_name }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">I Ban</div>
                                            <div class="text-gray-600">{{ $vendor->i_ban }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">bank Address</div>
                                            <div class="text-gray-600">{{ $vendor->bank_address }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">Routing Number</div>
                                            <div class="text-gray-600">{{ $vendor->routing_number }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">swift code</div>
                                            <div class="text-gray-600">{{ $vendor->swift_code }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">mobile bank name</div>
                                            <div class="text-gray-600">{{ $vendor->mobile_bank_name }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fw-bolder mt-5">mobile bank number</div>
                                            <div class="text-gray-600">{{ $vendor->mobile_bank_number }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>

                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/view.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/update-details.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/add-schedule.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/add-task.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/update-email.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/update-password.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/update-role.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/add-auth-app.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/user-management/users/view/add-one-time-password.js">
</script>
<script src="{{ asset('backend') }}/assets/js/custom/widgets.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/apps/chat/chat.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/modals/create-app.js"></script>
<script src="{{ asset('backend') }}/assets/js/custom/modals/upgrade-plan.js"></script>
@endsection
