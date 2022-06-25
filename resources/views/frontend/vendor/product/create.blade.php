@extends('layouts.frontend')
@section('title', 'Create-Products')
@section('content')
<link type="text/css" rel="stylesheet" href="{{asset('backend')}}/assets/css/image-uploader.min.css">
<style>
    .order-histry-area .order-history .profile-form {
        width: calc(100% - 30px) !important;
        margin-left: 30px;
    }

    span.selection {
        display: block !important;
    }

    input[type="checkbox"] {
        height: 26px;
        width: 19px;
        margin-top: 20px;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 7px 20px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 23px;
        cursor: text;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        display: inline-block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        width: 100%;
        line-height: 22px;
        cursor: text;
    }

    .badge {

        padding: 0.35em 0.65em;
        font-size: 17px;
        color: #fff;
        background: #7db100;
        margin: 0px 2px;

    }

    label.form-check-label.mt-2 {
        margin: 10px 25px 0px 20px;
        padding: 14px 0px;
    }

    .form-check-input[type=radio] {
        border-radius: 17%;
    }

    .form-check-input {
        width: 2em;
        height: 2em;
        margin-top: 0.25em;
        vertical-align: top;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 1px solid rgba(0, 0, 0, .25);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }

    label.form-check-label {
        padding: 10px 13px;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<section class="order-histry-area section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <a href="{{ url('/vendor/product') }}" class="btn btn-style1">Back To Products</a>
            </div>
            <div class="col">
                <div class="order-history" style="width:100%">
                    <div class="profile-form">
                        <form action="{{ route('vendor.product.create') }}" method="post" class="row" id="choice_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-md-8 form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" onchange="update_sku()" class="form-control"
                                        placeholder="Enter Product name" value="{{old('product_name')}}">
                                    @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputEmail1">Product Sku</label>
                                    <input type="text" name="product_sku" class="form-control"
                                        placeholder="Enter Product Sku" value="{{old('product_sku')}}">
                                    @error('product_sku')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mt-4">
                                <div class="col-md-3 form-group ">
                                    <label for="exampleInputEmail1">Product Price</label>
                                    <input type="text" name="unit_price" class="form-control"
                                        placeholder="Enter Product Price" value="{{old('unit_price')}}">
                                    @error('unit_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="exampleInputEmail1">Product Stock Qty</label>
                                    <input type="number" name="product_qty" class="form-control"
                                        placeholder="Enter Product Qty" value="{{old('product_qty')}}">
                                    @error('product_qty')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="exampleInputEmail1">Product Brand(Optional)</label>
                                    <select name="product_brand" id="product_brand"
                                        class="form-control border-form-control" style="height: 40px">
                                        <option disabled selected>select</option>
                                        @foreach($allbrand as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="exampleInputEmail1">Product Condition</label>
                                    <select name="product_condition" id="product_condition"
                                        class="form-control border-form-control" style="height: 40px">
                                        <option disabled selected>select</option>
                                        <option value="1">New</option>
                                        <option value="2">Used</option>
                                        <option value="3">Used(Good)</option>
                                        <option value="4">Used(Like Good)</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row  mt-4">
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="category" id="category" class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($allCategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">SubCategory</label>
                                    <select name="subcategory" id="subcategory"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="resubcategory">ReSubCategory</label>
                                    <select name="resubcategory" id="resubcategory"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="child_resubcategory">ReReSubCategory</label>
                                    <select name="child_resubcategory" id="child_resubcategory"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="grand_childresubcategory_id">ReReReSubCategory</label>
                                    <select name="grand_childresubcategory_id" id="grand_childresubcategory_id"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Shop</label>
                                    <select name="product_shop" id="product_shop"
                                        class="form-control border-form-control">
                                        <option selected disabled>select</option>
                                        @foreach($allshop as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shop')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-2 form-group">
                                    <label for="exampleFormControlSelect1">Finished </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="finished_color_id"
                                        required>
                                        @php
                                        $finfished_colors =
                                        App\Models\FinishedColor::where('is_deleted','0')->where('is_active','1')->get();
                                        @endphp
                                        <option selected disabled>select</option>

                                        @foreach ($finfished_colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('finished_color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Decor Style</label>
                                    <input type="text" name="decor_style" class="form-control"
                                        placeholder="Enter Product Decor Style" value="{{old('decor_style')}}">
                                    @error('decor_style')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Hight(inch)</label>
                                    <input type="number" name="hight" class="form-control"
                                        placeholder="Enter Product hight" value="{{old('hight')}}">
                                    @error('hight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Width(inch)</label>
                                    <input type="number" name="width" class="form-control"
                                        placeholder="Enter Product width" value="{{old('width')}}">
                                    @error('width')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Length(inch)</label>
                                    <input type="number" name="length" class="form-control"
                                        placeholder="Enter Product length" value="{{old('length')}}">
                                    @error('length')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleInputEmail1">Depth(inch)</label>
                                    <input type="number" name="depth" class="form-control"
                                        placeholder="Enter Product depth" value="{{old('depth')}}">
                                    @error('depth')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Thumbnail Image</label>
                                    <div id="product_img"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Gallary Image</label>
                                    <div class="input-images"></div>
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-5 form-group">
                                    <label for="exampleInputEmail1">Color</label>
                                    <select id="colors"
                                        class="form-control form-control-solid js-example-basic-multiple"
                                        name="colors[]" multiple="multiple" disabled onchange="myFunction()">

                                        @foreach($allcolor as $color)
                                        <option value="{{$color->color_code}}">{{$color->color_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label class="chech_container">
                                        <input value="1" type="checkbox" name="colors_active">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="customer_choice_options" id="customer_choice_options">


                                </div>
                                <div class="col-md-12 form-group mt-2">
                                    <button type="button" id="add_attributes"
                                        onclick="add_more_customer_choice_option()" class="btn-sm btn-success">Add
                                        Attributes</button>

                                </div>
                                <div class="col-md-12 sku_combination" id="sku_combination">

                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Product Details</label>
                                    <textarea name="product_details" class="form-control" id="summernote" cols="30"
                                        rows="10"></textarea>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Product Tag</label>
                                    <input type="text" name="product_tag" data-role="tagsinput" class="form-control"
                                        placeholder="Enter Product Tag" value="{{old('product_tag')}}">
                                    @error('product_tag')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 form-group mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input have_a_warranty" type="checkbox"
                                            name="have_a_warranty" type="checkbox" value="1">
                                        <label class="form-check-label  mt-2" for="">
                                            Have a Warranty
                                        </label>
                                    </div>

                                    <div class="col-md-12 form-group mt-2" id="warranty_type" style="display:none">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input warranty" type="radio" id="inline_Radio4"
                                                name="warranty_name" value="none">
                                            <label class="form-check-label" for="inline_Radio4">None</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input warranty" type="radio" id="inline_Radio5"
                                                name="warranty_name" value="Warranty">
                                            <label class="form-check-label" for="inline_Radio5">Warranty</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input warranty" type="radio" id="inline_Radio6"
                                                name="warranty_name" value="Guarantee">
                                            <label class="form-check-label" for="inline_Radio6">Guarantee</label>
                                        </div>
                                    </div>

                                    <div class="row col-md-12 form-group mt-2" id="warranty_time" style="display:none">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="exampleInputEmail1">Enter Warranty or guarantee time(year)
                                                <span class="text-danger">(*)</span> </label>
                                            <input type="number" name="warranty_year" class="form-control"
                                                placeholder="Enter time">
                                            @error('warranty_year')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 form-group mt-2">
                                <div class="form-check">
                                    <input class="form-check-input have_a_discount" type="checkbox"
                                        name="have_a_discount" type="checkbox" value="1">
                                    <label class="form-check-label  mt-2" for="flexCheckIndeterminate">
                                        Have A Discount
                                    </label>
                                </div>
                                <div class="col-md-12 form-group mt-2" id="discount_price" style="display:none">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input Special" type="radio" id="inlineRadio1"
                                            name="offer" value="none">
                                        <label class="form-check-label" for="inlineRadio1">None</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input Special" type="radio" id="inlineRadio2"
                                            name="offer" value="11_offer">
                                        <label class="form-check-label" for="inlineRadio2">11 Offer</label>
                                    </div>


                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input Special" type="radio" id="inlineRadio4"
                                            name="offer" value="special_offer">
                                        <label class="form-check-label" for="inlineRadio4">Spacial offer</label>
                                    </div>
                                </div>
                                <div class="row col-md-12 form-group mt-2" id="full_paid_sec" style="display:none">

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="exampleInputEmail1">Discount Price</label>
                                        <input type="text" name="discount_price" class="form-control"
                                            placeholder="Enter Discount Price" min="1" max="90"
                                            value="{{old('discount_price')}}">
                                        @error('discount_price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group mt-2">
                                        <label for="exampleInputEmail1">Discount Type</label>
                                        <select name="discount_price_type" class="form-control form-control-solid">
                                            <option value="percent" selected>%</option>
                                            <option value="taka">TK</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="row col-md-12 form-group mt-2" id="special_sec" style="display:none">

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="exampleInputEmail1">Discount Price</label>
                                        <input type="text" name="discount_price" class="form-control"
                                            placeholder="Enter Discount Price" value="{{old('discount_price')}}">
                                        @error('discount_price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group mt-2">
                                        <label for="exampleInputEmail1">Discount Type</label>
                                        <select name="discount_price_type" class="form-control form-control-solid">
                                            <option value="percent">%</option>
                                            <option value="taka">TK</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input special_section" type="radio" data-id="1"
                                                checked name="discount_condition" value="date">
                                            <label class="form-check-label" for="">Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input s_section" type="radio" data-id="2"
                                                name="discount_condition" value="Stock">
                                            <label class="form-check-label" for="">Stock</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2 col-md-12 row" id="main_date_section">
                                        <div class="col-md-6 mt-2">
                                            <input type="date" name="from_date" class="form-control  form-control-solid"
                                                placeholder="Enter From Date">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="date" name="to_date" class="form-control  form-control-solid"
                                                placeholder="Enter To Date">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 row" id="main_stock_section" style="display:none">
                                        <div class="col-md-2 mt-2 ">

                                            <input class="form-check-input all_stock" type="radio"
                                                name="offer_stock_type" value="all_stock">
                                            <label class="form-check-label" for="">All Stock</label>

                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input class="form-check-input limit_qty" type="radio"
                                                name="offer_stock_type" value="limit_qty" style="">
                                            <label class="form-check-label" for="">Limit Qty</label>

                                        </div>

                                        <div class="col-md-6" id="all_stock_qty" style="display:none">
                                            <div class="fv-row ">
                                                <label>
                                                    <span class="required">Qty</span>
                                                </label>
                                                <input type="number" min="1" class="form-control  form-control-solid"
                                                    name="offer_qty" placeholder="Enter Qty" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mt-2">
                                <div class="form-check">
                                    <input class="form-check-input product_upload_policy" checked
                                        name="product_upload_policy" type="checkbox" value="1">
                                    <label class="form-check-label  mt-2" for="flexCheckIndeterminate">
                                        <a href="{{ url('/product-upload-policy') }}"> i agree to the product upload
                                            policy</a>
                                    </label>
                                </div>
                                @error('product_upload_policy')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <ul class="pro-submit">
                                <li>
                                    <button type="submit" class="btn btn-style1">Add Product</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // get sub category data
        $('select[name="category"]').on('change', function () {
            var cate_id = $(this).val();
            if (cate_id) {
                $.ajax({
                    url: "{{  url('/get/subcategory/all/') }}/" + cate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#subcategory').empty();
                        $('#subcategory').append(
                            ' <option disabled selected>select</option>');
                        $.each(data, function (index, districtObj) {
                            $('#subcategory').append('<option value="' + districtObj
                                .id + '">' + districtObj.name + '</option>');
                        });

                    }
                });
            } else {
                //  alert('danger');
            }

        });
        //  resubcategory
        //  resubcategory
        $('select[name="subcategory"]').on('change', function () {
            var subcate_id = $(this).val();
            if (subcate_id) {
                $.ajax({
                    url: "{{  url('/get/resubcategory/all/') }}/" + subcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#resubcategory').empty();
                        $('#resubcategory').append(
                            '<option disabled selected>select</option>');
                        $.each(data, function (index, districtObj) {
                            $('#resubcategory').append('<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
                        });


                    }
                });
            } else {
                //  alert('danger');
            }
            // re re subcategory get

        });
        $('select[name="resubcategory"]').on('change', function () {
            var resubcate_id = $(this).val();
            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/reresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('#child_resubcategory').empty();
                        $('#child_resubcategory').append(
                            ' <option value="">--select--</option>');
                        $.each(data, function (index, districtObj) {
                            $('#child_resubcategory').append('<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
                        });
                    }
                });
            } else {
                //  alert('danger');
            }

        });
        $('select[name="child_resubcategory"]').on('change', function () {
            var resubcate_id = $(this).val();

            if (resubcate_id) {
                $.ajax({
                    url: "{{  url('/get/rereresubcategory/all/') }}/" + resubcate_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#grand_childresubcategory_id').empty();
                        $('#grand_childresubcategory_id').append(
                            ' <option value="">--select--</option>');
                        $.each(data, function (index, districtObj) {
                            $('#grand_childresubcategory_id').append(
                                '<option value="' +
                                districtObj.id + '">' + districtObj.name +
                                '</option>');
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
    var i = 0;

    function add_more_customer_choice_option() {

        $('#customer_choice_options').append(
            '<div class="form-group row"><div class="col-lg-4"><input type="hidden" name="choice_no[]" value="' +
            i +
            '"><input type="text" class="form-control" name="choice[]" value="" placeholder="Choice Title"></div><div class="col-lg-7"><input type="text" class="form-control choice_tag" name="choice_options_' +
            i +
            '[]" id="choice_tag" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-1"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-times"></i></button></div></div><br>'
        );
        i++;
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    }

    $('input[name="colors_active"]').on('change', function () {
        if (!$('input[name="colors_active"]').is(':checked')) {
            $('#colors').prop('disabled', true);
        } else {
            $('#colors').prop('disabled', false);
        }
        update_sku();
    });

    function delete_row(em) {
        $(em).closest('.form-group').remove();
        update_sku();
    }
    // $('#colors').on('change', function() {
    //     // update_sku();
    //     alert('')
    // });
    $('input[name="unit_price"]').on('keyup', function () {
        update_sku();
    });

    function update_sku() {

        $.ajax({
            type: "GET",
            url: "{{ route('products.sku_combination') }}",
            data: $('#choice_form').serialize(),
            success: function (data) {
                // console.log(data);
                $('#sku_combination').html(data);
            }
        });
    }

</script>
<script>
    function myFunction() {
        update_sku()
    }

</script>
<script type="text/javascript" src="{{asset('backend')}}/assets/js/image-uploader.min.js"></script>
<script>
    $('.input-images').imageUploader();

</script>

<script>
    $(document).ready(function () {
        $(".have_a_warranty").click(function () {

            if ($(this).is(":checked")) {
                $("#warranty_type").show();

            } else {
                $("#warranty_type").hide();

            }
        });

        $(".warranty").click(function () {
            var val = $(this).val();
            if (val == 'Warranty' || val == 'Guarantee') {
                $("#warranty_time").show();
            } else {
                $("#warranty_time").hide();
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        $(".have_a_discount").click(function () {
            if ($(this).is(":checked")) {
                $("#discount_price").show();
            } else {
                $("#discount_price").hide();
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $(".Special").click(function () {
            var val = $(this).val();
            if (val == 'special_offer') {
                $("#full_paid_sec").hide();
                $("#special_sec").show();
            } else {
                $("#special_sec").hide();
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".special_section").click(function () {
            $("#main_date_section").show();
            $("#main_stock_section").hide();
        });

        $(".s_section").click(function () {
            $("#main_date_section").hide();
            $("#main_stock_section").show();
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".all_stock").click(function () {
            $("#all_stock_qty").hide();
        });

        $(".limit_qty").click(function () {
            $("#all_stock_qty").show();
        });
    });

</script>
@endsection
