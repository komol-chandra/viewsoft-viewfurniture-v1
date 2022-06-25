@extends('layouts.backend')
@section('title', 'Create Custom Choise To Order')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-place="true" data-kt-place-mode="prepend"
                data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Custom Choise To Order</h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-stretch overflow-auto row text-right">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 text-right">

                                <div class="mt-5" style="margin-left: 75px">
                                    <a href="{{ url('/admin/customer-custom-choose-request') }}"
                                        class="btn btn-primary">All data</a>
                                </div>
                            </div>
                        </div>
                        <form class="form" method="POST" id="kt_layout_builder_form"
                            action="{{ route('admin.custom-choose-request-order') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="" value="{{ $data->id }}">
                            <input type="hidden" name="user_id" id="" value="{{ $data->user_id }}">
                            <input type="hidden" name="vendor_id" id="" value="{{ $data->vendor_id }}">
                            <input type="hidden" name="product_id" id="" value="{{ $data->product_id }}">

                            <div class="card-body">
                                <div class=" col-md-6 mb-10">
                                    <label for="length">Product Name</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ $data->Product->product_name }}" disabled>
                                </div>
                                <div class=" col-md-3 mb-10">
                                    <label for="length">Product Price</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ $data->Product->product_price }}" disabled>
                                </div>
                                <div class=" col-md-3 mb-10">
                                    <label for="length">Product sku</label>
                                    <input type="text" class="form-control" name=""
                                        value="{{ $data->Product->product_sku }}" disabled>
                                </div>



                                <div class=" col-md-4 mb-10">
                                    <label for="color_id">Color: <span class="text-danger">(*)</span></label>
                                    <select class="form-control border-form-control" id="color_id" name="color_id"
                                        required style="height: 40px">
                                        @php
                                        $colors =
                                        App\Models\Color::where('is_deleted','0')->where('is_active','1')->get();
                                        @endphp
                                        @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ $data->color_id == $color->id ? "selected" :"" }}>
                                            {{ $color->color_name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" col-md-4 mb-10">
                                    <label for="finished_color_id">Finished: <span
                                            class="text-danger">(*)</span></label>
                                    <select class="form-control border-form-control" id="finished_color_id"
                                        name="finished_color_id" required style="height: 40px">
                                        @php
                                        $finfished_colors =
                                        App\Models\FinishedColor::where('is_deleted','0')->where('is_active','1')->get();
                                        @endphp
                                        @foreach ($finfished_colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ $data->finished_color_id == $color->id ? "selected" :"" }}>
                                            {{ $color->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('finished_color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" col-md-4 mb-10">
                                    <label for="material_id">Materials: <span class="text-danger">(*)</span></label>
                                    <select class="form-control border-form-control" id="material_id" name="material_id"
                                        required style="height: 40px">
                                        @php
                                        $materials =
                                        App\Models\Materials::where('is_deleted','0')->where('is_active','1')->get();
                                        @endphp
                                        @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            {{ $data->material_id == $material->id ? "selected" :"" }}>
                                            {{ $material->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" col-md-3 mb-10">
                                    <label for="hight">Hight(inch): <span class="text-danger">(*)</span></label>
                                    <input type="number" class="form-control" name="hight" value="{{ $data->hight }}"
                                        required>
                                    @error('hight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-3 mb-10">
                                    <label for="weight">Wegiht(inch): <span class="text-danger">(*)</span></label>
                                    <input type="number" class="form-control" name="weight" value="{{ $data->hight }}"
                                        required>
                                    @error('weight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-3 mb-10">
                                    <label for="length">Length(inch): <span class="text-danger">(*)</span></label>
                                    <input type="number" class="form-control" name="length" value="{{ $data->hight }}"
                                        required>
                                    @error('length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-3 mb-10">
                                    <label for="length">Product new price<span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="custom_product_price"
                                        value="{{ $data->custom_product_price }}" required>
                                    @error('custom_product_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            <div class="card-footer py-6 text-center">
                                <button type="submit" id="kt_layout_builder_preview" class="btn btn-primary me-2">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
