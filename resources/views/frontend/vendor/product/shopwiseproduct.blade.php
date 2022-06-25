@extends('layouts.frontend')
@section('title', 'Shop-Products')
@section('css')
<style>
     .fw-bold {
        font-weight: 400 !important;
        font-size: 14px !important;
    }

    .bootstrap-tagsinput {
        background-color: #f5f8fa;
        border-color: #f5f8fa;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 4px 6px;
        color: #b9b9b9;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 25px;
        cursor: text;
        width: 100%;
        background: aliceblue;
    }
    div.dataTables_wrapper div.dataTables_length select {
        height: 33px;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        height: 25px;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/asif.css">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{asset('backend')}}/assets/css/image-uploader.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection
@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>vendor dashboard</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">vendor dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->
    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.vendor.dashboard.include.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="products">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-md">
                                            <div class="top-sec">
                                                <h3>All Product</h3>
                                                <a class="btn btn-sm btn-solid"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" href="#" >Add Product</a>
                                            </div>
                                            <div class="row">
                                                @foreach($allshop as $shop)
                                                <div class="col-md-3">
                                                    <a href="{{url('vendor/shopwise/product/'.$shop->id)}}" class="btn btn-success" style="font-size:12px">{{ $shop->shop_name }}</a>
                                                </div>
                                                @endforeach
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
<!-- create product -->
<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h5>Create Product</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.5"
                                    transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                    x="0" y="7" width="16" height="2" rx="1" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <!--begin::Stepper-->
                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                    id="kt_modal_create_app_stepper">
                    <!--begin::Aside-->
                    <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                        <!--begin::Nav-->
                        <div class="stepper-nav ps-lg-10">
                            <!--begin::Step 1-->
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Basic Information</h3>
                                    <div class="stepper-desc"></div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <!--begin::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Display Option</h3>
                                    <div class="stepper-desc">Define your app framework</div>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <!--begin::Line-->
                                <div class="stepper-line w-40px"></div>
                                <!--end::Line-->
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">3</span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Image</h3>
                                    <div class="stepper-desc">Select the app database type</div>
                                </div>
                                <!--end::Label-->
                            </div>

                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--begin::Aside-->
                    <!--begin::Content-->
                    <div class="flex-row-fluid py-lg-5 px-lg-15">
                        <!--begin::Form-->
                        <form class="form" method="post" novalidate="novalidate" id="kt_modal_create_app_form"
                            action="{{ route('vendor.product') }}" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Step 1-->
                            <div class="current" id="basic" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Product Title</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <input type="text" required
                                            class="form-control form-control-solid product_title" name="product_name"
                                            placeholder="Enter Product Title" />

                                        @error('product_name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Product Sku</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <input type="text" required class="form-control form-control-solid"
                                            name="product_sku" placeholder="Enter Product Sku" />
                                        @error('product_name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Product Qty</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <input type="number" required
                                            class="form-control form-control-solid product_title" name="product_qty"
                                            placeholder="Enter Product Stock Qty" />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Shop</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <select name="product_shop"
                                            class="form-control form-control-solid product_shop">
                                            <option disabled selected>--select--</option>
                                            @foreach($allshop as $shop)
                                            <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Product Category</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <select name="category" id="category" class="form-control form-control-solid">
                                            <option selected disabled>--select--</option>
                                            @if(Auth::user()->id==41)
                                                @foreach($allCategory as $category)
                                                    <option value="{{ $category->id }}">{{  $category->name  }}</option>
                                                @endforeach
                                            @else
                                                @foreach($allCategory->skip(1) as $category)
                                                    <option value="{{ $category->id }}">{{  $category->name  }}</option>
                                                   
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">SubCategory</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <select name="subcategory" id="subcategory"
                                            class="form-control form-control-solid">
                                            <option selected disabled>--select--</option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">ReSubCategory</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <select name="resubcategory" id="resubcategory"
                                            class="form-control form-control-solid">
                                            <option selected disabled>--select--</option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Brand (Optional)</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="product_brand"
                                            placeholder="Enter Brand" value="" />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Price</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <input type="text" required class="form-control  form-control-solid"
                                            name="price" placeholder="Enter Price" value="" />
                                        @error('price')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Details</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <textarea id="editor1" class="form-control form-control-solid"
                                            name="product_details"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end::Step 1-->
                            <div class="" id="display" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <div class="fv-row mb-10" id="Product_Size_Optional">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Product Size(Optional)</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <input type="text" data-role="tagsinput"
                                                class="form-control form-control-solid tags" name="product_size"
                                                placeholder="Enter Product Size" />
                                        </div>
                                        <div class="fv-row mb-10" id="Weight_optional">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Weight(Optional)</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <input type="text" class="form-control  form-control-solid"
                                                name="product_weight" placeholder="Enter Weight" />
                                        </div>
                                        <div class="fv-row mb-10" id="Style_Optional">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Style(Optional)</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <input type="text" class="form-control  form-control-solid" name="product_style" placeholder="Enter Style"/>


                               
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Materials(Optional)</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="product_materials" placeholder="Enter Materials" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Product Condition</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <select name="product_condition" class="form-control form-control-solid">
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="Used">Used(Good)</option>
                                                <option value="Used Like New">Used(Like New)</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Product Tags</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify your unique app name"></i>
                                            </label>
                                            <input type="text" data-role="tagsinput"
                                                class="form-control form-control-solid tags" name="tag"
                                                placeholder="Enter Tags" />
                                        </div>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <div class="" id="img" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="fv-row mb-10">
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input have_a_discount" name="have_a_discount"
                                                type="checkbox" value="1">
                                            <span class="form-check-label fw-bold text-gray-400">Have A Discount</span>
                                        </label>
                                        <br>
                                    </div>
                                    <div class="fv-row mb-10" id="discount_price" style="display:none">
                                        <!-- fav end -->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Offer</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your unique app name"></i>
                                        </label>
                                        <div class="mb-0">
                                            <label class="d-flex flex-stack mb-0 cursor-pointer">
                                                <!--begin:Label-->
                                                <span class="d-flex align-items-center me-2">
                                                    <!--begin::Icon-->
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Line-03-Down.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-gray-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.25"
                                                                        d="M1 5C1 3.89543 1.89543 3 3 3H21C22.1046 3 23 3.89543 23 5V19C23 20.1046 22.1046 21 21 21H3C1.89543 21 1 20.1046 1 19V5Z"
                                                                        fill="#12131A"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M20.8682 17.5035C21.1422 17.9831 20.9756 18.5939 20.4961 18.8679C20.0166 19.1419 19.4058 18.9753 19.1317 18.4958L15.8834 12.8113C15.6612 12.4223 15.2073 12.2286 14.7727 12.3373L9.71238 13.6024C8.40847 13.9283 7.04688 13.3473 6.38005 12.1803L3.13174 6.49582C2.85773 6.0163 3.02433 5.40545 3.50385 5.13144C3.98337 4.85743 4.59422 5.02403 4.86823 5.50354L8.11653 11.1881C8.33881 11.5771 8.79268 11.7707 9.22731 11.6621L14.2876 10.397C15.5915 10.071 16.9531 10.6521 17.6199 11.819L20.8682 17.5035Z"
                                                                        fill="#12131A"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <span class="d-flex flex-column">
                                                        <span
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-5">None</span>
                                                    </span>
                                                    <!--end:Description-->
                                                </span>
                                                <!--end:Label-->
                                                <!--begin:Input-->
                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input Special" type="radio" name="offer"
                                                        value="none">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </span>
                                                <!--end:Input-->
                                            </label>
                                            <!--end::Option-->
                                            <!--begin:Option-->
                                            <label class="d-flex flex-stack mb-0 cursor-pointer">
                                                <!--begin:Label-->
                                                <span class="d-flex align-items-center me-2">
                                                    <!--begin::Icon-->
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Line-03-Down.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-gray-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.25"
                                                                        d="M1 5C1 3.89543 1.89543 3 3 3H21C22.1046 3 23 3.89543 23 5V19C23 20.1046 22.1046 21 21 21H3C1.89543 21 1 20.1046 1 19V5Z"
                                                                        fill="#12131A"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M20.8682 17.5035C21.1422 17.9831 20.9756 18.5939 20.4961 18.8679C20.0166 19.1419 19.4058 18.9753 19.1317 18.4958L15.8834 12.8113C15.6612 12.4223 15.2073 12.2286 14.7727 12.3373L9.71238 13.6024C8.40847 13.9283 7.04688 13.3473 6.38005 12.1803L3.13174 6.49582C2.85773 6.0163 3.02433 5.40545 3.50385 5.13144C3.98337 4.85743 4.59422 5.02403 4.86823 5.50354L8.11653 11.1881C8.33881 11.5771 8.79268 11.7707 9.22731 11.6621L14.2876 10.397C15.5915 10.071 16.9531 10.6521 17.6199 11.819L20.8682 17.5035Z"
                                                                        fill="#12131A"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <span class="d-flex flex-column">
                                                        <span class="fw-bolder text-gray-800 text-hover-primary fs-5">11
                                                            Offer</span>
                                                    </span>
                                                    <!--end:Description-->
                                                </span>
                                                <!--end:Label-->
                                                <!--begin:Input-->
                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input Special" type="radio" name="offer"
                                                        value="11_offer" checked="checked">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </span>
                                                <!--end:Input-->
                                            </label>
                                            <!--end::Option-->
                                            <label class="d-flex flex-stack mb-0 cursor-pointer">
                                                <!--begin:Label-->
                                                <span class="d-flex align-items-center me-2">
                                                    <!--begin::Icon-->
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Line-03-Down.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-gray-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.25"
                                                                        d="M1 5C1 3.89543 1.89543 3 3 3H21C22.1046 3 23 3.89543 23 5V19C23 20.1046 22.1046 21 21 21H3C1.89543 21 1 20.1046 1 19V5Z"
                                                                        fill="#12131A"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M20.8682 17.5035C21.1422 17.9831 20.9756 18.5939 20.4961 18.8679C20.0166 19.1419 19.4058 18.9753 19.1317 18.4958L15.8834 12.8113C15.6612 12.4223 15.2073 12.2286 14.7727 12.3373L9.71238 13.6024C8.40847 13.9283 7.04688 13.3473 6.38005 12.1803L3.13174 6.49582C2.85773 6.0163 3.02433 5.40545 3.50385 5.13144C3.98337 4.85743 4.59422 5.02403 4.86823 5.50354L8.11653 11.1881C8.33881 11.5771 8.79268 11.7707 9.22731 11.6621L14.2876 10.397C15.5915 10.071 16.9531 10.6521 17.6199 11.819L20.8682 17.5035Z"
                                                                        fill="#12131A"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <span class="d-flex flex-column">
                                                        <span class="fw-bolder text-gray-800 text-hover-primary fs-5">22
                                                            Offer</span>
                                                    </span>
                                                    <!--end:Description-->
                                                </span>
                                                <!--end:Label-->
                                                <!--begin:Input-->
                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input Special" type="radio" name="offer"
                                                        value="22_offer">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </span>
                                                <!--end:Input-->
                                            </label>
                                            <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                <!--begin:Label-->
                                                <span class="d-flex align-items-center me-2">
                                                    <!--begin::Icon-->
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Doughnut.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-gray-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.25" fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M11 4.25769C11 3.07501 9.9663 2.13515 8.84397 2.50814C4.86766 3.82961 2 7.57987 2 11.9999C2 13.6101 2.38057 15.1314 3.05667 16.4788C3.58731 17.5363 4.98303 17.6028 5.81966 16.7662L5.91302 16.6728C6.60358 15.9823 6.65613 14.9011 6.3341 13.9791C6.11766 13.3594 6 12.6934 6 11.9999C6 9.62064 7.38488 7.56483 9.39252 6.59458C10.2721 6.16952 11 5.36732 11 4.39046V4.25769ZM16.4787 20.9434C17.5362 20.4127 17.6027 19.017 16.7661 18.1804L16.6727 18.087C15.9822 17.3964 14.901 17.3439 13.979 17.6659C13.3594 17.8823 12.6934 17.9999 12 17.9999C11.3066 17.9999 10.6406 17.8823 10.021 17.6659C9.09899 17.3439 8.01784 17.3964 7.3273 18.087L7.23392 18.1804C6.39728 19.017 6.4638 20.4127 7.52133 20.9434C8.86866 21.6194 10.3899 21.9999 12 21.9999C13.6101 21.9999 15.1313 21.6194 16.4787 20.9434Z"
                                                                        fill="#12131A"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M13 4.39046C13 5.36732 13.7279 6.16952 14.6075 6.59458C16.6151 7.56483 18 9.62064 18 11.9999C18 12.6934 17.8823 13.3594 17.6659 13.9791C17.3439 14.9011 17.3964 15.9823 18.087 16.6728L18.1803 16.7662C19.017 17.6028 20.4127 17.5363 20.9433 16.4788C21.6194 15.1314 22 13.6101 22 11.9999C22 7.57987 19.1323 3.82961 15.156 2.50814C14.0337 2.13515 13 3.07501 13 4.25769V4.39046Z"
                                                                        fill="#12131A"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <span class="d-flex flex-column">
                                                        <span
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-5">Special
                                                            Offer</span>

                                                    </span>
                                                    <!--end:Description-->
                                                </span>
                                                <!--end:Label-->
                                                <!--begin:Input-->
                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input Special" type="radio" name="offer"
                                                        value="special_offer">
                                                </span>
                                                <!--end:Input-->
                                            </label>
                                            <div class="row" id="special_sec" style="display:none;">
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" required
                                                        name="discount_price" placeholder="Enter Discount Price"
                                                        value="" />
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="discount_price_type"
                                                        class="form-control form-control-solid">
                                                        <option value="percent">%</option>
                                                        <option value="taka">TK</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-5 text-center">
                                                    <span class="d-flex flex-column">
                                                        <span
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-5">Date</span>
                                                    </span>
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input special_section" type="radio"
                                                            data-id="1" name="discount_condition" value="date"
                                                            style="margin: 10px 90px;">
                                                    </span>
                                                </div>
                                                <div class="col-md-6 mt-5 text-center">
                                                    <span class="d-flex flex-column">
                                                        <span
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-5">Stock</span>
                                                    </span>
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input s_section" type="radio"
                                                            data-id="2" name="discount_condition" value="Stock"
                                                            style="margin: 10px 90px;">
                                                    </span>
                                                </div>
                                                <div class="col-md-12 row" id="main_date_section" style="display:none">
                                                    <div class="col-md-6 mt-5">
                                                        <input type="date" name="from_date"
                                                            class="form-control  form-control-solid"
                                                            placeholder="Enter From Date">
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <input type="date" name="to_date"
                                                            class="form-control  form-control-solid"
                                                            placeholder="Enter To Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 row" id="main_stock_section" style="display:none">
                                                    <div class="col-md-6 mt-5 text-center">
                                                        <span class="d-flex flex-column">
                                                            <span
                                                                class="fw-bolder text-gray-800 text-hover-primary fs-5">All
                                                                Stock</span>
                                                        </span>
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input all_stock" type="radio"
                                                                name="offer_stock_type" value="all_stock"
                                                                style="margin: 10px 90px;">
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 mt-5 text-center">
                                                        <span class="d-flex flex-column">
                                                            <span
                                                                class="fw-bolder text-gray-800 text-hover-primary fs-5">Limit
                                                                Qty</span>
                                                        </span>
                                                        <span class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input limit_qty" type="radio"
                                                                name="offer_stock_type" value="limit_qty"
                                                                style="margin: 10px 90px;">
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6 mt-5" id="all_stock_qty" style="display:none">
                                                        <div class="fv-row mb-10">
                                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                <span class="required">Qty</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Specify your unique app name"></i>
                                                            </label>
                                                            <input type="text" class="form-control  form-control-solid"
                                                                name="offer_qty" placeholder="Enter Qty" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <!--begin::Input group-->
                                    </div>
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-4">
                                            <span class="required">Image</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your apps framework"></i>
                                        </label>
                                        <div class="row mb-10">
                                            <div class="col-lg-12 col-xl-12">
                                                <div id="product_img"></div>
                                            </div>
                                        </div>
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-4">
                                            <span class="required">Gallary Image</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="Specify your apps framework"></i>
                                        </label>
                                        <div class="row mb-10">
                                            <div class="col-xl-12 col-lg-12 row">
                                                <div class="input-images"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>

                            </div>
                            <div class="d-flex flex-stack pt-10">
                                <div>
                                    <button type="button" class="btn btn-lg btn-light-primary me-3 continuetwoback"
                                        style="display:none">Back</button>
                                    <button type="button" class="btn btn-lg btn-light-primary me-3 continuethreeback"
                                        style="display:none">Back</button>
                                    <button type="button" class="btn btn-lg btn-primary continue">Continue</button>
                                    <button type="button" class="btn btn-lg btn-primary continuetwo"
                                        style="display:none">Continue</button>
                                    <button type="submit" class="btn btn-lg btn-primary continuethree"
                                        style="display:none">Submit</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- update product -->
<div class="modal fade" id="kt_modal_update_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content" id="update_value">

        </div>
    </div>
</div>
<!-- start  -->
@endsection

@section('js_before')
<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="{{asset('backend')}}/assets/plugins/ckeditor/ckeditor-active.js"></script>
<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>
<script src="{{asset('backend')}}/assets/js/spartan-multi-image-picker.js"></script>
<script src="{{asset('backend')}}/assets/plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/datatabels/dataTables-active.js"></script>
    <!--==========  summernote  ============= -->
    {{-- <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script> --}}
    <script>
        $('.input-images').imageUploader();
    </script>
@endsection
@section('js')
<script>
 function updateProduct(el){
   
     var id=el.id;
     $("#update_value").empty();
       if (id) {
                $.ajax({
                    url: "{{  url('/vendor/get/shop/edit/') }}/" + id,
                    type: "GET",
                    cache: false,
                    success: function(data) {
                       
                        $("#update_value").html(data);

                    }

                });
            }
 }
</script>
<script>
       $(document).ready(function(){

       $(".editshop").click(function(){
            $("#update_value").empty();
            
            var id=$(this).data("id");
            if (id) {
                $.ajax({
                    url: "{{  url('/vendor/get/shop/edit/') }}/" + id,
                    type: "GET",
                    success: function(data) {

                        $("#update_value").html(data);

                    }

                });
            }
       });
    });
</script>
<script>
$(document).ready(function(){ 
	$('#perdisabled').click(function() {      
		var update_btn = $(this);      
		update_btn.prop('disabled', true);     
		setTimeout(function() {         
		update_btn.prop('disabled', false);     
		},5000);   
	}); 
});
</script>
<!-- update end -->
<script>
    $(document).ready(function(){
        $(".product_shop").change(function(){
            var shop_id=$(this).val();

            if (shop_id) {
                $.ajax({
                    url: "{{  url('/get/shop/type/') }}/" + shop_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                      if(data.id==2){
                        $("#Weight_optional").hide();
                      }else if(data.id==4){
                            $("#gender_optional").hide();
                            $("#Weight_optional").show();
                            $("#age_group_optional").hide();
                            $("#Product_Size_Optional").hide();
                            $("#Style_Optional").hide();
                        }
                    }
                });
            }
        });

    });

</script>

<script>
    $(document).ready(function(){
        $(".all_stock").click(function(){
            $("#all_stock_qty").hide();
        });

        $(".limit_qty").click(function(){
            $("#all_stock_qty").show();
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".special_section").click(function(){
            $("#main_date_section").show();
            $("#main_stock_section").hide();
        });

        $(".s_section").click(function(){
            $("#main_date_section").hide();
            $("#main_stock_section").show();
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(".have_a_discount").click(function(){
           
            if($(this).is(":checked")) {
                $("#discount_price").show();
               
            }else{
                $("#discount_price").hide();
               
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".Special").click(function(){
            
            var val=$(this).val();
            if(val=='special_offer') {
             
                $("#special_sec").show();
            }else{
                $("#special_sec").hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".continue").click(function(){
            $("#display").attr("class", "current");
            $("#basic").removeClass("current");
            $("#continue").removeClass("continue");
            $(".continue").hide();
            $(".continuetwo").show();
            $(".continuetwoback").show();
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".continuetwo").click(function(){
            $(".continuetwo").hide();
            $("#display").removeClass("current");
            $("#img").attr("class", "current");
            $(".continuethree").show();
            $(".continuethreeback").show();
            $(".continuetwoback").hide();
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(".continuethreeback").click(function(){
            $("#img").removeClass("current");
            $("#display").attr("class", "current");
            $(".continuethree").hide();
            $(".continuetwo").show();
            $(".continuethreeback").hide();
            $(".continuetwoback").show();
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".continuetwoback").click(function(){
            $("#display").removeClass("current");
            $("#basic").attr("class", "current");
            $("#img").removeClass("current");
            $(".continuetwoback").hide();
            $(".continue").show();
            $(".continuetwo").hide();
            $(".continuethree").hide();
            
        });
    });
</script>
<script>
    document.querySelector("#kt_create_account_form > div.current > div > div.mb-10.fv-row.fv-plugins-icon-container.fv-plugins-bootstrap5-row-valid")
</script>
<!-- <script type="text/javascript" src="http://example.com/jquery.min.js"></script> -->


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
       //  resubcategory
        $('select[name="subcategory"]').on('change', function() {
            var subcate_id = $(this).val();

            if (subcate_id) {
                $.ajax({
                    url: "{{  url('/get/resubcategory/all/') }}/" + subcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#resubcategory').empty();
                        $('#resubcategory').append(' <option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#resubcategory').append('<option value="' + districtObj.id + '">' + districtObj.name + '</option>');
                        });


                    }
                });
            } else {
                //  alert('danger');
            }
            // re re subcategory get
         
        });
        $('select[name="resubcategory"]').on('change', function() {
            var resubcate_id = $(this).val();

            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/reresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#childresubcategory').empty();
                        $('#childresubcategory').append(' <option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#childresubcategory').append('<option value="' + districtObj.id + '">' + districtObj.name + '</option>');
                        });
                    }
                });
            } else {
                //  alert('danger');
            }

             });


         $('select[name="childresubcategory"]').on('change', function() {
            
            var resubcate_id = $(this).val();
            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/rereresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#grandchildresubcategory').empty();
                        $('#grandchildresubcategory').append('<option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#grandchildresubcategory').append('<option value="' + districtObj.id + '">' + districtObj.name + '</option>');
                        });

                    }
                });
            } else {
                //  alert('danger');
            }
        });
    });
</script>

<script>
    $(document).on("click", "#delete", function(e) {
       alert("are you sure Delete It");
     
    });
    </script>
@endsection