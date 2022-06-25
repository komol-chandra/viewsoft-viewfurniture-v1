@extends('layouts.backend')
@section('title', 'Update ReSubCategory')
@section('content')
<style>
    .form-control.form-control-solid {

    height: 40px;
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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">ReSubCategory</h1>
                <!--end::Title-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Layout Builder Notice-->
            <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-5 p-lg-8">
                    <!--begin::Icon-->
                    <div class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-shrink-0 flex-center position-relative align-self-start align-self-lg-center mt-3 mt-lg-0">
                        <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-polygon.svg-->
                        <span class="svg-icon svg-icon-primary position-absolute opacity-15">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none" class="h-50px w-50px h-lg-80px w-lg-80px">
                                <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--begin::Svg Icon | path: icons/duotone/Tools/Tools.svg-->
                        <span class="svg-icon svg-icon-2x svg-icon-lg-3x svg-icon-primary position-absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z" fill="#000000"></path>
                                    <path d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Icon-->
                    <!--begin::Description-->
                    <div class="ms-6">
                        <p class="list-unstyled text-gray-600 fw-bold fs-6 p-0 m-0">Update ReSubCategory</p>
                    </div>
                    <!--end::Description-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-stretch overflow-auto row text-right">
                           <div class="col-md-10"></div>
                           <div class="col-md-2 text-right">
                               
                           <div class="mt-5" style="margin-left: 30px">
                                    <a href="{{ route('admin.resubcategory.index') }}" class="btn btn-primary">All ReSubCategory</a>
                                </div>
                           </div>
                        </div>
                        <form class="form" method="POST" id="kt_layout_builder_form" action="{{ route('admin.resubcategory.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body" data-select2-id="select2-data-90-elj6">
                                <div class="tab-content pt-3" data-select2-id="select2-data-89-mk7z">
                                    <div class="tab-pane active" id="kt_builder_main" data-select2-id="select2-data-kt_builder_main">
                                        
                                            <div class="row mb-10">
                                                <label class="col-lg-3 col-form-label text-lg-end">Category:</label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <div class="form-check form-check-custom form-check-solid form-switch mb-2">
                                                        <input type="hidden" value="{{ $edit->id }}" name="id">
                                                        <select name="category" id="category" class="form-control form-control-solid">
                                                            <option selected disabled>--select--</option>
                                                            @foreach($allCategory as $caegory)
                                                            <option value="{{ $caegory->id }}" @if($edit->category==$caegory->id) selected @endif>{{ $caegory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('category')
                                                        <div class="validation">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        <div class="row mb-10">
                                            <label class="col-lg-3 col-form-label text-lg-end">SubCategory:</label>
                                            <div class="col-lg-9 col-xl-4">
                                                <div class="form-check form-check-custom form-check-solid form-switch mb-2">
                                                    <select name="subcategory" id="subcategory" class="form-control form-control-solid">
                                                            <option selected disabled>--select--</option>
                                                            @foreach($allSubCategory as $subcategory)
                                                             @if($subcategory->category==$edit->category)
                                                            <option value="{{ $subcategory->id }}" @if($edit->sub_category==$subcategory->id) selected @endif>{{ $subcategory->name }}</option>
                                                            @endif
                                                            @endforeach
                                                    </select>
                                                </div>
                                                @error('subcategory')
                                                        <div class="validation">{{ $message }}</div>
                                               @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-10">
                                            <label class="col-lg-3 col-form-label text-lg-end">ReSubCategory Name:</label>
                                            <div class="col-lg-9 col-xl-4">
                                                <div class="form-check form-check-custom form-check-solid form-switch mb-2">
                                                   <input type="text" class="form-control" name="name" value="{{ $edit->name }}" placeholder="Enter ResubCategory">
                                                </div>
                                                @error('name')
                                                        <div class="validation">{{ $message }}</div>
                                               @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer py-6">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <button type="submit" id="kt_layout_builder_preview" class="btn btn-primary me-2">
                                            <span class="indicator-label">Update</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!-- <button type="button" id="kt_layout_builder_reset" class="btn btn-active-light btn-color-muted">
                                            <span class="indicator-label">Reset</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button> -->
                                    </div>
                                </div>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="category"]').on('change', function() {
            var cate_id = $(this).val();
            // alert(cate_id);

            if (cate_id) {
                $.ajax({
                    url: "{{  url('/get/subcategory/all/') }}/" + cate_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#subcategory').empty();
                        $('#subcategory').append(' <option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#subcategory').append('<option value="' + districtObj.id + '">' + districtObj.name + '</option>');
                        });

                    }
                });
            } else {
                //  alert('danger');
            }

        });
        //  resubcategory
    });
</script>
@endsection